<?php

namespace App\Services\Product;

use App\Models\Product;

class UpdateProduct
{
    public function __invoke(string $id, array $data): ?Product
    {
        $product = call_user_func(new GetProduct(), $id);

        if (!empty($product)) {
            $product->update($data);
        }

        return $product;
    }
}
