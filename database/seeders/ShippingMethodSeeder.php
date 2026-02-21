<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Standard Shipping',
                'price' => 30
            ],
            [
                'name' => 'Express Shipping',
                'price' => 60
            ],
            [
                'name' => 'Same Day Delivery',
                'price' => 100
            ]
        ];

        foreach ($methods as $method) {
            ShippingMethod::updateOrCreate(
                ['name' => $method['name']],
                ['price' => $method['price']]
            );
        }
    }
}