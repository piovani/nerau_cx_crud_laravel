<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Order\OrderItem\CreateOrderItem;
use App\Services\Order\OrderItem\DeleteOrderItem;
use Illuminate\Support\Facades\DB;

class UpdateOrder
{
    public function __invoke(string $id, array $data): ?Order
    {
        /** @var Order $order */
        if (empty($order = call_user_func(new GetOrder(), $id))) {
            return null;
        }

        $this->deleteOldItems($order);
        $this->createNewItems($order, $data['products']);

        DB::transaction(function () use (&$order, $data) {
            $order->update($data);

            $order->subtotal_products = $order->totalProducts();
            $order->value_freight = $order->sumValueFreight();
            $order->total = $order->totalProducts() + $order->sumValueFreight();

            if ($data['form_payment'] === Order::FORM_PAYMENT_CASH) {
                $order->total -= ($order->total * env('CASH_DISCOUNT')) ;
            }

            $order->save();
        });

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
