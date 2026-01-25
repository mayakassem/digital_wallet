<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\BankWebhook;

class WebhookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bank = $request->header('X-Bank-Name');
        $payload = $request->json();

        BankWebhook::create([
            'bank' => $bank,
            'payload' => $payload,
            'status' => 'pending',
            'received_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }
}
