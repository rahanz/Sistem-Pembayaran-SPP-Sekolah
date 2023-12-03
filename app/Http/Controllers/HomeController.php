<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function user(){
        return view('User.dashboard');
    }

    public function user_profile(){
        return view('User.profile');
    }

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
        $dataKelas = Kelas::all();
        return view('SuperAdmin.tambahsiswa', compact('dataKelas'));
    }

    public function kelas(){
        return view('SuperAdmin.kelas');
    }

    public function tambah_kelas(){
        $data_kelas = kelas::all();
        return view('SuperAdmin.tambahkelas', compact('data_kelas'));
    }
}
