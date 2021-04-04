<?php

namespace App\Repositories;

interface FoodRepositoryInterface {
    public function getAll();

    public function store($data);

    public function show($id);

    public function update($data, $id);

    public function delete($id);
}
