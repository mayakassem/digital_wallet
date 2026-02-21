<?php

namespace App\Builders;

interface ProductBuilderInterface
{
    public function produceDetails(array $data): void;
    public function produceVariants(array $variants): void;
    public function produceShipping(array $shippingIds): void;
    public function getProduct();
}