<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\HasilAnalisis;
use App\Models\Penilaian;
use App\Models\Guru;
use App\Services\GeminiService;
use App\Models\Rapor;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class RaporController extends Controller
{
    // =========================================================
    // HALAMAN FORM GENERATE RAPOR
    // =========================================================
    public function index()
    {
        $guru = Auth::user()->guru;
        $anak = Anak::where('kelompok', $guru->kelompok)->get();

        return view('rapor.index', compact('guru', 'anak'));
    }

    // =========================================================
    // GENERATE NARASI VIA GEMINI (AJAX)
    // =========================================================
    public function generate(Request $request)
    {
        set_time_limit(300);

        $request->validate([
            'id_anak'      => 'required|exists:anak,id_anak',
            'semester'     => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);

        $guru = Auth::user()->guru;
        $anak = Anak::findOrFail($request->id_anak);

        // Ambil semua hasil analisis anak dalam semester ini
        $semuaHasil = HasilAnalisis::with(['aspek', 'rpph'])
            ->where('id_anak', $anak->id_anak)
            ->get();

        if ($semuaHasil->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Belum ada data analisis untuk anak ini.'
            ], 422);
        }

        // Kelompokkan per aspek
        $perAspek = $semuaHasil->groupBy('id_aspek');

        // Hitung ringkasan per aspek
        $ringkasanAspek = $perAspek->map(function ($items) {
            $dominanList  = $items->pluck('nilai_dominan')->countBy();
            $statusList   = $items->pluck('status_perkembangan')->unique()->values();
            $indLemahAll  = $items->flatMap(function ($i) {
                $lemah = is_array($i->indikator_lemah)
                    ? $i->indikator_lemah
                    : (json_decode($i->indikator_lemah, true) ?? []);
                return collect($lemah)->pluck('nama');
            })->unique()->values()->toArray();

            return [
                'nama_aspek'      => $items->first()->aspek->nama_aspek,
                'distribusi'      => $dominanList->toArray(),
                'status_list'     => $statusList->toArray(),
                'indikator_lemah' => $indLemahAll,
                'total_minggu'    => $items->count(),
            ];
        })->values();

        // Generate narasi via Gemini
        $gemini = new GeminiService();
        $narasi = [];

        // Definisi capaian per aspek (sesuai rapor asli)
        $capaianNABP = [
            1 => "Anak percaya kepada Tuhan Yang Maha Esa, mulai mengenal dan mempraktikkan ajaran pokok sesuai dengan agama dan kepercayaan-Nya",
            2 => "Anak berpartisipasi aktif dalam menjaga kebersihan, kesehatan dan keselamatan diri sebagai bentuk rasa sayang terhadap dirinya dan rasa syukur pada Tuhan Yang Maha Esa",
            3 => "Anak menghargai sesama manusia dengan berbagai perbedaannya dan mempraktikkan perilaku baik dan berakhlak mulia",
            4 => "Anak menghargai alam dengan cara merawatnya dan menunjukkan rasa sayang terhadap makhluk hidup yang merupakan ciptaan Tuhan Yang Maha Esa",
        ];

        $capaianJD = [
            1 => "Anak mengenali, mengekspresikan, dan mengelola emosi diri serta membangun hubungan sosial secara sehat",
            2 => "Anak memahami identitas dirinya yang terbentuk oleh ragam minat, kebutuhan, karakteristik gender, agama, dan sosial budaya",
            3 => "Anak mengenal dan memiliki perilaku positif terhadap identitas dan perannya sebagai bagian dari keluarga, sekolah, masyarakat, dan anak Indonesia",
            4 => "Anak menggunakan fungsi gerak (motorik kasar, halus, dan taktil) untuk mengeksplorasi dan memanipulasi berbagai objek dan lingkungan sekitar",
        ];

        $capaianLMSTRS = [
            1 => "Anak mengenali dan memahami berbagai informasi, mengomunikasikan perasaan dan pikiran secara lisan, tulisan, atau menggunakan berbagai media serta membangun percakapan",
            2 => "Anak menunjukkan minat, kegemaran, dan berpartisipasi dalam kegiatan pramembaca dan pramenulis",
            3 => "Anak memiliki kemampuan menyatakan hubungan antar bilangan dengan berbagai cara, mengidentifikasi pola, mengenali bentuk dan karakteristik benda di sekitar",
            4 => "Anak mampu menyebutkan alasan, pilihan atau keputusannya, mampu memecahkan masalah sederhana, serta mengetahui hubungan sebab akibat",
            5 => "Anak menunjukkan rasa ingin tahu melalui observasi, eksplorasi, dan eksperimen dengan menggunakan lingkungan sekitar dan media sebagai sumber belajar",
            6 => "Anak menunjukkan kemampuan awal menggunakan dan merekayasa teknologi serta untuk mencari informasi, gagasan, dan keterampilan secara aman dan bertanggung jawab",
            7 => "Anak mengeksplorasi berbagai proses seni, mengekspresikannya, serta mengapresiasi karya seni",
        ];

        // Generate per aspek
        foreach (['nabp' => $capaianNABP, 'jd' => $capaianJD, 'lmstrs' => $capaianLMSTRS] as $kodeAspek => $capaianList) {

            $namaAspekMap = [
                'nabp'    => 'Nilai Agama dan Budi Pekerti',
                'jd'      => 'Jati Diri',
                'lmstrs'  => 'Dasar-dasar Literasi, Matematika, Sains, Teknologi, Rekayasa, dan Seni',
            ];

            $dataAspek = $ringkasanAspek->firstWhere('nama_aspek', $namaAspekMap[$kodeAspek]);

            foreach ($capaianList as $noPoin => $tekstCapaian) {
                $prompt = $this->susunPromptNarasi(
                    $anak->nama_anak,
                    $tekstCapaian,
                    $dataAspek,
                    $request->semester
                );

                $hasil = $gemini->generate($prompt);
                $narasi["{$kodeAspek}_{$noPoin}"] = $hasil ?? "Ananda {$anak->nama_anak} sedang dalam proses perkembangan pada capaian ini.";

                // Jeda antar request Gemini
                sleep(3);
            }
        }

        // Simpan atau update draft rapor
        $lastId    = Rapor::orderByDesc('id_rapor')->value('id_rapor');
        $newNumber = $lastId ? (intval(substr($lastId, 3)) + 1) : 1;
        $newId     = 'RPR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $rapor = Rapor::updateOrCreate(
            [
                'id_anak'      => $anak->id_anak,
                'semester'     => $request->semester,
                'tahun_ajaran' => $request->tahun_ajaran,
            ],
            [
                'id_rapor'        => $newId,
                'fase'            => 'FONDASI',
                'id_guru'         => $guru->id_guru,
                'narasi_nabp_1'   => $narasi['nabp_1'] ?? null,
                'narasi_nabp_2'   => $narasi['nabp_2'] ?? null,
                'narasi_nabp_3'   => $narasi['nabp_3'] ?? null,
                'narasi_nabp_4'   => $narasi['nabp_4'] ?? null,
                'narasi_jd_1'     => $narasi['jd_1'] ?? null,
                'narasi_jd_2'     => $narasi['jd_2'] ?? null,
                'narasi_jd_3'     => $narasi['jd_3'] ?? null,
                'narasi_jd_4'     => $narasi['jd_4'] ?? null,
                'narasi_lmstrs_1' => $narasi['lmstrs_1'] ?? null,
                'narasi_lmstrs_2' => $narasi['lmstrs_2'] ?? null,
                'narasi_lmstrs_3' => $narasi['lmstrs_3'] ?? null,
                'narasi_lmstrs_4' => $narasi['lmstrs_4'] ?? null,
                'narasi_lmstrs_5' => $narasi['lmstrs_5'] ?? null,
                'narasi_lmstrs_6' => $narasi['lmstrs_6'] ?? null,
                'narasi_lmstrs_7' => $narasi['lmstrs_7'] ?? null,
                'status'          => 'draft',
            ]
        );

        return response()->json([
            'success'  => true,
            'id_rapor' => $rapor->id_rapor,
            'narasi'   => $narasi,
            'message'  => 'Narasi berhasil digenerate. Silakan periksa dan edit sebelum cetak.',
        ]);
    }

    // =========================================================
    // SUSUN PROMPT NARASI PER CAPAIAN
    // =========================================================
    private function susunPromptNarasi(
        string $namaAnak,
        string $tekstCapaian,
        ?array $dataAspek,
        string $semester
    ): string {

        $ringkasan = '';
        if ($dataAspek) {
            $distribusi  = implode(', ', array_map(
                fn($k, $v) => "{$k}={$v}",
                array_keys($dataAspek['distribusi']),
                $dataAspek['distribusi']
            ));
            $statusList  = implode(', ', $dataAspek['status_list']);
            $indLemah    = !empty($dataAspek['indikator_lemah'])
                ? implode(', ', $dataAspek['indikator_lemah'])
                : 'tidak ada';

            $ringkasan = "
Data perkembangan selama {$semester}:
- Distribusi nilai: {$distribusi}
- Status yang muncul: {$statusList}
- Indikator yang masih lemah: {$indLemah}
- Total minggu dianalisis: {$dataAspek['total_minggu']} minggu";
        }

        return "Kamu adalah guru PAUD yang menulis narasi rapor untuk orang tua.

Tulis narasi singkat (maksimal 3 kalimat) untuk rapor anak bernama {$namaAnak}.

Capaian pembelajaran yang dinilai:
\"{$tekstCapaian}\"
{$ringkasan}

INSTRUKSI:
1. Mulai dengan 'Ananda {$namaAnak}'
2. Ceritakan perkembangan anak pada capaian ini secara spesifik
3. Gunakan bahasa yang hangat dan mudah dipahami orang tua
4. Jika ada indikator lemah, sebutkan secara halus bahwa masih perlu pendampingan
5. Maksimal 3 kalimat, langsung ke inti
6. JANGAN gunakan simbol *, #, atau markdown apapun
7. Hanya tulis narasi saja, tanpa tambahan penjelasan";
    }

    // =========================================================
    // SIMPAN DDTK + PRESENSI + EDIT NARASI
    // =========================================================
    public function simpan(Request $request, string $id_rapor)
    {
        $rapor = Rapor::findOrFail($id_rapor);

        $rapor->update([
            // DDTK
            'tinggi_badan'      => $request->tinggi_badan,
            'berat_badan'       => $request->berat_badan,
            'lingkar_kepala'    => $request->lingkar_kepala,
            // Presensi
            'hadir'             => $request->hadir ?? 0,
            'sakit'             => $request->sakit ?? 0,
            'izin'              => $request->izin ?? 0,
            'tanpa_keterangan'  => $request->tanpa_keterangan ?? 0,
            // Narasi yang sudah diedit guru
            'narasi_nabp_1'     => $request->narasi_nabp_1,
            'narasi_nabp_2'     => $request->narasi_nabp_2,
            'narasi_nabp_3'     => $request->narasi_nabp_3,
            'narasi_nabp_4'     => $request->narasi_nabp_4,
            'narasi_jd_1'       => $request->narasi_jd_1,
            'narasi_jd_2'       => $request->narasi_jd_2,
            'narasi_jd_3'       => $request->narasi_jd_3,
            'narasi_jd_4'       => $request->narasi_jd_4,
            'narasi_lmstrs_1'   => $request->narasi_lmstrs_1,
            'narasi_lmstrs_2'   => $request->narasi_lmstrs_2,
            'narasi_lmstrs_3'   => $request->narasi_lmstrs_3,
            'narasi_lmstrs_4'   => $request->narasi_lmstrs_4,
            'narasi_lmstrs_5'   => $request->narasi_lmstrs_5,
            'narasi_lmstrs_6'   => $request->narasi_lmstrs_6,
            'narasi_lmstrs_7'   => $request->narasi_lmstrs_7,
            'status'            => 'final',
        ]);

        return response()->json(['success' => true]);
    }

    // =========================================================
    // DOWNLOAD RAPOR SEBAGAI PDF
    // =========================================================
    public function download(string $id_rapor)
    {
        $rapor = Rapor::with(['anak.orangTua.user'])->findOrFail($id_rapor);
        $guru  = Auth::user()->guru;
        $anak  = $rapor->anak;

        $data = [
            'rapor'       => $rapor,
            'anak'        => $anak,
            'guru'        => $guru->user->nama ?? '-',
            'nama_sekolah'=> "KB Nurul'Ain",
        ];

        $pdf = Pdf::loadView('rapor.cetak', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'          => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'dpi'                  => 150,
            ]);

        $namaFile = "Rapor-{$anak->nama_anak}-{$rapor->semester}.pdf";

        return $pdf->download($namaFile);
    }

    // =========================================================
    // LIST RAPOR YANG SUDAH DIBUAT
    // =========================================================
    public function list()
    {
        $guru  = Auth::user()->guru;
        $rapor = Rapor::with('anak')
            ->whereHas('anak', fn($q) => $q->where('kelompok', $guru->kelompok))
            ->orderByDesc('created_at')
            ->get();

        return view('rapor.list', compact('guru', 'rapor'));
    }
}