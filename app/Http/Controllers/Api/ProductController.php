<?php

namespace App\Http\Controllers\Api;

use App\Builders\ProductBuilderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request, ProductBuilderInterface $builder)
    {
        $builder->produceDetails(
            $request->only('name','description','price')
        );

        $builder->produceVariants(
            $request->variants ?? []
        );

        $builder->produceShipping(
            $request->shipping_methods ?? []
        );

        $product = $builder->getProduct();

        return response()->json($product);
    }
}
