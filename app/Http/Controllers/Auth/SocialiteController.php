<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialiteController
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        return $this->handleCallback($user->email);
    }

    public function redirectToAzure()
    {
        return Socialite::driver('azure')->redirect();
    }
    
    public function handleAzureCallback()
    {
        $user = Socialite::driver('azure')->user();
        return $this->handleCallback($user->email);
    }

    private function handleCallback($email) {
        $user = User::where([
            'email' => $email
        ])->first();

        if (!$user) {
            abort(404, 'User not found');
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}