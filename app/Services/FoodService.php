<?php

namespace App\Services;

use App\Repositories\FoodRepository;

class FoodService
{
    protected $foodRepository;

    public function __construct(FoodRepository $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    public function getAll($data)
    {
        return $this->foodRepository->getAll($data);
    }

    public function store($data)
    {
        return $this->foodRepository->store($data);
    }

    public function show($id, $data)
    {
        return $this->foodRepository->show($id, $data);
    }

    public function update($data, $id)
    {
        return $this->foodRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->foodRepository->delete($id);
    }

    public function getFoodByCategoryId($cat_id)
    {
        return $this->foodRepository->getFoodByCategoryId($cat_id, $data);
    }

    public function getFoodWithCategoryShop() {
        return $this->foodRepository->getFoodWithCategoryShop();
    }

    public function search($keyword) {
        return $this->foodRepository->search($keyword);
    }

    public function recommendFood($food_id, $shop_id) {
        return $this->foodRepository->recommendFood($food_id, $shop_id);
    }
}
