<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository implements ReviewRepositoryInterface {

    public function getAll()
    {
        return Review::with(['user', 'food'])->all();
    }

    public function show($id)
    {
        return Review::findOrFail($id);
    }

    public function store($data)
    {
        return Review::create($data);
    }

    public function delete($id)
    {
        return Review::findOrFail($id)->delete();
    }

    public function getReviewByFoodId($food_id)
    {
        return Review::with('user')->where('food_id', $food_id)
            ->get();
    }

    public function getReviewByShop($shop_id)
    {
        return Review::with('user')
            ->join('foods', 'reviews.food_id', '=', 'foods.id')
            ->join('users', 'foods.shop_id', '=', 'users.id')
            ->where('users.id', $shop_id)
            ->select('reviews.*')
            ->get();
    }

    public function getReviewByUser($user_id)
    {
        return Review::with('user')->where('user_id', $user_id)
            ->get();
    }
}
