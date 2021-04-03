<?php

namespace App\Repositories;

interface  FoodRepositoryInterface {
    public function getAll();

    public function getFood($id);
}
