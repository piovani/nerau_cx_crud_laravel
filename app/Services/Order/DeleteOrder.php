<?php

namespace App\Services\Order;

class DeleteOrder
{
    public function __invoke(string $id): void
    {
        $order = call_user_func(new GetOrder(), $id);

        if (!is_null($order)) {
            $order->delete();
        }
    }
}
