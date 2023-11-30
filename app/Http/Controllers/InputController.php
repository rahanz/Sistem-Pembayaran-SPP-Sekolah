<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Rules\PenambahanKelas;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function input_kelas(Request $request)
    {

        $request->validate(
            [
                'KategoriKelas' => 'required',
                'JurusanKelas' => ['required', new PenambahanKelas($request->KategoriKelas, $request->JurusanKelas)]
            ],
            [
                'KategoriKelas.required' => 'kelas tidak boleh kosong',
                'JurusanKelas.required' => 'jurusan tidak boleh kosong'
            ]
        );

        kelas::create([
            'wali_kelas' => $request->input('KategoriKelas'),
            'ruang_kelas' => $request->input('JurusanKelas'),
        ]);

        return redirect()->route('TambahKelas')->with('success', 'Data ruang kelas berhasil ditambahkan.');
    }

    public function input_siswa(Request $request)
    {
        
    }
}
