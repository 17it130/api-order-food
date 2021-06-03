<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;
use JWTAuth;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Storage::disk('public')->put('reviews', $file);
        }

        try {
            $data = [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'image' => isset($path) ? url("/storage/" . $path) : '',
                'rate' => $request->input('rate'),
                'user_id' => JWTAuth::user()->id,
                'food_id' => $request->input('food_id')
            ];

            $result = [
                'status' => 1,
                'review' => $this->reviewService->store($data)
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function getReviewByFoodId($food_id)
    {
        try {
            $result = [
                'status' => 1,
                'reviews' => $this->reviewService->getReviewByFoodId($food_id)
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function getReviewByShop($shop_id)
    {
        try {
            $result = [
                'status' => 1,
                'reviews' => $this->reviewService->getReviewByShop($shop_id)
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
