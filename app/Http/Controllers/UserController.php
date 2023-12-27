<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil, redirect ke halaman yang sesuai dengan role user
            if (Auth::user()->role == 'siswa') {
                return redirect()->intended('user_setting');
            } elseif (Auth::user()->role == 'admin') {
                // Redirect ke halaman admin
            } elseif (Auth::user()->role == 'superadmin') {
                // Redirect ke halaman superadmin
            }
        } else {
            // Jika autentikasi gagal
            return redirect()->back()->with('error', 'Login failed. Check your username and password.');
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
