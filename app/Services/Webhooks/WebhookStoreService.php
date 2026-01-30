<?php

namespace App\Services\Webhooks;

use Illuminate\Http\Request;
use App\Models\BankWebhook;
use App\Jobs\ProcessWebhookJob;

class WebhookStoreService
{
    public function storeWebhook(Request $request)
    {
        $bank = $this->getBankName($request);
        $payload = $this->getRawPayload($request);

        $webhook = BankWebhook::create([
            'bank' => $bank,
            'payload' => $payload,
            'status' => 'pending',
            'received_at' => now(),
        ]);

        ProcessWebhookJob::dispatch($webhook);
    }

    private function getBankName(Request $request)
    {
        return $request->header('X-Bank-Name' , 'Unknown');
    }

    private function getRawPayload(Request $request): string
    {
        return $request->getContent();
    }
}