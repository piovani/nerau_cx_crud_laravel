<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Order\OrderItem\DeleteOrderItem;

class DeleteOrder
{
    public function __invoke(string $id): void
    {
        if (is_null($order = call_user_func(new GetOrder(), $id))) {
            return;
        }

        $this->deleteItems($order);
        $order->delete();
    }

    private function deleteItems(Order $order): void
    {
        $order->items->each(function (OrderItem $item) {
            call_user_func(new DeleteOrderItem(), $item);
        });
    }
}
