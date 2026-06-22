<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\HasilAnalisis;
use App\Models\Anak;
use App\Models\AspekPerkembangan;
use App\Models\Guru;
use App\Models\Indikator;
use App\Models\Rpph;
use App\Models\Asesmen;
use App\Services\GeminiService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    // =========================================================
    // TAMPIL FORM INPUT
    // =========================================================

    public function create()
    {
        $guru = Guru::where('id_user', Auth::id())->first();

        if (!$guru) {
            return back()->with('error', 'Data guru tidak ditemukan');
        }

        $anak      = Anak::where('kelompok', $guru->kelompok)->get();
        $rpph      = Rpph::all();
        $aspek     = AspekPerkembangan::all();
        $indikator = Indikator::all();
        $asesmen   = Asesmen::all();

        return view('input-penilaian', compact(
            'anak', 'rpph', 'aspek', 'indikator', 'guru', 'asesmen'
        ));
    }

    // =========================================================
    // SIMPAN PENILAIAN
    // =========================================================

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_anak'      => 'required|exists:anak,id_anak',
                'id_guru'      => 'required|exists:guru,id_guru',
                'id_indikator' => 'required|exists:indikator,id_indikator',
                'id_rpph'      => 'required|exists:rpph,id_rpph',
                'id_asesmen'   => 'required|exists:asesmen,id_asesmen',
                'nilai'        => 'required|in:BB,MB,BSH,BSB',
                'tanggal'      => 'required|date',
                'periode'      => 'required',
            ]);

            $lastId    = Penilaian::orderByDesc('id_penilaian')->value('id_penilaian');
            $newNumber = $lastId ? (intval(substr($lastId, 3)) + 1) : 1;
            $newId     = 'PEN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $penilaian = Penilaian::create([
                'id_penilaian' => $newId,
                'id_anak'      => $request->id_anak,
                'id_guru'      => $request->id_guru,
                'id_indikator' => $request->id_indikator,
                'id_rpph'      => $request->id_rpph,
                'id_asesmen'   => $request->id_asesmen,
                'nilai'        => $request->nilai,
                'deskripsi'    => $request->deskripsi,
                'tanggal'      => $request->tanggal,
                'periode'      => $request->periode,
            ]);

            // ← BUNGKUS dengan try-catch terpisah supaya tidak menggagalkan penilaian
            try {
                $notifService = new NotificationService();
                $notifService->kirimNotifPenilaianHarian($request->id_anak, $request->tanggal);
            } catch (\Exception $e) {
                Log::error('[NOTIF] Gagal kirim notifikasi tapi penilaian tetap tersimpan', [
                    'message' => $e->getMessage(),
                ]);
            }

            return response()->json([
                'message' => 'Penilaian berhasil disimpan',
                'data'    => $penilaian,
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // =========================================================
    // API: GET INDIKATOR BERDASARKAN RPPH
    // =========================================================

    public function getIndikator(string $id)
    {
        $indikator = DB::table('rpph_indikator')
            ->join('indikator', 'rpph_indikator.id_indikator', '=', 'indikator.id_indikator')
            ->join('aspek_perkembangan', 'indikator.id_aspek', '=', 'aspek_perkembangan.id_aspek')
            ->where('rpph_indikator.id_rpph', $id)
            ->select(
                'indikator.id_indikator',
                'indikator.nama_indikator',
                'aspek_perkembangan.id_aspek',
                'aspek_perkembangan.nama_aspek as aspek'
            )
            ->get();

        return response()->json($indikator);
    }

    // =========================================================
    // API: GET ASESMEN BERDASARKAN INDIKATOR
    // =========================================================

    public function getAsesmen(string $id)
    {
        $asesmen = DB::table('indikator_asesmen')
            ->join('asesmen', 'indikator_asesmen.id_asesmen', '=', 'asesmen.id_asesmen')
            ->where('indikator_asesmen.id_indikator', $id)
            ->select('asesmen.id_asesmen', 'asesmen.nama_asesmen')
            ->get();

        return response()->json($asesmen);
    }

    // =========================================================
    // HALAMAN DAFTAR PERKEMBANGAN
    // =========================================================

    public function perkembangan()
    {
        $guru         = Auth::user()->guru;
        $kelompokGuru = $guru->kelompok;

        $penilaian = Penilaian::with(['anak', 'rpph'])
            ->whereHas('anak', function ($q) use ($kelompokGuru) {
                $q->where('kelompok', $kelompokGuru);
            })
            ->get()
            ->unique(function ($item) {
                $minggu = $item->rpph->minggu ?? '0';
                return $item->id_anak . '-' . $minggu;
            })
            ->values();

        // Tambahkan status analisis per item
        foreach ($penilaian as $item) {
            $sudah = HasilAnalisis::where('id_anak', $item->id_anak)
                ->where('id_rpph', $item->id_rpph)
                ->exists();
            $item->status_analisis = $sudah;
        }

        $totalPenilaian = $penilaian->count();

        $sudahAnalisis = HasilAnalisis::select('id_anak', 'id_rpph')
            ->distinct()
            ->get()
            ->count();

        $pendingAnalisis = $totalPenilaian - $sudahAnalisis;

        return view('perkembangan-anak', compact(
            'guru',
            'penilaian',
            'totalPenilaian',
            'pendingAnalisis',
            'sudahAnalisis'
        ));
    }

    // =========================================================
    // HALAMAN DETAIL PERKEMBANGAN — DATA MENTAH
    // =========================================================

    public function detailPerkembangan(string $id_anak, string $minggu)
    {
        $guru = Auth::user()->guru;
        $anak = Anak::findOrFail($id_anak);

        $penilaian = Penilaian::with(['indikator.aspek', 'rpph', 'asesmen'])
            ->where('id_anak', $id_anak)
            ->whereHas('rpph', function ($q) use ($minggu) {
                $q->where('minggu', $minggu);
            })
            ->orderBy('tanggal', 'asc')
            ->get();

        $perAspek = $penilaian->groupBy(
            fn($p) => $p->indikator->aspek->nama_aspek
        );

        $tema  = $penilaian->first()?->rpph?->tema          ?? '-';
        $topik = $penilaian->first()?->rpph?->topik_harian  ?? '-';

        return view('detail-perkembangan', compact(
            'guru', 'anak', 'penilaian',
            'perAspek', 'minggu', 'tema', 'topik'
        ));
    }

    // =========================================================
    // 🔥 PROSES ANALISIS — RBS + GEMINI AI
    // =========================================================

    public function prosesAnalisis(string $id_anak, string $minggu)
    {
        set_time_limit(300);
        ini_set('max_execution_time', 300);

        $guru = Auth::user()->guru;
        $anak = Anak::findOrFail($id_anak);

        // STEP 1: Ambil semua RPPH dalam minggu ini
        $rpphList = Rpph::where('minggu', $minggu)->get();

        if ($rpphList->isEmpty()) {
            return back()->with('error', 'Data RPPH minggu ini tidak ditemukan.');
        }

        $rpphIds           = $rpphList->pluck('id_rpph')->toArray();
        $rpphRepresentatif = $rpphList->first()->id_rpph;
        $rpphObj           = $rpphList->first();

        // STEP 2: Ambil semua penilaian minggu ini
        $penilaian = Penilaian::with(['indikator.aspek', 'rpph'])
            ->where('id_anak', $id_anak)
            ->whereIn('id_rpph', $rpphIds)
            ->get();

        if ($penilaian->isEmpty()) {
            return back()->with('error', 'Belum ada penilaian untuk minggu ini.');
        }

        $periode = $penilaian->first()->periode;
        $tema    = $rpphObj->tema;

        // STEP 3: RBS per aspek
        $groupAspek    = $penilaian->groupBy(fn($item) => $item->indikator->aspek->id_aspek);
        $hasilAnalisis = [];

        foreach ($groupAspek as $idAspek => $items) {

            $namaAspek  = $items->first()->indikator->aspek->nama_aspek;
            $distribusi = ['BB' => 0, 'MB' => 0, 'BSH' => 0, 'BSB' => 0];

            foreach ($items as $item) {
                $distribusi[$item->nilai]++;
            }

            $total      = array_sum($distribusi);
            $dominan    = $this->cariDominan($distribusi);
            $confidence = round(($distribusi[$dominan] / $total) * 100, 1);
            $reliable   = $total >= 3;
            $status     = $this->prosesRBS($dominan);

            $indikatorLemah = $items
                ->filter(fn($p) => in_array($p->nilai, ['BB', 'MB']))
                ->map(fn($p) => [
                    'id'    => $p->indikator->id_indikator,
                    'nama'  => $p->indikator->nama_indikator,
                    'nilai' => $p->nilai,
                ])
                ->unique('id')
                ->values()
                ->toArray();

            // Generate ID — aman untuk insert/update
            $existing = HasilAnalisis::where('id_anak', $id_anak)
                ->where('id_rpph', $rpphRepresentatif)
                ->where('id_aspek', $idAspek)
                ->first();

            if (!$existing) {
                $lastId    = HasilAnalisis::orderByDesc('id_hasil')->value('id_hasil');
                $newNumber = $lastId ? (intval(substr($lastId, 3)) + 1) : 1;
                $newId     = 'HSL' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            } else {
                $newId = $existing->id_hasil;
            }

            // Simpan ke DB — tanpa kolom rekomendasi
            HasilAnalisis::updateOrCreate(
                [
                    'id_anak'  => $id_anak,
                    'id_rpph'  => $rpphRepresentatif,
                    'id_aspek' => $idAspek,
                ],
                [
                    'id_hasil'            => $newId,
                    'nilai_dominan'       => $dominan,
                    'status_perkembangan' => $status,
                    'jumlah_bb'           => $distribusi['BB'],
                    'jumlah_mb'           => $distribusi['MB'],
                    'jumlah_bsh'          => $distribusi['BSH'],
                    'jumlah_bsb'          => $distribusi['BSB'],
                    'total_penilaian'     => $total,
                    'confidence'          => $confidence,
                    'indikator_lemah'     => json_encode($indikatorLemah),
                    'periode'             => $periode,
                    'tanggal_analisis'    => now()->toDateString(),
                    'rekomendasi_ai'      => null,
                    'ai_generated'        => false,
                ]
            );

            $hasilAnalisis[] = [
                'aspek'           => $namaAspek,
                'distribusi'      => $distribusi,
                'total'           => $total,
                'dominan'         => $dominan,
                'confidence'      => $confidence,
                'reliable'        => $reliable,
                'status'          => $status,
                'indikator_lemah' => $indikatorLemah,
            ];
        }

        // STEP 4: Hitung status global
        $statusGlobal = $this->hitungStatusGlobal($hasilAnalisis);

        // STEP 5: Bangun konteks LLM
        $konteksLLM = $this->buildKonteksLLM($anak, $rpphObj, $hasilAnalisis, $periode);

        // STEP 6: Panggil Gemini
        Log::info('[ANALISIS] Memanggil Gemini untuk ' . $anak->nama_anak);
        $gemini        = new GeminiService();
        $prompt        = $gemini->susunPrompt($konteksLLM);
        $rekomendasiAI = $gemini->generate($prompt);

        // STEP 7: Fallback RBS jika Gemini gagal
        if (!$rekomendasiAI) {
            Log::warning('[ANALISIS] Gemini gagal, pakai fallback RBS');

            $rekomendasiAI = collect($hasilAnalisis)
                ->map(function ($h) {
                    $teks = $this->generateRekomendasi(
                        $h['status'],
                        $h['aspek'],
                        $h['indikator_lemah']
                    );
                    return "**{$h['aspek']}**\n{$teks}";
                })
                ->implode("\n\n");
        }

        // STEP 8: Simpan rekomendasi_ai ke semua baris minggu ini
        HasilAnalisis::where('id_anak', $id_anak)
            ->where('id_rpph', $rpphRepresentatif)
            ->update([
                'rekomendasi_ai'  => $rekomendasiAI,
                'ai_generated'    => true,
                'ai_generated_at' => now(),
            ]);

        Log::info('[ANALISIS] Selesai untuk ' . $anak->nama_anak);

        // ← TAMBAH INI: kirim notifikasi hasil analisis ke orang tua
        $notifService = new NotificationService();
        $notifService->kirimNotifHasilAnalisis(
            $id_anak,
            $minggu,
            $statusGlobal['status']
        );

        return redirect()->route('detail-perkembangan', [
            'id_anak' => $id_anak,
            'minggu'  => $minggu,
        ])->with('success', 'Analisis perkembangan berbasis AI berhasil diperbarui!');
    }

    // =========================================================
    // 🔥 RBS — CARI DOMINAN dengan tiebreaker
    // =========================================================

    private function cariDominan(array $distribusi): string
    {
        $max  = max($distribusi);
        $seri = array_keys(array_filter(
            $distribusi,
            fn($v) => $v === $max
        ));

        if (count($seri) === 1) {
            return $seri[0];
        }

        // Tiebreaker konservatif — pilih nilai lebih rendah
        $prioritas = ['BB' => 1, 'MB' => 2, 'BSH' => 3, 'BSB' => 4];
        usort($seri, fn($a, $b) => $prioritas[$a] - $prioritas[$b]);

        return $seri[0];
    }

    // =========================================================
    // 🔥 RBS — STATUS
    // =========================================================

    private function prosesRBS(string $nilai): string
    {
        return match($nilai) {
            'BSB'   => 'Berkembang Sangat Baik',
            'BSH'   => 'Berkembang Sesuai Harapan',
            'MB'    => 'Mulai Berkembang',
            default => 'Belum Berkembang',
        };
    }

    // =========================================================
    // 🔥 KESIMPULAN GLOBAL
    // =========================================================

    private function hitungStatusGlobal(array $hasilAnalisis): array
    {
        $statusMap = [
            'BB'  => 'Belum Berkembang',
            'MB'  => 'Mulai Berkembang',
            'BSH' => 'Berkembang Sesuai Harapan',
            'BSB' => 'Berkembang Sangat Baik',
        ];

        $semuaDominan     = array_column($hasilAnalisis, 'dominan');
        $distribusiGlobal = array_count_values($semuaDominan);
        $distribusiGlobal = array_merge(
            ['BB' => 0, 'MB' => 0, 'BSH' => 0, 'BSB' => 0],
            $distribusiGlobal
        );

        $dominanGlobal = $this->cariDominan($distribusiGlobal);

        // Aturan: ada aspek BB → global tidak boleh lebih dari MB
        $adaBB = in_array('BB', $semuaDominan);
        $adaMB = in_array('MB', $semuaDominan);

        $skorMap = ['BB' => 1, 'MB' => 2, 'BSH' => 3, 'BSB' => 4];
        if ($adaBB && $skorMap[$dominanGlobal] > 2) {
            $dominanGlobal = 'MB';
        }

        $reliableCount  = count(array_filter($hasilAnalisis, fn($h) => $h['reliable']));
        $totalAspek     = count($hasilAnalisis);
        $globalReliable = $reliableCount >= ceil($totalAspek / 2);

        return [
            'dominan'          => $dominanGlobal,
            'status'           => $statusMap[$dominanGlobal],
            'distribusi_aspek' => $distribusiGlobal,
            'total_aspek'      => $totalAspek,
            'reliable_aspek'   => $reliableCount,
            'global_reliable'  => $globalReliable,
            'ada_bb'           => $adaBB,
            'ada_mb'           => $adaMB,
        ];
    }

    // =========================================================
    // 🔥 GENERATE REKOMENDASI RBS — dipakai sebagai fallback
    // =========================================================

    private function generateRekomendasi(
        string $status,
        string $aspek,
        array  $indikatorLemah = []
    ): string {
        $listLemah = '';
        if (!empty($indikatorLemah)) {
            $namaLemah = array_column($indikatorLemah, 'nama');
            $listLemah = ' Fokuskan perhatian pada: ' . implode(', ', $namaLemah) . '.';
        }

        return match($status) {
            'Berkembang Sangat Baik' =>
                "Anak menunjukkan perkembangan sangat baik pada aspek {$aspek}. " .
                "Orang tua dapat terus memberikan stimulasi lanjutan melalui aktivitas bermain edukatif di rumah.",

            'Berkembang Sesuai Harapan' =>
                "Perkembangan anak pada aspek {$aspek} sudah sesuai harapan. " .
                "Orang tua disarankan tetap mendampingi secara konsisten.{$listLemah}",

            'Mulai Berkembang' =>
                "Anak mulai berkembang pada aspek {$aspek}. " .
                "Orang tua dapat membantu dengan latihan sederhana dan pendampingan rutin.{$listLemah}",

            default =>
                "Perkembangan anak pada aspek {$aspek} masih perlu perhatian khusus. " .
                "Orang tua disarankan memberikan stimulasi lebih intensif.{$listLemah}",
        };
    }

    // =========================================================
    // BANGUN KONTEKS UNTUK LLM
    // =========================================================

    public function buildKonteksLLM(
        Anak   $anak,
        Rpph   $rpph,
        array  $hasilAnalisis,
        string $periode
    ): array {
        return [
            'anak' => [
                'nama'     => $anak->nama_anak,
                'usia'     => \Carbon\Carbon::parse($anak->tanggal_lahir)->age,
                'kelompok' => $anak->kelompok,
            ],
            'periode' => $periode,
            'minggu'  => $rpph->minggu,
            'tema'    => $rpph->tema,
            'hasil_per_aspek' => collect($hasilAnalisis)->map(fn($h) => [
                'aspek'           => $h['aspek'],
                'status'          => $h['status'],
                'dominan'         => $h['dominan'],
                'confidence'      => $h['confidence'] . '%',
                'reliable'        => $h['reliable'] ? 'ya' : 'data terbatas',
                'distribusi'      => $h['distribusi'],
                'indikator_lemah' => $h['indikator_lemah'],
            ])->toArray(),
        ];
    }

    // =========================================================
    // HALAMAN LIST HASIL ANALISIS
    // =========================================================

    public function hasilAnalisis()
    {
        $guru = Auth::user()->guru;

        // 1. Ambil data mentah hasil analisis aspek berdasarkan kelompok guru
        $semuaHasil = HasilAnalisis::with(['anak', 'rpph', 'aspek'])
            ->whereHas('anak', function ($q) use ($guru) {
                $q->where('kelompok', $guru->kelompok);
            })
            ->get();

        // 2. Kelompokkan berdasarkan Kombinasi ID Anak dan Minggu
        $grouped = $semuaHasil->groupBy(function ($item) {
            return $item->id_anak . '-' . ($item->rpph->minggu ?? '0');
        });

        // 3. Lakukan mapping menggunakan method put() agar Collection menerima custom key
        $hasil = $grouped->map(function ($items) {
            // Kumpulkan semua nilai dominan dari aspek-aspek anak ini di minggu tersebut
            $semuaDominan = $items->pluck('nilai_dominan')->toArray();
            
            // Hitung distribusi kemunculan nilai (BB, MB, BSH, BSB)
            $distribusi = array_count_values($semuaDominan);
            $distribusi = array_merge(
                ['BB' => 0, 'MB' => 0, 'BSH' => 0, 'BSB' => 0],
                $distribusi
            );

            // Cari nilai dengan frekuensi tertinggi (Dominan)
            $maxVal = max($distribusi);
            $seri   = array_keys(array_filter($distribusi, fn($v) => $v === $maxVal));

            // Aturan tiebreaker jika ada jumlah nilai aspek yang sama (ambil yang paling rendah)
            $prioritas = ['BB' => 1, 'MB' => 2, 'BSH' => 3, 'BSB' => 4];
            usort($seri, fn($a, $b) => $prioritas[$a] - $prioritas[$b]);
            $dominanGlobal = $seri[0];

            // Rule Pengondisian Aturan: Jika ada aspek bernilai BB, global dikunci maksimal MB
            if (in_array('BB', $semuaDominan) && $prioritas[$dominanGlobal] > 2) {
                $dominanGlobal = 'MB';
            }

            // Konversi Kode Singkatan ke Teks Status Resmi Indonesia
            $statusMap = [
                'BB'  => 'Belum Berkembang',
                'MB'  => 'Mulai Berkembang',
                'BSH' => 'Berkembang Sesuai Harapan',
                'BSB' => 'Berkembang Sangat Baik',
            ];

            // 🔥 PERBAIKAN: Gunakan put() untuk memasukkan data custom ke dalam objek Collection secara aman
            $items->put('status_global', $statusMap[$dominanGlobal]);
            $items->put('nilai_dominan_global', $dominanGlobal);

            return $items;
        });

        return view('hasil-analisis', compact('guru', 'hasil'));
    }

    // =========================================================
    // DETAIL HASIL ANALISIS
    // =========================================================

    public function detailHasilAnalisis(string $id_anak, string $minggu)
    {
        $guru = Auth::user()->guru;
        $anak = Anak::findOrFail($id_anak);

        $rpph = Rpph::where('minggu', $minggu)->first();

        if (!$rpph) {
            return back()->with('error', 'RPPH tidak ditemukan');
        }

        $hasilDb = HasilAnalisis::with('aspek')
            ->where('id_anak', $id_anak)
            ->where('id_rpph', $rpph->id_rpph)
            ->get();

        if ($hasilDb->isEmpty()) {
            return back()->with('error', 'Data analisis belum tersedia');
        }

        // Ambil rekomendasi AI
        $rekomendasiAI = $hasilDb
            ->where('ai_generated', true)
            ->first()
            ?->rekomendasi_ai ?? null;

        // Susun hasilAnalisis untuk blade
        $hasilAnalisis = $hasilDb->map(fn($item) => [
            'aspek'      => $item->aspek->nama_aspek,
            'distribusi' => [
                'BB'  => $item->jumlah_bb,
                'MB'  => $item->jumlah_mb,
                'BSH' => $item->jumlah_bsh,
                'BSB' => $item->jumlah_bsb,
            ],
            'total'           => $item->total_penilaian,
            'dominan'         => $item->nilai_dominan,
            'confidence'      => (float) $item->confidence,
            'reliable'        => $item->total_penilaian >= 3,
            'status'          => $item->status_perkembangan,
            'indikator_lemah' => is_array($item->indikator_lemah)
                                    ? $item->indikator_lemah
                                    : (json_decode($item->indikator_lemah, true) ?? []),
            // Tidak ada 'rekomendasi' di sini
        ])->toArray();

        $statusGlobal = $this->hitungStatusGlobal($hasilAnalisis);
        $tema         = $rpph->tema;
        $tanggalAnalisis = $hasilDb->first()?->tanggal_analisis;
        $aiGeneratedAt   = $hasilDb->where('ai_generated', true)->first()?->ai_generated_at;


        return view('detail-hasil-analisis', compact(
            'guru', 'anak', 'hasilAnalisis',
            'statusGlobal', 'rekomendasiAI',
            'minggu', 'rpph', 'tema', 'id_anak','tanggalAnalisis', 'aiGeneratedAt'
        ));
    }

    public function index()
    {
        $guru = Guru::where('id_user', Auth::id())->first();

        if (!$guru) {
            return response()->json([
                'message' => 'Guru tidak ditemukan'
            ], 404);
        }

        $penilaian = Penilaian::with([
            'anak',
            'guru',
            'indikator',
            'rpph',
            'asesmen'
        ])
        ->whereHas('anak', function ($q) use ($guru) {
            $q->where('kelompok', $guru->kelompok);
        })
        ->get();

        return response()->json($penilaian);
    }

}