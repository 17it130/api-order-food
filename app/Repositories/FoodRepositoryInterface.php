<?php

namespace App\Repositories;

interface FoodRepositoryInterface {
    public function getAll($data);

    public function store($data);

    public function show($id, $data);

    public function update($data, $id);

    public function delete($id);

    public function getFoodByCategoryId($cat_id, $data);

    public function search($keyword);

    public function recommendFood($food_id, $shop_id);
}
