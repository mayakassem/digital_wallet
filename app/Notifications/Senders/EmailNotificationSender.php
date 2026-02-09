<?php

namespace App\Notifications\Senders;

use App\Notifications\Contracts\NotificationSender;

class EmailNotificationSender implements NotificationSender
{
    public function send(string $message): void
    {
        \Log::info("Sending EMAIL notification: $message");
    }
}
