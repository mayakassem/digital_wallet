<?php

namespace App\Jobs;

use App\Models\BankWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessWebhookJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public BankWebhook $webhook
    ) {}

    /**
     * Execute the job.
     */
    public function handle(WebhookProcessingService $webhookProcessingService): void
    {
        $webhookProcessingService->processWebhook($this->webhook);
    }
}
