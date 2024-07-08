<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function checkAuth(Request $request)
    {
        if (Auth::check()) {
            return response()->json(['authenticated' => true], 200);
        } else {
            return response()->json(['authenticated' => false], 403);
        }
    }
}
