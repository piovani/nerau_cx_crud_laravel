<?php

namespace App\Services\Order;

use App\Models\Order;

class UpdateOrder
{
    public function __invoke(string $id, array $data): ?Order
    {
        $order = call_user_func(new GetOrder(), $id);

        if (!is_null($order)) {
            $order->update($data);
        }

        return $order;
    }
}
