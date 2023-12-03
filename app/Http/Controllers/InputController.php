<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Rules\PenambahanKelas;
use App\Rules\TambahKelas;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class InputController extends Controller
{
    // handling database untuk halaman tambah_kelas
    public function input_kelas(Request $request)
    {

        $request->validate(
            [
                'wali_kelas_siswa' => 'required|unique:kelas,wali_kelas',
                'ruang_kelas_siswa' => 'required|unique:kelas,ruang_kelas'
            ],
            [
                'wali_kelas_siswa.required' => 'Wali kelas tidak boleh kosong',
                'wali_kelas_siswa.unique' => 'data wali kelas sudah ada',
                'ruang_kelas_siswa.unique' => 'ruang kelas sudah punya Wali kelas',
                'ruang_kelas_siswa.required' => 'ruang kelas tidak boleh kosong'
            ]
        );
    
        Kelas::create([
            'wali_kelas' => $request->input('wali_kelas_siswa'),
            'ruang_kelas' => $request->input('ruang_kelas_siswa'),
        ]);
    
        return redirect()->route('TambahKelas')->with('success', 'Data ruang kelas berhasil ditambahkan.');
    }
    // handling database untuk halaman tambah_siswa
    public function input_siswa(Request $request)
    {
        $request->validate(
            [
                'nis_siswa' => 'required|unique:siswa,nis',
                'nama_siswa' => 'required',
                'jenis_kelamin_siswa' => 'required',
                'kelas_id' => 'required|exists:kelas,id',
                'alamat_siswa' => 'required',
            ],
            [
                'nis_siswa.required' => 'nis tidak boleh kosong',
                'nis_siswa.unique' => 'nis sudah ada dalam database',
                'nama_siswa.required' => 'nama siswa tidak boleh kosong',
                'jenis_kelamin_siswa.required' => 'jenis kelamin siswa tidak boleh kosong',
                'kelas_id.required' => 'kelas tidak boleh kosong',
                'alamat_siswa.required' => 'alamat siswa tidak boleh kosong'
            ]
        );
    
        Siswa::create([
            'nis' => $request->input('nis_siswa'),
            'nama' => $request->input('nama_siswa'),
            'jenis_kelamin' => $request->input('jenis_kelamin_siswa'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat_siswa'),
        ]);
    
        return redirect()->route('TambahDataSiswa')->with('success', 'Data siswa berhasil ditambahkan.');
    }
}
