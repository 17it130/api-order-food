<?php


namespace App\Repositories;


use App\Models\Order;
use App\Models\OrderDetail;

class OrderRepository implements OrderRepositoryInterface {

    public function getAll()
    {
        return Order::with(['detail' => function($q) {
                        $q->with('food');
                    }])
                    ->get();
    }

    public function show($id)
    {
        return Order::with(['detail' => function($q) {
                        $q->with('food');
                    }])
                    ->where('id', $id)
                    ->get();
    }

    public function store($data)
    {
        return Order::create($data);
    }

    public function update($data, $id)
    {
        return Order::where('id', $id)
                    ->update($data);
    }

    public function getOrdersByUser($user_id)
    {
        return Order::with(['detail' => function($q) {
                        $q->with('food');
                    }])
                    ->where('user_id')
                    ->get();
    }

    public function storeOrderDetail($data)
    {
        return OrderDetail::create($data);
    }

    public function updateOrderDetail($data, $id)
    {
        return OrderDetail::where('order_id', $id)
                        ->update($data);
    }

    public function removeItemInOrderDetail($id)
    {
        return OrderDetail::findOrFail($id)
                    ->delete();
    }
}
