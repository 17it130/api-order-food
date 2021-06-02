<?php

namespace App\Services;


use App\Repositories\SocialRepository;

class SocialService {
    protected $socialRepository;

    public function __construct(SocialRepository $socialRepository) {
        $this->socialRepository = $socialRepository;
    }

    public function store($data) {
        return $this->socialRepository->store($data);
    }

    public function getBySocialId($social_id) {
        return $this->socialRepository->getBySocialId($social_id);
    }
}
