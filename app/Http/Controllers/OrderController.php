<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\Order\CreateOrder;
use App\Services\Order\DeleteOrder;
use App\Services\Order\GetOrder;
use App\Services\Order\UpdateOrder;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function store(OrderRequest $request)
    {
        /** @var Order $order */
        $order = call_user_func(new CreateOrder(), $request->all());

        return response()->json($order->toArray(), 201);
    }

    public function show(string $id)
    {
        /** @var Order $order */
        $order = call_user_func(new GetOrder(), $id);

        return response()->json($order->toArray());
    }

    public function update(OrderRequest $request, string $id)
    {
        /** @var Order $order */
        $order = call_user_func(new UpdateOrder(), $id, $request->validated());

        return response()->json($order->toArray());
    }

    public function destroy(string $id)
    {
        call_user_func(new DeleteOrder(), $id);

        return response()->json([], 204);
    }
}
