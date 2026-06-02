<?php

namespace App\Http\Controllers;

use App\Models\HasilAnalisis;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class HasilAnalisisController extends Controller
{
    // 🔥 AMBIL DATA BERDASARKAN ANAK + PERIODE
    public function showByAnakDanPeriode($id, $periode)
    {
        $data = HasilAnalisis::with(['anak','penilaian'])
            ->where('id_anak', $id)
            ->where('periode', $periode)
            ->get();

        return response()->json($data);
    }

    // 🔥 LIST DATA (OPTIONAL FILTER)
    public function index(Request $request)
    {
        try {
            $query = HasilAnalisis::with(['anak', 'penilaian']);

            if ($request->id_anak) {
                $query->where('id_anak', $request->id_anak);
            }

            $data = $query->get();

            return response()->json([
                'message' => 'Data hasil analisis berhasil diambil',
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 GENERATE ANALISIS (INI YANG PENTING)
    public function generate(Request $request)
    {
        try {
            // VALIDASI
            $request->validate([
                'id_anak' => 'required|exists:anak,id_anak',
                'periode' => 'required'
            ]);

            // 🔥 AMBIL SEMUA PENILAIAN ANAK
            list($start, $end) = $this->getTanggalDariPeriode($request->periode);

            $penilaians = Penilaian::where('id_anak', $request->id_anak)
                ->whereBetween('tanggal', [$start, $end])
                ->get();

            if ($penilaians->isEmpty()) {
                return response()->json([
                    'error' => 'Belum ada data penilaian untuk anak ini'
                ], 400);
            }

            // 🔥 HITUNG STATUS DARI BANYAK DATA
            $status = $this->hitungStatusDariPenilaian($penilaians);

            // 🔥 REKOMENDASI (SIMPLE DULU)
            $rekomendasi = $this->generateRekomendasi($status);

            // 🔥 SIMPAN KE DATABASE
            $hasil = HasilAnalisis::create([
                'id_anak' => $request->id_anak,
                'periode' => $request->periode,
                'status_perkembangan' => $status,
                'rekomendasi' => $rekomendasi,
                'tanggal' => now()
            ]);

            return response()->json([
                'message' => 'Analisis berhasil dibuat',
                'data' => $hasil
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 LOGIC HITUNG DARI BANYAK PENILAIAN
    private function hitungStatusDariPenilaian($penilaians)
    {
        $mapping = [
            'BSB' => 4,
            'BSH' => 3,
            'MB'  => 2,
            'BB'  => 1,
        ];

        $total = 0;
        $count = 0;

        foreach ($penilaians as $p) {
            if (isset($mapping[$p->nilai])) {
                $total += $mapping[$p->nilai];
                $count++;
            }
        }

        if ($count == 0) {
            return 'Belum Berkembang';
        }

        $avg = $total / $count;

        if ($avg >= 3.5) return 'Berkembang Sangat Baik';
        if ($avg >= 2.5) return 'Berkembang Sesuai Harapan';
        if ($avg >= 1.5) return 'Mulai Berkembang';
        return 'Belum Berkembang';
    }

    // 🔥 REKOMENDASI UNTUK ORANG TUA
    private function generateRekomendasi($status)
    {
        return match ($status) {
            'Berkembang Sangat Baik' => 'Anak berkembang sangat baik. Orang tua dapat memberikan aktivitas yang lebih menantang seperti permainan edukatif lanjutan.',
            'Berkembang Sesuai Harapan' => 'Anak berkembang sesuai harapan. Orang tua disarankan tetap memberikan stimulasi yang konsisten di rumah.',
            'Mulai Berkembang' => 'Anak mulai berkembang. Orang tua perlu memberikan pendampingan lebih intens dan latihan rutin.',
            default => 'Anak belum berkembang optimal. Orang tua perlu memberikan perhatian khusus dan bimbingan secara rutin.'
        };
    }

    private function getTanggalDariPeriode($periode)
    {
        // format: 2026-06-minggu-1
        $parts = explode('-minggu-', $periode);

        $tahunBulan = $parts[0]; // 2026-06
        $minggu = (int)$parts[1]; // 1, 2, 3, dst

        // tentukan range tanggal
        $startDay = ($minggu - 1) * 7 + 1;
        $endDay = $minggu * 7;

        $start = $tahunBulan . '-' . str_pad($startDay, 2, '0', STR_PAD_LEFT);
        $end   = $tahunBulan . '-' . str_pad($endDay, 2, '0', STR_PAD_LEFT);

        return [$start, $end];
    }
}