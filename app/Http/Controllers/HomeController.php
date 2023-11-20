<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('SuperAdmin.dashboard');
    }

    public function login(){
        return view('Akun.login');
    }

    public function register(){
        return view('Akun.register');
    }

    public function data_siswa(){
        return view('SuperAdmin.siswa');
    }

    public function tambah_siswa(){
        return view('SuperAdmin.tambahsiswa');
    }

    public function data_kelas(){
        return view('SuperAdmin.tambahsiswa');
    }
}
