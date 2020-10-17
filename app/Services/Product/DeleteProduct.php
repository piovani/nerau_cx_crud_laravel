<?php

namespace App\Services\Product;

use App\Models\Product;

class DeleteProduct
{
    public function __invoke(string $id): void
    {
        /** @var Product $product */
        $product = call_user_func(new GetProduct(), $id);

        if (!empty($product)) {
            $product->delete();
        }
    }
}
