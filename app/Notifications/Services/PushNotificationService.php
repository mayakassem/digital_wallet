<?php

namespace App\Notifications\Services;

use App\Notifications\Contracts\NotificationSender;
use App\Notifications\Senders\PushNotificationSender;

class PushNotificationService extends NotificationService
{
    protected function createSender(): NotificationSender
    {
        return new PushNotificationSender();
    }
}
