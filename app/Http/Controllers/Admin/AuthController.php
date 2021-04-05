<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SocialService;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    protected $socialService;

    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }


    public function index()
    {
        return view('admin.pages.auth.index');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $s_user = Socialite::driver('google')->user();

        $user  = $this->socialService->getBySocialId($s_user->id);

        if (isset($user) && $user != null) {
            if ($user->user->role == 'shop' || $user->user->role == 'admin') {
                return redirect()->route('dashboard.index');
            }
        } else {
            abort(401);
        }
    }
}
