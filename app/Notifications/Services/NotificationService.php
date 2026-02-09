<?php

namespace App\Notifications\Services;

use App\Notifications\Contracts\NotificationSender;

abstract class NotificationService
{
    abstract protected function createSender(): NotificationSender;

    public function notify(string $message): void
    {
        $sender = $this->createSender();
        $sender->send($message);
    }
}
