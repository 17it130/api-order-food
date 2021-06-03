<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FoodService;
use Illuminate\Support\Facades\Request;
use PHPUnit\Exception;

class FoodController extends Controller
{
    protected $foodService;

    public function __construct(FoodService $foodService) {
        $this->foodService = $foodService;
    }

    public function getAll() {
        try {
            if (Request::has('latitude') && Request::has('longitude')) {
                $data = [
                    'latitude' => Request::input('latitude'),
                    'longitude' => Request::input('longitude')
                ];
            } else {
                $data = [];
            }
            $result = [
                'status' => 1,
                'foods' => $this->foodService->getAll(isset($data['latitude']) ? $data : [])
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
                'food' => $this->foodService->show($id, Request::only("latitude", "longitude"))
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function search() {
        try {
            $keyword = trim(Request::get('keyword'), ' ');
            if ($keyword === '') {
                $result = [
                    'success' => false,
                    'message' => 'Please enter keyword'
                ];
            } else {
                $result = [
                    'status' => 1,
                    'foods' => $this->foodService->search($keyword)
                ];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function recommendFood($id, $shop_id) {
        try {
            $result = [
                'status' => 1,
                'foods' => $this->foodService->recommendFood($id, $shop_id)
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
