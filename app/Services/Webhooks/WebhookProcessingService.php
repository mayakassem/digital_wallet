<?php

namespace App\Services\Webhooks;

use Illuminate\Http\Request;
use App\Models\BankWebhook;
use App\Services\Webhooks\BankResolverService;

class WebhookProcessingService
{
    public function processWebhook(BankWebhook $webhook)
    {
        $BankName = $webhook->bank;
        $payload = $webhook->payload;

        $parser = BankResolverService::resolveBank($BankName);
        $parsedData = $parser->parse($payload);
    }
}