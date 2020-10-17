<?php

namespace App\Services\Order;

use App\Models\Order;

class GetOrder
{
    public function __invoke(string $id = null, int $code = null): ?Order
    {
        if (!is_null($id)) {
            return Order::find($id);
        }

        if (!is_null($code)) {
            return Order::where('code', $code)->first();
        }
    }
}
