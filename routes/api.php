<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\ProductController;

Route::post('/webhook', [WebhookController::class, 'store']);

Route::post('/products', [ProductController::class, 'store']);

