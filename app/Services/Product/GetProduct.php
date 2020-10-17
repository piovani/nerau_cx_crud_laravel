<?php

namespace App\Services\Product;

use App\Models\Product;

class GetProduct
{
    public function __invoke(string $id): ?Product
    {
        return Product::find($id);
    }
}
