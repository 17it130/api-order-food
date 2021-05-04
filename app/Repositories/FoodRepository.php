<?php

namespace App\Repositories;

use App\Models\Food;
use Illuminate\Support\Facades\DB;

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

    public function show($id, $data)
    {
        $sqlDistance = DB::raw('(111.045*acos(cos(radians(' . $data['latitude'] . '))
       * cos(radians(users.latitude))
       * cos(radians(users.longitude)
       - radians(' . $data['longitude'] . '))
       + sin( radians(' . $data['latitude'] . '))
       * sin( radians(users.latitude))))');
        return Food::with(['shop', 'tags', 'reviews' => function ($q) {
            $q->with('user')
                ->selectRaw('sum(rate)');
        }])
            ->join('users', 'users.id', 'foods.shop_id')
            ->select('users.latitude',
                'users.longitude', 'foods.*')
            ->where('foods.id', $id)
            ->selectRaw("{$sqlDistance} AS distance")
            ->orderBy('distance')
            ->get();
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

    public function search($keyword)
    {
        return Food::query()
            ->where("name", 'LIKE', "%{$keyword}%")
            ->get();
    }

    public function recommendFood($food_id, $shop_id)
    {
        return Food::where("id", '<>', $food_id)
            ->where("shop_id", $shop_id)
            ->inRandomOrder(5)
            ->get();
    }
}
