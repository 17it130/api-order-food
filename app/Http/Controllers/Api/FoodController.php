<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FoodService;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class FoodController extends Controller
{
    protected $foodService;

    public function __construct(FoodService $foodService) {
        $this->foodService = $foodService;
    }

    public function getAll() {
        try {
            $result = [
                'status' => 1,
                'foods' => $this->foodService->getAll()
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function show($id) {
        try {
            $result = [
                'status' => 1,
                'food' => $this->foodService->show($id)
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
