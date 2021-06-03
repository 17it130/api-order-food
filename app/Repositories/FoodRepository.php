<?php

namespace App\Repositories;

use App\Models\Food;
use Illuminate\Support\Facades\DB;

class FoodRepository implements FoodRepositoryInterface
{

    public function getAll($data)
    {
        if (isset($data['latitude']) && isset($data['longitude'])) {
            $sqlDistance = DB::raw('(111.045*acos(cos(radians(' . $data['latitude'] . '))
               * cos(radians(users.latitude))
               * cos(radians(users.longitude)
               - radians(' . $data['longitude'] . '))
               + sin( radians(' . $data['latitude'] . '))
               * sin( radians(users.latitude))))');

            return Food::with(['shop', 'tags'])
                ->leftJoin('users', 'users.id', '=','foods.shop_id')
                ->leftJoin('reviews', 'foods.id', '=', 'reviews.food_id')
                ->select('users.latitude',
                    'users.longitude', 'foods.*')
                ->selectRaw("{$sqlDistance} AS distance")
                ->selectRaw("CASE WHEN reviews.rate IS NOT NULL THEN avg(reviews.rate) ELSE 0 END as rating")
                ->groupBy('foods.id')
                ->orderByDesc('distance')
                ->get();
        } else {
            return Food::with('shop')->get();
        }
    }

    public function store($data)
    {
        return Food::create($data);
    }

    public function show($id, $data)
    {
        if (isset($data['latitude']) && isset($data['longitude'])) {
            $sqlDistance = DB::raw('(111.045*acos(cos(radians(' . $data['latitude'] . '))
               * cos(radians(users.latitude))
               * cos(radians(users.longitude)
               - radians(' . $data['longitude'] . '))
               + sin( radians(' . $data['latitude'] . '))
               * sin( radians(users.latitude))))');

            return Food::with(['shop', 'tags'])
                ->join('users', 'users.id', '=','foods.shop_id')
                ->join('reviews', 'foods.id', '=', 'reviews.food_id')
                ->select('users.latitude',
                    'users.longitude', 'foods.*')
                ->where('foods.id', $id)
                ->selectRaw("{$sqlDistance} AS distance")
                ->selectRaw("avg(reviews.rate) as rating")
                ->orderBy('distance')
                ->get();
        } else {
            return Food::with(['shop', 'tags'])
                ->findOrFail($id);
        }

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
            ->with('shop')
            ->where("name", 'LIKE', "%{$keyword}%")
            ->get();
    }

    public function recommendFood($food_id, $shop_id)
    {
        return Food::with('shop')
            ->where("id", '<>', $food_id)
            ->where("shop_id", $shop_id)
            ->inRandomOrder(5)
            ->get();
    }
}
