<?php

namespace App\Services;

use GuzzleHttp\Client;

class FcmService
{
    protected $client;
    protected $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    protected $serverKey = '7cf9fadf9dc76e7028bf4587ba1f5e32f49c961b'; // Replace with your actual FCM server key

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendNotification($deviceToken, $title, $body, $data = [])
    {
        $payload = [
            'to' => $deviceToken,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => $data, // Custom data if needed
        ];

        try {
            $response = $this->client->post($this->fcmUrl, [
                'headers' => [
                    'Authorization' => 'key=' . $this->serverKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
