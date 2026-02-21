<?php

namespace App\Builders;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use app\Builders\ProductBuilderInterface;

class ProductConcreteBuilder implements ProductBuilderInterface
{
    private Product $product;
    private array $variants = [];
    private array $shippingIds = [];

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new Product();
        $this->variants = [];
        $this->shippingIds = [];
    }

    public function produceDetails(array $data): void
    {
        $this->product->fill($data);
    }

    public function produceVariants(array $variants): void
    {
        $this->variants = $variants;
    }

    public function produceShipping(array $shippingIds): void
    {
        $this->shippingIds = $shippingIds;
    }

    public function getProduct(): Product
    {
        DB::transaction(function () {

            $this->product->save();

            foreach ($this->variants as $variant) {
                $this->product->variants()->create($variant);
            }

            if (!empty($this->shippingIds)) {
                $this->product->shippingMethods()->sync($this->shippingIds);
            }
        });

        $result = $this->product->fresh(['variants', 'shippingMethods']);

        $this->reset();

        return $result;
    }
}