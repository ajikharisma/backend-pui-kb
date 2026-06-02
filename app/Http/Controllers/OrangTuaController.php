<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Penilaian;
use App\Models\HasilAnalisis;
use App\Models\Rpph;
use Illuminate\Support\Facades\Log;

class OrangTuaController extends Controller
{
    // 🔥 GET semua orang tua
    public function index()
    {
        return response()->json(
            OrangTua::with('user')->get()
        );
    }

    // 🔥 INSERT orang tua + user
    public function store(Request $request)
    {
        try {
            $request->validate([
                // USER
                'nama' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'no_hp' => 'required|string',
                'password' => 'required|min:6',

                // ORANG TUA
                'alamat' => 'required|string'
            ]);

            // 🔥 SIMPAN USER
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'role' => 'orang_tua'
            ]);

            // 🔥 SIMPAN ORANG TUA
            $ortu = OrangTua::create([
                'id_user' => $user->id_user,
                'alamat' => $request->alamat
            ]);

            return response()->json([
                'message' => 'Data orang tua berhasil ditambahkan',
                'user' => $user,
                'orang_tua' => $ortu
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menambahkan orang tua',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 UPDATE orang tua + user
    public function update(Request $request, $id)
    {
        try {
            $ortu = OrangTua::with('user')->findOrFail($id);

            $request->validate([
                'nama' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email,' . $ortu->id_user . ',id_user',
                'no_hp' => 'nullable|string',
                'password' => 'nullable|min:6',
                'alamat' => 'nullable|string'
            ]);

            // 🔥 UPDATE USER
            $user = $ortu->user;

            if ($request->nama) $user->nama = $request->nama;
            if ($request->email) $user->email = $request->email;
            if ($request->no_hp) $user->no_hp = $request->no_hp;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            // 🔥 UPDATE ORANG TUA
            if ($request->alamat) {
                $ortu->alamat = $request->alamat;
            }

            $ortu->save();

            return response()->json([
                'message' => 'Data orang tua berhasil diupdate',
                'data' => $ortu
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal update orang tua',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 DELETE orang tua + user
    public function destroy($id)
    {
        try {
            $ortu = OrangTua::findOrFail($id);

            // hapus user juga
            User::where('id_user', $ortu->id_user)->delete();

            $ortu->delete();

            return response()->json([
                'message' => 'Data orang tua berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menghapus orang tua',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

   public function getDashboardData(Request $request)
    {
        try {
            $user     = $request->user();
            $orangTua = OrangTua::where('id_user', $user->id_user)
                ->with('anak')
                ->first();

            if (!$orangTua) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data orang tua tidak ditemukan'
                ], 404);
            }

            $anak = $orangTua->anak()->first();

            if (!$anak) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data anak tidak ditemukan'
                ], 404);
            }

            // ── TOTAL PENILAIAN (unik per minggu) ──
            $penilaian = Penilaian::with('rpph')
                ->where('id_anak', $anak->id_anak)
                ->get()
                ->unique(function ($item) {
                    return $item->id_anak . '-' . ($item->rpph->minggu ?? '0');
                })
                ->values();

            $totalPenilaian = $penilaian->count();

            // ── SUDAH DIANALISIS ──
            // Ambil SEKALI di luar loop, simpan minggu yang sudah dianalisis
            $mingguSudahAnalisis = HasilAnalisis::with('rpph')
                ->where('id_anak', $anak->id_anak)
                ->get()
                ->map(fn($item) => $item->rpph->minggu ?? null)
                ->filter()
                ->unique()
                ->values()
                ->toArray();

            $sudahDianalisis = count($mingguSudahAnalisis);
            $belumDianalisis = max(0, $totalPenilaian - $sudahDianalisis);

            // ── LIST PERKEMBANGAN TERBARU ──
            $perkembanganList = $penilaian
                ->sortByDesc(fn($item) => $item->rpph->minggu ?? 0)
                ->map(function ($item) use ($anak, $mingguSudahAnalisis) {
                    $minggu = $item->rpph->minggu ?? null;

                    // Cek dari array yang sudah diambil — tidak query lagi
                    $sudahAnalisis = in_array($minggu, $mingguSudahAnalisis);

                    return [
                        'nama_anak'      => $anak->nama_anak,
                        'kelompok'       => $anak->kelompok,
                        'minggu'         => $minggu ?? '-',
                        'tema'           => $item->rpph->tema ?? '-',
                        'status_analisis'=> $sudahAnalisis,
                    ];
                })
                ->values();

            return response()->json([
                'success'           => true,
                'anak'              => [
                    'id_anak'   => $anak->id_anak,
                    'nama_anak' => $anak->nama_anak,
                    'kelompok'  => $anak->kelompok,
                    'foto'      => $anak->foto,
                ],
                'total_penilaian'   => $totalPenilaian,
                'menunggu_analisis' => $belumDianalisis,
                'sudah_dianalisis'  => $sudahDianalisis,
                'perkembangan_list' => $perkembanganList,
            ]);

        } catch (\Exception $e) {
            Log::error('Dashboard Orang Tua Error', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil dashboard',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getDetailPerkembangan(Request $request, $minggu)
    {
        try {
            $user     = $request->user();
            $orangTua = OrangTua::where('id_user', $user->id_user)->first();
    
            if (!$orangTua) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data orang tua tidak ditemukan'
                ], 404);
            }
    
            $anak = $orangTua->anak()->first();
    
            if (!$anak) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data anak tidak ditemukan'
                ], 404);
            }
    
            // Ambil semua penilaian anak untuk minggu tertentu
            // lewat relasi penilaian → rpph (minggu) → indikator → aspek
            $penilaianList = Penilaian::with([
                    'rpph',
                    'indikator.aspek',
                ])
                ->where('id_anak', $anak->id_anak)
                ->whereHas('rpph', function ($q) use ($minggu) {
                    $q->where('minggu', $minggu);
                })
                ->orderBy('tanggal')
                ->get()
                ->map(function ($item) {
                    return [
                        'tanggal'      => $item->tanggal,
                        'topik_harian' => $item->rpph->topik_harian ?? '-',
                        'aspek'        => $item->indikator->aspek->nama_aspek ?? '-',
                        'capaian'      => $item->nilai ?? '-',
                        'deskripsi'    => $item->deskripsi ?? '-',
                    ];
                })
                ->values();
    
            // Info header minggu
            $rpph = \App\Models\Rpph::where('minggu', $minggu)->first();
    
            return response()->json([
                'success'    => true,
                'minggu'     => $minggu,
                'tema'       => $rpph->tema ?? '-',
                'nama_anak'  => $anak->nama_anak,
                'kelompok'   => $anak->kelompok,
                'data'       => $penilaianList,
            ]);
    
        } catch (\Exception $e) {
            Log::error('Detail Perkembangan Error', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);
    
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail perkembangan',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // ── 1. LIST SEMUA HASIL ANALISIS ANAK ──
    public function getListAnalisis(Request $request)
    {
        try {
            $user     = $request->user();
            $orangTua = OrangTua::where('id_user', $user->id_user)->first();
    
            if (!$orangTua) {
                return response()->json(['success' => false, 'message' => 'Data orang tua tidak ditemukan'], 404);
            }
    
            $anak = $orangTua->anak()->first();
    
            if (!$anak) {
                return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan'], 404);
            }
    
            $semuaHasil = HasilAnalisis::with(['rpph', 'aspek'])
                ->where('id_anak', $anak->id_anak)
                ->get();
    
            $list = $semuaHasil
                ->groupBy(fn($item) => $item->rpph->minggu ?? 0)
                ->map(function ($items, $minggu) use ($anak) {
    
                    // ── HITUNG STATUS DOMINAN PAKAI LOGIKA RBS YANG SAMA DENGAN WEB ──
                    $semuaDominan = $items->pluck('nilai_dominan')->toArray();
                    $distribusi   = array_count_values($semuaDominan);
                    $distribusi   = array_merge(
                        ['BB' => 0, 'MB' => 0, 'BSH' => 0, 'BSB' => 0],
                        $distribusi
                    );
    
                    $maxVal    = max($distribusi);
                    $seri      = array_keys(array_filter($distribusi, fn($v) => $v === $maxVal));
                    $prioritas = ['BB' => 1, 'MB' => 2, 'BSH' => 3, 'BSB' => 4];
                    usort($seri, fn($a, $b) => $prioritas[$a] - $prioritas[$b]);
                    $dominanGlobal = $seri[0];
    
                    // Rule: ada BB → global maksimal MB
                    if (in_array('BB', $semuaDominan) && $prioritas[$dominanGlobal] > 2) {
                        $dominanGlobal = 'MB';
                    }
    
                    $statusMap = [
                        'BB'  => 'Belum Berkembang',
                        'MB'  => 'Mulai Berkembang',
                        'BSH' => 'Berkembang Sesuai Harapan',
                        'BSB' => 'Berkembang Sangat Baik',
                    ];
    
                    $avgConfidence = round($items->avg('confidence'));
                    $tema          = $items->first()->rpph->tema ?? '-';
    
                    return [
                        'minggu'         => $minggu,
                        'tema'           => $tema,
                        'nama_anak'      => $anak->nama_anak,
                        'kelompok'       => $anak->kelompok,
                        'foto'           => $anak->foto,
                        'status_dominan' => $statusMap[$dominanGlobal], // ← pakai RBS bukan avg
                        'avg_confidence' => $avgConfidence,
                        'jumlah_aspek'   => $items->count(),
                    ];
                })
                ->sortByDesc('minggu')
                ->values();
    
            return response()->json([
                'success' => true,
                'data'    => $list,
            ]);
    
        } catch (\Exception $e) {
            Log::error('List Analisis Error', ['message' => $e->getMessage(), 'line' => $e->getLine()]);
            return response()->json(['success' => false, 'message' => 'Gagal mengambil data analisis', 'error' => $e->getMessage()], 500);
        }
    }
    
    // ── 2. DETAIL HASIL ANALISIS PER MINGGU ──
    public function getDetailAnalisis(Request $request, $minggu)
    {
        try {
            $user     = $request->user();
            $orangTua = OrangTua::where('id_user', $user->id_user)->first();
    
            if (!$orangTua) {
                return response()->json(['success' => false, 'message' => 'Data orang tua tidak ditemukan'], 404);
            }
    
            $anak = $orangTua->anak()->first();
    
            if (!$anak) {
                return response()->json(['success' => false, 'message' => 'Data anak tidak ditemukan'], 404);
            }
    
            $hasilList = HasilAnalisis::with(['rpph', 'aspek'])
                ->where('id_anak', $anak->id_anak)
                ->whereHas('rpph', fn($q) => $q->where('minggu', $minggu))
                ->get();
    
            if ($hasilList->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Data analisis tidak ditemukan'], 404);
            }
    
            $rpph = $hasilList->first()->rpph;
    
            // ── HITUNG STATUS DOMINAN GLOBAL PAKAI RBS ──
            $semuaDominan = $hasilList->pluck('nilai_dominan')->toArray();
            $distribusi   = array_count_values($semuaDominan);
            $distribusi   = array_merge(
                ['BB' => 0, 'MB' => 0, 'BSH' => 0, 'BSB' => 0],
                $distribusi
            );
    
            $maxVal    = max($distribusi);
            $seri      = array_keys(array_filter($distribusi, fn($v) => $v === $maxVal));
            $prioritas = ['BB' => 1, 'MB' => 2, 'BSH' => 3, 'BSB' => 4];
            usort($seri, fn($a, $b) => $prioritas[$a] - $prioritas[$b]);
            $dominanGlobal = $seri[0];
    
            // Rule: ada BB → global maksimal MB
            if (in_array('BB', $semuaDominan) && $prioritas[$dominanGlobal] > 2) {
                $dominanGlobal = 'MB';
            }
    
            $statusMap = [
                'BB'  => 'Belum Berkembang',
                'MB'  => 'Mulai Berkembang',
                'BSH' => 'Berkembang Sesuai Harapan',
                'BSB' => 'Berkembang Sangat Baik',
            ];
    
            $statusDominanGlobal = $statusMap[$dominanGlobal];
    
            // Total capaian
            $totalBb  = $hasilList->sum('jumlah_bb');
            $totalMb  = $hasilList->sum('jumlah_mb');
            $totalBsh = $hasilList->sum('jumlah_bsh');
            $totalBsb = $hasilList->sum('jumlah_bsb');
    
            // Per aspek
            $perAspek = $hasilList->map(function ($item) {
                return [
                    'aspek'               => $item->aspek->nama_aspek ?? '-',
                    'nilai_dominan'       => $item->nilai_dominan ?? '-',
                    'status_perkembangan' => $item->status_perkembangan ?? '-',
                    'jumlah_bb'           => $item->jumlah_bb ?? 0,
                    'jumlah_mb'           => $item->jumlah_mb ?? 0,
                    'jumlah_bsh'          => $item->jumlah_bsh ?? 0,
                    'jumlah_bsb'          => $item->jumlah_bsb ?? 0,
                    'total_penilaian'     => $item->total_penilaian ?? 0,
                    'confidence'          => $item->confidence ?? 0,
                    'indikator_lemah'     => $item->indikator_lemah ?? [],
                    'rekomendasi_ai'      => $item->rekomendasi_ai ?? '-',
                    'ai_generated'        => $item->ai_generated ?? false,
                    'tanggal_analisis'    => $item->tanggal_analisis ?? '-',
                ];
            })->values();
    
            return response()->json([
                'success'        => true,
                'minggu'         => $minggu,
                'tema'           => $rpph->tema ?? '-',
                'nama_anak'      => $anak->nama_anak,
                'kelompok'       => $anak->kelompok,
                'foto'           => $anak->foto,
                'status_dominan' => $statusDominanGlobal, // ← field baru, pakai RBS
                'total_bb'       => $totalBb,
                'total_mb'       => $totalMb,
                'total_bsh'      => $totalBsh,
                'total_bsb'      => $totalBsb,
                'per_aspek'      => $perAspek,
            ]);
    
        } catch (\Exception $e) {
            Log::error('Detail Analisis Error', ['message' => $e->getMessage(), 'line' => $e->getLine()]);
            return response()->json(['success' => false, 'message' => 'Gagal mengambil detail analisis', 'error' => $e->getMessage()], 500);
        }
    }

}