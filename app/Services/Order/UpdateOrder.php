<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Order\OrderItem\CreateOrderItem;
use App\Services\Order\OrderItem\DeleteOrderItem;

class UpdateOrder
{
    public function __invoke(string $id, array $data): ?Order
    {
        if (empty($order = call_user_func(new GetOrder(), $id))) {
            return null;
        }

        $this->deleteOldItems($order);
        $this->createNewItems($order, $data['products']);

        $data['subtotal_products'] = $order->totalProducts();
        $data['total'] = $order->totalProducts() + $data['value_freight'];

        $order->update($data);

        return $order;
    }

    private function deleteOldItems(Order $order): void
    {
        $order->items()->each(function ($item) {
            call_user_func(new DeleteOrderItem(), $item);
        });
    }

    private function createNewItems(Order $order, array $products): void
    {
        collect($products)->each(function (array $product) use ($order) {
            call_user_func(new CreateOrderItem(), $order, $product);
        });
    }
}
