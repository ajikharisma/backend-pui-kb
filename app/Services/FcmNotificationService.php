<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Illuminate\Support\Facades\Log;

class FcmNotificationService
{
    private $messaging;

    public function __construct()
    {
        $factory = (new Factory())
            ->withServiceAccount(storage_path('app/firebase/firebase-credentials.json'));

        $this->messaging = $factory->createMessaging();
    }

    public function kirim(string $fcmToken, string $judul, string $isi, array $data = []): bool
    {
        if (empty($fcmToken)) {
            Log::warning('[FCM] Token kosong, notifikasi tidak dikirim');
            return false;
        }

        try {
            $message = CloudMessage::fromArray([
                'token' => $fcmToken,
                'notification' => [
                    'title' => $judul,
                    'body'  => $isi,
                ],
                'data' => $data,
            ]);

            $this->messaging->send($message);

            Log::info("[FCM] Notifikasi terkirim: {$judul}");
            return true;

        } catch (\Exception $e) {
            Log::error('[FCM] Gagal kirim notifikasi', [
                'message' => $e->getMessage(),
                'judul'   => $judul,
            ]);
            return false;
        }
    }
}