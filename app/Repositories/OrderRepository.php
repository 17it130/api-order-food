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

    public function getAllWithUser()
    {
        return Order::with(['detail' => function($q) {
                        $q->with('food');
                    }])
                    ->join('users', 'orders.customer_id', 'users.id')
                    ->select('orders.*', 'users.name as customer_name', 'users.email as customer_email',
                                'users.phone as customer_phone', 'users.address as customer_address')
                    ->get();
    }

    public function show($id)
    {
        return Order::with(['detail' => function($q) {
                        $q->with('food');
                    }, 'user'])
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
                        $q->with(['food', 'shop']);
                    }])
                    ->where('customer_id', $user_id)
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
