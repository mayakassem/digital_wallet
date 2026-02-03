<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'reference',
        'amount',
        'year',
        'month',
        'day',
        'bank_name',
    ];

     protected $casts = [
        'amount' => 'decimal:2',
    ];

    //relations

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    //scope methods

    public function scopeUniqueReference($query)
    {
        return $query->where('reference', 'unique');
    }
}
