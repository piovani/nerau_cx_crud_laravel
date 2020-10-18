<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Order\OrderItem\CreateOrderItem;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public function __invoke(array $data): ?Order
    {
        $totalProducts = 0.0;
        $total = $data['value_freight'];
        $order = null;

        collect($data['products'])->each(function ($product) use (&$totalProducts, &$total) {
            $totalProduct = $product['value'] * $product['amount'];

            $totalProducts += $totalProduct;
            $total += $totalProduct;
        });

        DB::transaction(function () use (&$order, $data, $totalProducts, $total) {
            $order = Order::create([
                'code' => Order::nextCode(),
                'client_id' => $data['client_id'],
                'value_freight'=> $data['value_freight'],
                'form_payment' => $data['form_payment'],
                'form_delivery' => $data['form_delivery'],
                'subtotal_products' => $totalProducts,
                'total' => $total,
            ]);

            $this->createProducts($order, $data['products']);
        });

        return $order;
    }

    private function createProducts(Order $order, array $products): void
    {
        collect($products)->each(function ($product) use ($order) {
            call_user_func(new CreateOrderItem(), $order, $product);
        });
    }
}
