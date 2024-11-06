<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class FcmChannel
{
    public function send($notifiable, Notification $notification)
    {
        $fcmData = $notification->toFcm($notifiable);
        $serverKey = config('services.fcm.server_key');

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'to' => $notifiable->device_token, // You should have the `device_token` saved for each user.
            'notification' => $fcmData['notification'],
            'data' => $fcmData['data'] ?? [],
        ]);

        return $response->json();
    }
}
