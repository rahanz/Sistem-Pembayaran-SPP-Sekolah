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
        $dataKelas = Kelas::pluck('kelas')->unique();
        $dataJurusan = Kelas::pluck('jurusan')->unique();

        $dataKelas = $dataKelas->sort();
        $dataJurusan = $dataJurusan->sort();

        return view('SuperAdmin.siswa', compact('dataKelas','dataJurusan'));
    }

    public function tambah_siswa(){
        $dataKelas = Kelas::pluck('kelas')->unique();
        $dataJurusan = kelas::pluck('jurusan')->unique();

        $dataKelas = $dataKelas->sort();
        $dataJurusan = $dataJurusan->sort();

        return view('SuperAdmin.tambahsiswa', compact('dataKelas','dataJurusan'));
    }

    public function kelas(){
        return view('SuperAdmin.kelas');
    }

    public function tambah_kelas(){
        return view('SuperAdmin.tambahkelas');
    }
}
