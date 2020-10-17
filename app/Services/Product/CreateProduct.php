<?php

namespace App\Services\Product;

use App\Models\Product;

class CreateProduct
{
    public function __invoke(array $data): Product
    {
        return Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'weight' => $data['weight'],
            'image' => $data['image'],
            'description' => $data['description'],
            'stock' => $data['stock'],
        ]);
    }
}
