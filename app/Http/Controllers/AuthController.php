<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        if (Auth::attempt($request->validated())) {

            $request->session()->regenerate();

            return redirect(Auth::user()->is_admin ? '/admins' : '/guest');
        } else {

            return back()->with('Failed', 'Either email or password is not correct');
        }
    }
}
