<?php

namespace App\Repositories;

interface OrderRepositoryInterface {
    public function getAll();

    public function show($id);

    public function store($data);

    public function update($data, $id);

    public function getOrdersByUser($user_id);

    public function storeOrderDetail($data);

    public function updateOrderDetail($data, $id);

    public function removeItemInOrderDetail($id);
}
