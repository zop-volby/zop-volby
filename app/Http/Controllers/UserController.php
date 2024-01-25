<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function activate(string $id)
    {
        $post = User::findOrFail($id);
        if ($post->is_active) {
            $post->is_active = false;
        } 
        else {
            $post->is_active = true;
        }
        if ($post->save()) {
            return redirect()->route('users.index');
        }
    }
}