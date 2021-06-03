<?php


namespace App\Repositories;


use App\Models\Order;
use App\Models\OrderDetail;

class OrderRepository implements OrderRepositoryInterface {

    public function getAll()
    {
        return Order::with(['detail' => function($q) {
                        $q->with('food');
                    }, 'user'])
                    ->get();
    }

    public function getAllWithUser($user_id)
    {
        return Order::with(['detail' => function($q) use($user_id) {
                        $q->with('food')->where('shop_id', $user_id);
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
                        $q->with(['food' => function($qs) {
                            $qs->with('shop');
                        }]);
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
