<?php

namespace App\Http\Controllers\Auth;

class SocialiteController
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // $user->token
    }
}