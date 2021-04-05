<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\FoodService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $foodService;

    public function __construct(CategoryService $categoryService, FoodService $foodService)
    {
        $this->categoryService = $categoryService;
        $this->foodService = $foodService;
    }

    public function getAll()
    {
        try {
            $result = [
                'status' => 1,
                'categories' => $this->categoryService->getAll()
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function getFoodByCategoryId($id)
    {
        try {
            $result = [
                'status' => 1,
                'food' => $this->foodService->getFoodByCategoryId($id)
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}
