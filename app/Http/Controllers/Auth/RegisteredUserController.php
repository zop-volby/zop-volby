<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (User::count() > 0) {
            $user = Auth::user();
            if (!$user) {
                abort(403, "You need to be authenticated to create new users.");
            }
            if (!($user->is_admin)) {
                abort(403, "User $user->email is not admin.");
            }
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $will_be_admin = 1;
        if (User::count() > 0) {
            $will_be_admin = 0;
            $user = Auth::user();
            if (!$user) {
                abort(403, "You need to be authenticated to create new users.");
            }
            if (!($user->is_admin)) {
                abort(403, "User $user is not admin.");
            }
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $will_be_admin,
            //'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect()->route('users.index');
    }
}
