<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function register(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create($userAttributes);

        Auth::login($user);
    }
}
