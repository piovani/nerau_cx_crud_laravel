<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\Product\CreateProduct;
use App\Services\Product\DeleteProduct;
use App\Services\Product\GetProduct;
use App\Services\Product\UpdateProduct;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(ProductRequest $request)
    {
        /** @var Product $product */
        $product = call_user_func(new CreateProduct(), $request->validated());

        return response()->json($product->toArray(), 201);
    }

    public function show(string $id)
    {
        $product = call_user_func(new GetProduct(), $id);

        return response()->json($product->toArray());
    }

    public function update(ProductRequest $request, string $id)
    {
        $product = call_user_func(new UpdateProduct(), $id, $request->validated());

        return response()->json($product->toArray());
    }

    public function destroy(string $id)
    {
        call_user_func(new DeleteProduct(), $id);

        return response()->json([], 204);
    }
}
