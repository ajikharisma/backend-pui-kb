<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\HasilAnalisis;

class AnalisisController extends Controller
{
    public function generate(Request $request)
    {
        try {
            // 🔥 VALIDASI
            $request->validate([
                'id_anak' => 'required|exists:anak,id_anak',
                'periode' => 'required',
                'tanggal_awal' => 'required|date',
                'tanggal_akhir' => 'required|date'
            ]);

            // 🔥 CEK DUPLIKAT
            $cek = HasilAnalisis::where('id_anak', $request->id_anak)
                ->where('periode', $request->periode)
                ->first();

            if ($cek) {
                return response()->json([
                    'error' => 'Analisis untuk periode ini sudah ada'
                ], 400);
            }

            // 🔥 AMBIL DATA PENILAIAN
            $data = Penilaian::where('id_anak', $request->id_anak)
                ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'error' => 'Tidak ada data penilaian di periode ini'
                ], 404);
            }

            // 🔥 KONVERSI NILAI
            $mapping = [
                'BSB' => 4,
                'BSH' => 3,
                'MB' => 2,
                'BB' => 1
            ];

            $total = 0;

            foreach ($data as $d) {
                $total += $mapping[$d->nilai];
            }

            $rata = $total / count($data);

            // 🔥 TENTUKAN STATUS
            if ($rata >= 3.5) {
                $status = 'Berkembang Sangat Baik';
            } elseif ($rata >= 2.5) {
                $status = 'Berkembang Sesuai Harapan';
            } elseif ($rata >= 1.5) {
                $status = 'Mulai Berkembang';
            } else {
                $status = 'Belum Berkembang';
            }

            // 🔥 REKOMENDASI (VERSI ORANG TUA)
            $rekomendasi = $this->generateRekomendasi($status);

            // 🔥 SIMPAN
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
                'error' => true,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    private function generateRekomendasi($status)
    {
        return match ($status) {
            'Berkembang Sangat Baik' =>
                'Anak berkembang sangat baik. Orang tua dapat memberikan aktivitas yang lebih menantang seperti permainan edukatif lanjutan.',

            'Berkembang Sesuai Harapan' =>
                'Perkembangan anak sudah sesuai. Orang tua disarankan tetap memberikan stimulasi rutin di rumah.',

            'Mulai Berkembang' =>
                'Anak mulai berkembang. Orang tua perlu memberikan pendampingan lebih intens dan latihan berulang.',

            default =>
                'Perkembangan anak masih perlu perhatian khusus. Orang tua disarankan lebih aktif mendampingi dan melatih anak setiap hari.'
        };
    }
}