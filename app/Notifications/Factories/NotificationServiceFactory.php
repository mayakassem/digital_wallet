<?php

namespace App\Notifications\Factories;

use App\Notifications\Services\{
    EmailNotificationService,
    SmsNotificationService,
    PushNotificationService,
    NotificationService
};

class NotificationServiceFactory
{
    public static function make(string $type): NotificationService
    {
        \Log::info("Notification type: " . $type);
        return match ($type) {
            'email' => new EmailNotificationService(),
            'sms'   => new SmsNotificationService(),
            'push'  => new PushNotificationService(),
            default => throw new \InvalidArgumentException("Invalid notification type"),
        };
    }
}
