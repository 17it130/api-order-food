<?php

namespace App\Repositories;

interface SocialRepositoryInterface {
    public function store($data);

    public function getByUserId($id);

    public function show($id);

    public function getBySocialId($social_id);
}
