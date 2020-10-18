<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Order\OrderItem\CreateOrderItem;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public function __invoke(array $data): ?Order
    {
        $totalProducts = 0.00;
        $total = 0.00;
        $order = null;

        collect($data['products'])->each(function ($product) use (&$totalProducts, &$total) {
            $totalProduct = $product['value'] * $product['amount'];

            $totalProducts += $totalProduct;
            $total += $totalProduct;
        });

        DB::transaction(function () use (&$order, $data, $totalProducts, $total) {
            /** @var Order $order */
            $order = Order::create([
                'code' => Order::nextCode(),
                'client_id' => $data['client_id'],
                'form_payment' => $data['form_payment'],
                'form_delivery' => $data['form_delivery'],
                'subtotal_products' => $totalProducts,
                'value_freight' => 0.00,
                'total' => 0.00,
            ]);

            $this->createProducts($order, $data['products']);

            $order->value_freight = $order->sumValueFreight();
            $order->total = $total + $order->sumValueFreight();

            if ($data['form_payment'] === Order::FORM_PAYMENT_CASH) {
                $order->total -= ($order->total * env('CASH_DISCOUNT')) ;
            }

            $order->save();
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
