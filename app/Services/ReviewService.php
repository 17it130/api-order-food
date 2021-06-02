<?php

namespace App\Services;

use App\Repositories\ReviewRepository;

class ReviewService {
    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository) {
        $this->reviewRepository = $reviewRepository;
    }

    public function getAll()
    {
        return $this->reviewRepository->getAll();
    }

    public function show($id)
    {
        return $this->reviewRepository->show($id);
    }

    public function store($data)
    {
        return $this->reviewRepository->store($data);
    }

    public function delete($id)
    {
        return $this->reviewRepository->delete($id);
    }

    public function getReviewByFoodId($food_id)
    {
        return $this->reviewRepository->getReviewByFoodId($food_id);
    }

    public function getReviewByShop($shop_id)
    {
        return $this->reviewRepository->getReviewByShop($shop_id);
    }

    public function getReviewByUser($user_id)
    {
        return $this->reviewRepository->getReviewByUser($user_id);
    }
}
