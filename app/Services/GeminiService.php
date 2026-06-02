<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $model;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey  = (string) config('services.gemini.api_key');
        $this->model   = (string) config('services.gemini.model', 'gemini-2.0-flash');
        $this->baseUrl = "https://generativelanguage.googleapis.com/v1beta/models";
    }

    // =========================================================
    // PROMPT — versi ringkas supaya hemat token
    // =========================================================

    public function susunPrompt(array $konteks): string
    {
        $namaAnak = $konteks['anak']['nama'];
        $tema     = $konteks['tema'];
        $minggu   = $konteks['minggu'];
        $periode  = $konteks['periode'];

        // Pisahkan aspek berdasarkan status
        $aspekBagus  = [];
        $aspekSedang = [];
        $aspekLemah  = [];

        foreach ($konteks['hasil_per_aspek'] as $h) {
            $lemah = !empty($h['indikator_lemah'])
                ? implode(', ', array_column($h['indikator_lemah'], 'nama'))
                : null;

            $baris = "- {$h['aspek']}: {$h['status']}";
            if ($lemah) {
                $baris .= " | indikator yang belum optimal: {$lemah}";
            }

            if (in_array($h['dominan'], ['BSB'])) {
                $aspekBagus[] = $baris;
            } elseif (in_array($h['dominan'], ['BSH'])) {
                $aspekSedang[] = $baris;
            } else {
                // MB dan BB
                $aspekLemah[] = $baris;
            }
        }

        $bagusStr  = !empty($aspekBagus)  ? implode("\n", $aspekBagus)  : '- (tidak ada)';
        $sedangStr = !empty($aspekSedang) ? implode("\n", $aspekSedang) : '- (tidak ada)';
        $lemahStr  = !empty($aspekLemah)  ? implode("\n", $aspekLemah)  : '- (tidak ada)';

        return "Kamu adalah asisten pendidik PAUD yang jujur, hangat, dan objektif.
    Tugasmu membuat laporan perkembangan anak yang BERIMBANG — tidak hanya memuji, tapi juga menunjukkan area yang benar-benar perlu ditingkatkan secara jelas dan spesifik.

    DATA ANAK:
    Nama    : {$namaAnak}
    Periode : {$periode}, Minggu ke-{$minggu}
    Konteks : Tema pembelajaran minggu ini adalah \"{$tema}\" (gunakan hanya sebagai latar belakang, bukan fokus utama)

    HASIL ANALISIS PERKEMBANGAN:

    [BERKEMBANG SANGAT BAIK]
    {$bagusStr}

    [BERKEMBANG SESUAI HARAPAN]
    {$sedangStr}

    [PERLU PERHATIAN — MB / BB]
    {$lemahStr}

    KETERANGAN SKALA:
    BB  = Belum Berkembang  → perlu stimulasi intensif dan konsisten
    MB  = Mulai Berkembang  → perlu latihan rutin dan pendampingan aktif
    BSH = Berkembang Sesuai Harapan → sudah baik, pertahankan
    BSB = Berkembang Sangat Baik → beri tantangan lebih lanjut

    INSTRUKSI PENULISAN:
    1. Jujur dan berimbang — jangan hanya fokus pada hal positif
    2. Jika ada aspek MB/BB, sampaikan dengan jelas apa yang perlu diperbaiki
    3. Rekomendasi aktivitas harus spesifik pada indikator yang lemah, bukan tema
    4. Gunakan bahasa yang hangat tapi tetap tegas dan informatif
    5. Jangan gunakan istilah teknis pendidikan
    6. Maksimal 200 kata

    FORMAT JAWABAN:

    ## Perkembangan {$namaAnak} Minggu Ini
    [Gambaran jujur — sebutkan aspek yang sudah bagus DAN yang masih perlu ditingkatkan. Jangan hanya memuji.]

    ## Yang Perlu Diperhatikan
    [Sebutkan secara spesifik indikator mana yang masih MB/BB dan mengapa ini penting untuk segera distimulasi. Kosongkan bagian ini hanya jika semua aspek BSH/BSB.]

    ## Aktivitas di Rumah
    [3 aktivitas konkret yang langsung menyasar indikator yang lemah. Kalau tidak ada yang lemah, beri tantangan lanjutan untuk aspek BSB.]

    ## Pesan untuk Orang Tua
    [1-2 kalimat yang realistis — apresiasi usaha orang tua tapi ingatkan pentingnya konsistensi pendampingan.]";
        }

    // =========================================================
    // GENERATE — dengan delay lebih panjang untuk free tier
    // =========================================================

    public function generate(string $prompt, int $maxRetry = 3): ?string
    {
        // Jeda awal sebelum request pertama
        // Supaya tidak langsung kena rate limit jika baru saja request sebelumnya
        sleep(3);

        $lastError = null;

        for ($attempt = 1; $attempt <= $maxRetry; $attempt++) {

            try {
                Log::info("[GEMINI] Attempt {$attempt}/{$maxRetry}");

                $response = Http::timeout(60)
                    ->post(
                        "{$this->baseUrl}/{$this->model}:generateContent?key={$this->apiKey}",
                        [
                            'contents' => [
                                [
                                    'parts' => [
                                        ['text' => $prompt]
                                    ]
                                ]
                            ],
                            'generationConfig' => [
                                'temperature'     => 0.7,
                                'maxOutputTokens' => 2048,
                            ]
                        ]
                    );

                Log::info('[GEMINI] Status: ' . $response->status());

                // Rate limit — tunggu lebih lama
                if ($response->status() === 429) {
                    $delay = match($attempt) {
                        1 => 30,   // tunggu 30 detik
                        2 => 60,   // tunggu 60 detik
                        3 => 90,   // tunggu 90 detik
                        default => 30,
                    };

                    Log::warning("[GEMINI] Rate limit attempt {$attempt}, tunggu {$delay}s");
                    sleep($delay);
                    continue;
                }

                if ($response->failed()) {
                    throw new \Exception(
                        "Gemini error HTTP " . $response->status() . ": " . $response->body()
                    );
                }

                $teks = $response->json('candidates.0.content.parts.0.text');
                Log::info('[GEMINI FULL TEXT]');
                Log::info($teks);

                if (!$teks) {
                    Log::error('[GEMINI] Teks kosong. Response: ' . substr($response->body(), 0, 300));
                    throw new \Exception("Response Gemini tidak mengandung teks");
                }

                Log::info('[GEMINI] Berhasil! Panjang teks: ' . strlen($teks));
                return $teks;

            } catch (\Exception $e) {
                $lastError = $e;
                Log::error("[GEMINI ERROR] Attempt {$attempt}: " . $e->getMessage());

                if ($attempt < $maxRetry) {
                    $delay = 30 * $attempt;
                    Log::info("[GEMINI] Tunggu {$delay}s sebelum retry...");
                    sleep($delay);
                }
            }
        }

        Log::error('[GEMINI FAILED] Semua retry gagal: ' . $lastError?->getMessage());
        return null;
    }
}