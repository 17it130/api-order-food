<?php

namespace App\Repositories;

interface CategoryRepositoryInterface {
    public function getAll();

    public function store($data);

    public function show($id);

    public function update($data, $id);

    public function delete($id);
}
