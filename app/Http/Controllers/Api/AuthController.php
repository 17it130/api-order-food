<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SocialService;
use App\Services\UserService;
use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller
{
    protected $userService;
    protected $socialService;

    public function __construct(UserService $userService, SocialService $socialService)
    {
        $this->userService = $userService;
        $this->socialService = $socialService;
    }

    public function loginWithGoogle(Request $request)
    {
        if ($request->device_type == 'web') {
            $client_id_string = "1086092518209-ftnve6v9u2v5fpundc1t9oc56r0gthhl.apps.googleusercontent.com";
        } else if ($request->device_type == 'ios') {
            $client_id_string = "1086092518209-r4ntrumb2k85gldv78gfipbt2tnb9hp5.apps.googleusercontent.com";
        } else if ($request->device_type == 'android') {
            $client_id_string = "";
        }
        $client = new \Google_Client(['client_id' => $client_id_string]);
        $payload = $client->verifyIdToken($request->input('id_token'));

        if (isset($payload) && $payload) {
            $isExist = $this->socialService->getBySocialId($payload['sub']);
            if (isset($isExist)) {
                $user = $this->userService->show($isExist->user_id);

                return $this->generateToken($user);
            }
            $data = [
                'name' => $payload['name'],
                'profile_image' => $payload['picture'],
                'email' => $payload['email'],
                'role' => 'user'
            ];

            $user = $this->userService->store($data);

            $social_data = [
                'user_id' => $user->id,
                'social_id' => $payload['sub'],
                'social_provider' => 'google'
            ];

            $this->socialService->store($social_data);

            return $this->generateToken($user);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'id_token expired'
            ], 401);
        }
    }

    public function generateToken($user)
    {
        if (!$userToken = JWTAuth::fromUser($user)) {
            return response()->json([
                'status' => 0,
                'message' => 'invalid_credentials'
            ], 401);
        }

        return response()->json([
            'status' => 1,
            'token' => $userToken,
            'user' => $user
        ]);
    }
}
