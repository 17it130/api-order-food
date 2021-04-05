<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAll() {
        return $this->userRepository->getAll();
    }

    public function getUsersByRole($role) {
        return $this->userRepository->getUsersByRole($role);
    }

    public function store($data) {
        return $this->userRepository->store($data);
    }

    public function show($id) {
        return $this->userRepository->show($id);
    }

    public function update($data, $id) {
        return $this->userRepository->update($data, $id);
    }
}
