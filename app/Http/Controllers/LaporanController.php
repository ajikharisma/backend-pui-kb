<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Anak;
use App\Models\Penilaian;
use App\Models\HasilAnalisis;
use App\Models\Guru;
use App\Models\Rpph;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    // =========================================================
    // LAPORAN 1 — DATA PERKEMBANGAN HARIAN (per minggu)
    // =========================================================
    public function laporanPerkembangan(string $id_anak, string $minggu)
    {
        $guru = Auth::user()->guru;
        $anak = Anak::with('orangTua.user')->findOrFail($id_anak);

        // Ambil RPPH minggu ini
        $rpph = Rpph::where('minggu', $minggu)->first();
        if (!$rpph) {
            return back()->with('error', 'Data RPPH tidak ditemukan');
        }

        // Ambil semua penilaian minggu ini
        $penilaian = Penilaian::with(['indikator.aspek', 'rpph', 'asesmen'])
            ->where('id_anak', $id_anak)
            ->whereHas('rpph', fn($q) => $q->where('minggu', $minggu))
            ->orderBy('tanggal', 'asc')
            ->get();

        // Kelompokkan per hari
        $perHari = $penilaian->groupBy('tanggal');

        // Kelompokkan per aspek
        $perAspek = $penilaian->groupBy(
            fn($p) => $p->indikator->aspek->nama_aspek
        );

        $data = [
            'nama_sekolah' => "KB Nurul Ain",
            'guru'         => $guru->user->nama ?? '-',
            'kelompok'     => $guru->kelompok ?? '-',
            'periode'      => $penilaian->first()?->periode ?? '-',
            'minggu'       => $minggu,
            'tema'         => $rpph->tema ?? '-',
            'semester'     => $rpph->semester ?? '-',
            'anak'         => $anak,
            'penilaian'    => $penilaian,
            'perHari'      => $perHari,
            'perAspek'     => $perAspek,
            'tanggal_cetak'=> now()->translatedFormat('d F Y'),
        ];

        $pdf = Pdf::loadView('laporan.perkembangan', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
            ]);

        $namaFile = "Laporan-Perkembangan-{$anak->nama_anak}-Minggu{$minggu}.pdf";

        return $pdf->download($namaFile);
    }

    // =========================================================
    // LAPORAN 2 — HASIL ANALISIS (per minggu)
    // =========================================================
    public function laporanAnalisis(string $id_anak, string $minggu)
    {
        $guru = Auth::user()->guru;
        $anak = Anak::with('orangTua.user')->findOrFail($id_anak);

        $rpph = Rpph::where('minggu', $minggu)->first();
        if (!$rpph) {
            return back()->with('error', 'Data RPPH tidak ditemukan');
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

        // Susun data per aspek
        $hasilAnalisis = $hasilDb->map(fn($item) => [
            'aspek'           => $item->aspek->nama_aspek,
            'nilai_dominan'   => $item->nilai_dominan,
            'status'          => $item->status_perkembangan,
            'distribusi'      => [
                'BB'  => $item->jumlah_bb,
                'MB'  => $item->jumlah_mb,
                'BSH' => $item->jumlah_bsh,
                'BSB' => $item->jumlah_bsb,
            ],
            'total'           => $item->total_penilaian,
            'confidence'      => $item->confidence,
            'reliable'        => $item->total_penilaian >= 3,
            'indikator_lemah' => is_array($item->indikator_lemah)
                                    ? $item->indikator_lemah
                                    : (json_decode($item->indikator_lemah, true) ?? []),
        ])->toArray();

        // Hitung status global
        $semuaDominan     = array_column($hasilAnalisis, 'nilai_dominan');
        $distribusiGlobal = array_count_values($semuaDominan);
        $distribusiGlobal = array_merge(
            ['BB' => 0, 'MB' => 0, 'BSH' => 0, 'BSB' => 0],
            $distribusiGlobal
        );

        $maxVal    = max($distribusiGlobal);
        $seri      = array_keys(array_filter($distribusiGlobal, fn($v) => $v === $maxVal));
        $prioritas = ['BB' => 1, 'MB' => 2, 'BSH' => 3, 'BSB' => 4];
        usort($seri, fn($a, $b) => $prioritas[$a] - $prioritas[$b]);
        $dominanGlobal = $seri[0];

        if (in_array('BB', $semuaDominan) && $prioritas[$dominanGlobal] > 2) {
            $dominanGlobal = 'MB';
        }

        $statusMap = [
            'BB'  => 'Belum Berkembang',
            'MB'  => 'Mulai Berkembang',
            'BSH' => 'Berkembang Sesuai Harapan',
            'BSB' => 'Berkembang Sangat Baik',
        ];

        $data = [
            'nama_sekolah'   => "KB Nurul Ain",
            'guru'           => $guru->user->nama ?? '-',
            'kelompok'       => $guru->kelompok ?? '-',
            'periode'        => $hasilDb->first()?->periode ?? '-',
            'minggu'         => $minggu,
            'tema'           => $rpph->tema ?? '-',
            'semester'       => $rpph->semester ?? '-',
            'anak'           => $anak,
            'hasilAnalisis'  => $hasilAnalisis,
            'statusGlobal'   => $statusMap[$dominanGlobal],
            'dominanGlobal'  => $dominanGlobal,
            'rekomendasiAI'  => $rekomendasiAI,
            'tanggalAnalisis'=> $hasilDb->first()?->tanggal_analisis,
            'tanggal_cetak'  => now()->translatedFormat('d F Y'),
        ];

        $pdf = Pdf::loadView('laporan.analisis', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'          => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
            ]);

        $namaFile = "Laporan-Analisis-{$anak->nama_anak}-Minggu{$minggu}.pdf";

        return $pdf->download($namaFile);
    }
}