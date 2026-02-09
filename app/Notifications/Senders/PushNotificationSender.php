<?php

namespace App\Notifications\Senders;

use App\Notifications\Contracts\NotificationSender;

class PushNotificationSender implements NotificationSender
{
    public function send(string $message): void
    {
        \Log::info("Sending PUSH notification: $message");
    }
}
