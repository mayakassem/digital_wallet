<?php

namespace App\Notifications\Services;

use App\Notifications\Contracts\NotificationSender;
use App\Notifications\Senders\EmailNotificationSender;

class EmailNotificationService extends NotificationService
{
    protected function createSender(): NotificationSender
    {
        return new EmailNotificationSender();
    }
}
