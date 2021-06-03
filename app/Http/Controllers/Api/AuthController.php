<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeviceService;
use App\Services\SocialService;
use App\Services\UserService;
use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller
{
    protected $userService;
    protected $socialService;
    protected $deviceService;

    public function __construct(UserService $userService, SocialService $socialService, DeviceService $deviceService)
    {
        $this->userService = $userService;
        $this->socialService = $socialService;
        $this->deviceService = $deviceService;
    }

    public function loginWithGoogle(Request $request)
    {
        if ($request->device_type == 'web') {
            $client_id_string = "1086092518209-ftnve6v9u2v5fpundc1t9oc56r0gthhl.apps.googleusercontent.com";
        } else if ($request->device_type == 'ios') {
            $client_id_string = "213239061541-5072nudrlf2dpu7qdlvaub2vuvjg4m4f.apps.googleusercontent.com";
        } else if ($request->device_type == 'android') {
            $client_id_string = "16111219766-c7cmhta2cjnmngetuumv0t3t5jdl06tm.apps.googleusercontent.com";
        }
        $client = new \Google_Client(['client_id' => $client_id_string]);
        $payload = $client->verifyIdToken($request->input('id_token'));

        if (isset($payload) && $payload) {
            $isExist = $this->socialService->getBySocialId($payload['sub']);
            if (isset($isExist)) {
                $user = $this->userService->show($isExist->user_id);

                if ($request->has('device_id') && $request->has('push_token')) {
                    $device = $this->deviceService->findByUserIdAndDeviceId($user->id, $request->input('device_id'));
                    if (isset($device)) {
                        $device_data = [
                            'device_id' => $device->device_id,
                            'push_token' => $request->input('push_token'),
                            'device_type' => $device->device_type,
                            'user_id' => $user->id
                        ];
                        $this->deviceService->update($device->id, $device_data);
                    } else {
                        $device_data = [
                            'device_id' => $request->input('device_id'),
                            'push_token' => $request->input('push_token'),
                            'device_type' => $request->input('device_type'),
                            'user_id' => $user->id
                        ];
                        $this->deviceService->store($device_data);
                    }
                }

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

            if (isset($device)) {
                $device_data = [
                    'device_id' => $device->device_id,
                    'push_token' => $request->input('push_token'),
                    'device_type' => $device->device_type,
                    'user_id' => $user->id
                ];
                $this->deviceService->update($device->id, $device_data);
            } else {
                $device_data = [
                    'device_id' => $request->input('device_id'),
                    'push_token' => $request->input('push_token'),
                    'device_type' => $request->input('device_type'),
                    'user_id' => $user->id
                ];
                $this->deviceService->store($device_data);
            }

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
