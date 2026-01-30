<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Parsers\PayTechBankParser;

Route::get('/test', function () {

    $payload = '20250616,200.00#202506159000002#note/rent';

    $parser = new PayTechBankParser();

    return $parser->parse($payload);
});
