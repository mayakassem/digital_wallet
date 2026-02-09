<?php

namespace App\Services\Webhooks;

use Illuminate\Http\Request;
use App\Models\BankWebhook;
use App\Models\Transaction;
use App\Services\Webhooks\BankResolverService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Notifications\Factories\NotificationServiceFactory;

class WebhookProcessingService
{
    public function __construct(
        private BankResolverService $bankResolverService,
    ) {}

    public function processWebhook(BankWebhook $webhook)
    {
        $bankName = $webhook->bank;
        $payload = $webhook->payload;

        $parser = $this->bankResolverService->resolveBank($bankName);
        $parsedData = $parser->parse($payload);

        Log::info('Parser returned data:', [
            'parsed_data' => $parsedData
        ]);

        $parsedReference = $parsedData['reference'] ?? null;
        $amount = $parsedData['amount'] ?? '0';


        $parsedDate = $parsedData['date'][0] ?? [
            'year' => Carbon::now()->year,
            'month' => Carbon::now()->month,
            'day' => Carbon::now()->day,
        ];

        Transaction::create([
            'client_id' => Client::factory()->create()->id,
            'reference' => $parsedReference,
            'amount' => $amount,
            'year' => $parsedDate['year'],
            'month' => $parsedDate['month'],
            'day' => $parsedDate['day'],
            'bank_name' => $bankName,
        ]);

        $notificationType = $this->resolveNotificationType($webhook);

        $notificationService = NotificationServiceFactory::make($notificationType);

        $notificationService->notify('Transaction completed');

        $webhook->update(['status' => 'processed']);
    }

    private function resolveNotificationType(BankWebhook $webhook): string
    {
        $payload = trim($webhook->payload, "\"");

        $payload = stripslashes($payload);

        $notificationType = str()->afterLast($payload, '=');

        $notificationType = strtolower(trim($notificationType, "\"' \t\n\r"));

        Log::info('Resolved notification type FINAL', [
            'type' => $notificationType
        ]);

        return in_array($notificationType, ['sms', 'email', 'push'])
            ? $notificationType
            : 'email';
    }


}