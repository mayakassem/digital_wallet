<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Webhooks\WebhookStoreService;

class WebhookController extends Controller
{
    public function __construct(
        private WebhookStoreService $webhookStoreService,
    ) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->webhookStoreService->storeWebhook($request);
        return response()->json(['status' => 'ok']);
    }
}
