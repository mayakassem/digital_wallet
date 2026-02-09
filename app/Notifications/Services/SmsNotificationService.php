<?php

namespace App\Notifications\Services;

use App\Notifications\Contracts\NotificationSender;
use App\Notifications\Senders\SmsNotificationSender;

class SmsNotificationService extends NotificationService
{
    protected function createSender(): NotificationSender
    {
        return new SmsNotificationSender();
    }
}
