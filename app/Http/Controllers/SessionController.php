<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        $userAttributes =  $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!Auth::attempt($userAttributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, your email does not match.',
                'password' => 'Sorry, your password is not correct.'
            ]);
        }
        if ($request->hasSession()) {
            $request->old();
        }
    }
}
