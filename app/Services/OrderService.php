<?php


namespace App\Services;


use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function getAll() {
        return $this->orderRepository->getAll();
    }

    public function getAllWithUser($user_id) {
        return $this->orderRepository->getAllWithUser($user_id);
    }

    public function show($id) {
        return $this->orderRepository->show($id);
    }

    public function update($data, $id) {
        return $this->orderRepository->update($data, $id);
    }

    public function store($data) {
        return $this->orderRepository->store($data);
    }

    public function getOrdersByUser($user_id) {
        return $this->orderRepository->getOrdersByUser($user_id);
    }

    public function storeOrderDetail($data) {
        return $this->orderRepository->storeOrderDetail($data);
    }

    public function updateOrderDetail($data, $id) {
        return $this->orderRepository->updateOrderDetail($data, $id);
    }

    public function removeItemInOrderDetail($id) {
        return $this->orderRepository->removeItemInOrderDetail($id);
    }
}
