<?php

namespace App\Repositories;

use App\Models\Food;

class FoodRepository implements FoodRepositoryInterface {

    public function getAll()
    {
        return Food::all();
    }

    public function store($data)
    {
        return Food::create($data);
    }

    public function show($id)
    {
        return Food::findOrFail($id);
    }

    public function update($data, $id)
    {
        return Food::where('id', $id)->update($data);
    }

    public function delete($id)
    {
       return Food::findOrFail($id)->delete();
    }
}
