<?php

namespace App\Services;

use App\Models\Anak;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    private FcmNotificationService $fcm;

    public function __construct()
    {
        $this->fcm = new FcmNotificationService();
    }

    // =========================================================
    // 🔥 NOTIFIKASI PENILAIAN HARIAN (DIGABUNG, 1x PER HARI)
    // =========================================================
    // Dipanggil setiap kali guru menyimpan 1 penilaian baru.
    // Kalau hari ini sudah pernah kirim notif untuk anak ini,
    // tidak akan kirim lagi (anti-spam).
    // =========================================================

    public function kirimNotifPenilaianHarian(string $idAnak, string $tanggal): void
    {
        try {
            $anak = Anak::with('orangTua.user')->find($idAnak);

            if (!$anak || !$anak->orangTua || !$anak->orangTua->user) {
                Log::warning("[NOTIF] Anak/orang tua tidak ditemukan untuk id_anak: {$idAnak}");
                return;
            }

            $user = $anak->orangTua->user;

            // Cek apakah notifikasi untuk anak ini di tanggal ini SUDAH ada
            $sudahAda = Notifikasi::where('id_anak', $idAnak)
                ->where('jenis', 'penilaian_harian')
                ->where('tanggal', $tanggal)
                ->exists();

            if ($sudahAda) {
                // Sudah pernah kirim hari ini — tidak kirim lagi (anti-spam)
                return;
            }

            $judul = 'Penilaian Hari Ini Tersedia';
            $pesan = "Guru telah menambahkan penilaian baru untuk {$anak->nama_anak} hari ini. Yuk cek perkembangannya!";

            // Simpan ke tabel notifikasi (riwayat di app)
            $notif = Notifikasi::create([
                'id_user'     => $user->id_user,
                'id_anak'     => $idAnak,
                'judul'       => $judul,
                'jenis'       => 'penilaian_harian',
                'pesan'       => $pesan,
                'status_baca' => false,
                'tanggal'     => $tanggal,
            ]);

            // Kirim push notification kalau ada FCM token
            if ($user->fcm_token) {
                $this->fcm->kirim(
                    $user->fcm_token,
                    $judul,
                    $pesan,
                    [
                        'jenis'   => 'penilaian_harian',
                        'id_anak' => $idAnak,
                    ]
                );
            }

            Log::info("[NOTIF] Notifikasi penilaian harian terkirim untuk anak: {$anak->nama_anak}");

        } catch (\Exception $e) {
            Log::error('[NOTIF ERROR] Gagal kirim notif penilaian harian', [
                'message' => $e->getMessage(),
                'id_anak' => $idAnak,
            ]);
        }
    }

    // =========================================================
    // 🔥 NOTIFIKASI HASIL ANALISIS AI (PER MINGGU)
    // =========================================================
    // Dipanggil setelah RBS + Gemini selesai memproses analisis.
    // =========================================================

    public function kirimNotifHasilAnalisis(string $idAnak, string $minggu, string $statusGlobal): void
    {
        try {
            $anak = Anak::with('orangTua.user')->find($idAnak);

            if (!$anak || !$anak->orangTua || !$anak->orangTua->user) {
                Log::warning("[NOTIF] Anak/orang tua tidak ditemukan untuk id_anak: {$idAnak}");
                return;
            }

            $user = $anak->orangTua->user;

            $judul = 'Hasil Analisis Minggu Ini Sudah Tersedia';
            $pesan = "Hasil analisis perkembangan {$anak->nama_anak} untuk minggu ke-{$minggu} sudah tersedia. Status: {$statusGlobal}. Lihat rekomendasi lengkapnya sekarang!";

            // Simpan ke tabel notifikasi
            Notifikasi::create([
                'id_user'     => $user->id_user,
                'id_anak'     => $idAnak,
                'judul'       => $judul,
                'jenis'       => 'hasil_analisis',
                'pesan'       => $pesan,
                'status_baca' => false,
                'tanggal'     => now()->toDateString(),
            ]);

            // Kirim push notification
            if ($user->fcm_token) {
                $this->fcm->kirim(
                    $user->fcm_token,
                    $judul,
                    $pesan,
                    [
                        'jenis'   => 'hasil_analisis',
                        'id_anak' => $idAnak,
                        'minggu'  => $minggu,
                    ]
                );
            }

            Log::info("[NOTIF] Notifikasi hasil analisis terkirim untuk anak: {$anak->nama_anak}, minggu: {$minggu}");

        } catch (\Exception $e) {
            Log::error('[NOTIF ERROR] Gagal kirim notif hasil analisis', [
                'message' => $e->getMessage(),
                'id_anak' => $idAnak,
                'minggu'  => $minggu,
            ]);
        }
    }
}