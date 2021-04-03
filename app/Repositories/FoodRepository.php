<?php

namespace App\Repositories;

use App\Models\Food;

class FoodRepository implements FoodRepositoryInterface {
    public function getAll()
    {
        return Food::all();
    }

    public function getFood($id)
    {
        return Food::findOrFail($id);
    }
}
