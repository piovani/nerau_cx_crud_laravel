<?php

namespace App\Services\Order\OrderItem;

use App\Models\OrderItem;

class DeleteOrderItem
{
    public function __invoke(OrderItem $orderItem): void
    {
        $orderItem->delete();
    }
}
