<?php

namespace App\Notifications\Channels;

use Kreait\Firebase\Messaging;
use Illuminate\Notifications\Notification;

class FcmChannel
{
    protected $firebaseMessaging;

    public function __construct(Messaging $firebaseMessaging)
    {
        $this->firebaseMessaging = $firebaseMessaging;
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFcm($notifiable);

        if ($message) {
            // Send the FCM message to Firebase
            $this->firebaseMessaging->send($message);
        }
    }
}
