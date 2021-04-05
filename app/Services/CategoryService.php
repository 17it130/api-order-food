<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryService;

    public function __construct(CategoryRepository $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAll()
    {
        return $this->categoryService->getAll();
    }

    public function store($data)
    {
        return $this->categoryService->store($data);
    }

    public function show($id)
    {
        return $this->categoryService->show($id);
    }

    public function update($data, $id)
    {
        return $this->categoryService->update($data, $id);
    }

    public function delete($id)
    {
        return $this->categoryService->delete($id);
    }
}
