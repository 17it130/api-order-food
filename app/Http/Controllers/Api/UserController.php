<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function me() {
        try {
            $result = [
                'status' => 1,
                'user' => $this->userService->show(Auth::user()->id)
            ];
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function update(Request $request) {
        try {
            $data = [
                'profile_image' => $request->input('profile_image'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address')
            ];
            $this->userService->update($data, Auth::user()->id);

            $result = [
                'status' => 1,
                'message' => 'Update profile success'
            ];
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            $result = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}
