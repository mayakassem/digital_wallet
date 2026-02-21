<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function shippingMethods()
    {
        return $this->belongsToMany(ShippingMethod::class);
    }
}
