<?php

namespace App\Notifications\Contracts;

interface NotificationSender
{
    public function send(string $message): void;
}
