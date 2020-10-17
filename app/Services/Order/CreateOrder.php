<?php

namespace App\Services\Order;

use App\Models\Order;

class CreateOrder
{
    public function __invoke(array $data): Order
    {
        $totalProducts = 0.0;
        $total = $data['value_freight'];

        collect($data['products'])->each(function ($product) use (&$totalProducts, &$total) {
            $totalProduct = $product['value'] * $product['amount'];

            $totalProducts += $totalProduct;
            $total += $totalProduct;
        });

        return Order::create([
            'code' => Order::nextCode(),
            'client_id' => $data['client_id'],
            'value_freight'=> $data['value_freight'],
            'form_payment' => $data['form_payment'],
            'form_delivery' => $data['form_delivery'],
            'subtotal_products' => $totalProducts,
            'total' => $total,
        ]);
    }
}
