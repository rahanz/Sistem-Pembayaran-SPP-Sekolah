<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\pembayaran;
use App\Models\siswa;
use App\Models\spp;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // halaman user
    public function user()
    {
        return view('User.dashboard');
    }

    public function user_profile(pembayaran $pembayaran)
    {
        $user = Auth::user();
        $siswa = $user->siswa;
        $biaya_spp = spp::latest()->first();

        $data_pembayaran = pembayaran::all();
        return view('User.profile', compact('user', 'siswa', 'biaya_spp', 'data_pembayaran'));
    }

    public function halaman_checkout()
    {
        return view('User.checkout');
    }

    public function dashboard()
    {
        return view('SuperAdmin.dashboard');
    }

    public function login()
    {
        return view('Akun.login');
    }

    public function register()
    {
        return view('Akun.register');
    }

    // halaman data siswa
    public function data_siswa(Request $request)
    {
        $kelas_id = $request->input('kelas_siswa');
        $siswa = Siswa::where('kelas_id', $kelas_id)->get();
        $kelasDipilih = Kelas::find($kelas_id);
        $dataRuangKelas = Kelas::all();
        return view('SuperAdmin.siswa', compact('siswa', 'dataRuangKelas', 'kelasDipilih'));
    }

    // halaman tambah siswa
    public function tambah_siswa()
    {
        $dataKelas = Kelas::all();
        return view('SuperAdmin.tambahsiswa', compact('dataKelas'));
    }

    public function kelas()
    {
        return view('SuperAdmin.kelas');
    }

    // halaman tambah kelas
    public function tambah_kelas()
    {
        $data_kelas = kelas::all();
        foreach ($data_kelas as $kelas) {
            $kelas->jumlah_siswa = siswa::where('kelas_id', $kelas->id)->count();
            $kelas->jumlah_laki_laki = Siswa::where('kelas_id', $kelas->id)->where('jenis_kelamin', 'Laki-laki')->count();
            $kelas->jumlah_perempuan = Siswa::where('kelas_id', $kelas->id)->where('jenis_kelamin', 'Perempuan')->count();
        }
        return view('SuperAdmin.tambahkelas', compact('data_kelas'));
    }

    // halaman pembayaran spp admin
    public function pembayaran_spp_admin()
    {
        $biaya_spp = spp::latest()->first();
        $tahun_ajaran_aktif = TahunAjaran::latest()->first();
        $data_tahun_ajaran = TahunAjaran::all();
        return view('SuperAdmin.pembayaran', compact('biaya_spp', 'tahun_ajaran_aktif', 'data_tahun_ajaran'));
    }
}
