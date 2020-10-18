<?php

namespace App\Services\Order\OrderItem;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Product\GetProduct;

class CreateOrderItem
{
    public function __invoke(Order $order, $data): OrderItem
    {
        /** @var Product $product */
        $product = call_user_func(new GetProduct(), $data['product_id']);

        if ($product->status === Product::STATUS_ACTIVE) {
            throw new \Exception(sprintf('O produto %s está inativo', $product->name));
        }

        if ($product->stock < $data['amount']) {
            throw new \Exception(sprintf('O produto %s está sem estoque', $product->name));
        }

        $product->subtractStock($data['amount']);

        return OrderItem::create([
            'order_id' => $order->id,
            'order_code' => $order->code,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'amount' => $data['amount'],
            'value_unit' => $data['value'],
            'total' => $data['amount'] * $data['value'],
        ]);
    }
}
