<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankWebhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank',
        'payload',
        'status',
        'received_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
    ];
}
