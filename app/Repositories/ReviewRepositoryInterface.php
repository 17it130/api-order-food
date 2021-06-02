<?php

namespace App\Repositories;

interface ReviewRepositoryInterface {
    public function getAll();

    public function show($id);

    public function store($data);

    public function delete($id);

    public function getReviewByFoodId($food_id);

    public function getReviewByShop($shop_id);

    public function getReviewByUser($user_id);
}
