<?php

namespace App\Notifications\Senders;

use App\Notifications\Contracts\NotificationSender;

class SmsNotificationSender implements NotificationSender
{
    public function send(string $message): void
    {
        \Log::info("Sending SMS notification: $message");
    }
}
