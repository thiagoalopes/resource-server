<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $user = User::where('email','thiagolopesbv@gmail.com')->first();
        Auth::login($user);
        return redirect()->intended();
    }
}
