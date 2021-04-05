<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function getAll()
    {
        return Category::all();
    }

    public function store($data)
    {
        return Category::create($data);
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update($data, $id)
    {
        return Category::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Category::findOrFail($id)->delete();
    }
}
