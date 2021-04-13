<?php

namespace App\Repositories;

use App\Models\Food;

class FoodRepository implements FoodRepositoryInterface
{

    public function getAll()
    {
        return Food::with('shop')->get();
    }

    public function store($data)
    {
        return Food::create($data);
    }

    public function show($id)
    {
        return Food::with('shop')->findOrFail($id);
    }

    public function update($data, $id)
    {
        return Food::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Food::findOrFail($id)->delete();
    }

    public function getFoodByCategoryId($cat_id)
    {
        return Food::with('shop')->where('category_id', $cat_id)->get();
    }

    public function getFoodWithCategoryShop()
    {
        return Food::join('users', 'users.id', 'foods.shop_id')
            ->join('categories', 'foods.category_id', 'categories.id')
            ->select('foods.*', 'users.name as shop_name', 'categories.name as category_name')
            ->get();
    }
}
