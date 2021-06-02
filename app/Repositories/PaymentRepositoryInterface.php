<?php

namespace App\Repositories;

interface PaymentRepositoryInterface {
    public function getAll();

    public function show($id);

    public function update($data, $id);
}
