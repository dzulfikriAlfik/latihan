<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard')->with('success', 'Selamat Datang ' . $user->name);
        }
        return redirect('/login')->with('error', 'Email dan Password tidak cocok!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda Berhasil Logout');
    }
}
