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

    public function getAll()
    {
        return $this->foodRepository->getAll();
    }

    public function store($data)
    {
        return $this->foodRepository->store($data);
    }

    public function show($id)
    {
        return $this->foodRepository->show($id);
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
        return $this->foodRepository->getFoodByCategoryId($cat_id);
    }
}
