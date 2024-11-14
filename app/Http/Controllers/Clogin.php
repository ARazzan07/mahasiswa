<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Clogin extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');
    $user = User::where('username', $request->username)->first();

    if (!$user) {
        return redirect()->route('login')->withErrors(['username' => 'Username tidak ditemukan']);
    }

    if (!Auth::attempt($credentials)) {
        return redirect()->route('login')->withErrors(['password' => 'Password salah']);
    }

    // Jika login berhasil
    return redirect()->route('home')->with('success', 'Login berhasil!');
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('logout', 'Berhasil Logout');
    }
}
