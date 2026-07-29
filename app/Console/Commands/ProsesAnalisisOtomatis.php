<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Penilaian;
use App\Models\HasilAnalisis;
use App\Models\Rpph;
use App\Http\Controllers\PenilaianController;
use Illuminate\Support\Facades\Log;

class ProsesAnalisisOtomatis extends Command
{
    // Nama command yang dipanggil di terminal
    protected $signature = 'analisis:otomatis';

    // Deskripsi command
    protected $description = 'Proses analisis perkembangan otomatis setiap akhir minggu';

    public function handle()
    {
        $this->info('Memulai proses analisis otomatis...');
        Log::info('[SCHEDULER] Proses analisis otomatis dimulai');

        // Ambil semua kombinasi id_anak + minggu yang BELUM dianalisis
        $penilaianList = Penilaian::with(['anak', 'rpph'])
            ->get()
            ->unique(function ($item) {
                return $item->id_anak . '-' . ($item->rpph->minggu ?? '0');
            });

        $controller = new PenilaianController();
        $berhasil = 0;
        $gagal    = 0;

        foreach ($penilaianList as $item) {
            // Cek apakah minggu ini sudah dianalisis
            $sudahAda = HasilAnalisis::where('id_anak', $item->id_anak)
                ->whereHas('rpph', function ($q) use ($item) {
                    $q->where('minggu', $item->rpph->minggu ?? 0);
                })
                ->exists();

            // Kalau sudah dianalisis, skip
            if ($sudahAda) {
                continue;
            }

            try {
                // Panggil method prosesAnalisis dari controller
                $controller->prosesAnalisisOtomatis(
                    $item->id_anak,
                    $item->rpph->minggu ?? 0
                );

                $berhasil++;
                $this->info("✓ Berhasil: {$item->anak->nama_anak} Minggu {$item->rpph->minggu}");
                Log::info('[SCHEDULER] Berhasil analisis', [
                    'anak'  => $item->anak->nama_anak,
                    'minggu'=> $item->rpph->minggu,
                ]);

            } catch (\Exception $e) {
                $gagal++;
                $this->error("✗ Gagal: {$item->anak->nama_anak} — {$e->getMessage()}");
                Log::error('[SCHEDULER] Gagal analisis', [
                    'anak'   => $item->anak->nama_anak,
                    'minggu' => $item->rpph->minggu,
                    'error'  => $e->getMessage(),
                ]);
            }
        }

        $this->info("Selesai. Berhasil: {$berhasil}, Gagal: {$gagal}");
        Log::info("[SCHEDULER] Selesai. Berhasil: {$berhasil}, Gagal: {$gagal}");
    }
}