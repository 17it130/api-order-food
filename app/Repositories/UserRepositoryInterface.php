<?php

namespace App\Repositories;

interface UserRepositoryInterface {
    public function getAll();

    public function getUsersByRole($role);

    public function show($id);

    public function update($data, $id);

    public function store($data);

    public function delete($id);
}
