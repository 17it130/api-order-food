<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService {
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository) {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAll()
    {
        return $this->paymentRepository->getAll();
    }

    public function show($id)
    {
        return $this->paymentRepository->show($id);
    }

    public function update($data, $id)
    {
        return $this->paymentRepository->update($data, $id);
    }
}
