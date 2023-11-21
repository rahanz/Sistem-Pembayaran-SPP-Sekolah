<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function input_kelas(Request $request)
    {
        $request -> validate
        ([
            'RuangKelas' => 'required|min:1|unique:kelas, ruang',
            'KategoriKelas' => 'required',
            'JurusanKelas' => 'required'
        ],
        [
            'RuangKelas.required' => 'ruang kelas tidak boleh kosong',
            'KategoriKelas.required' => 'kelas tidak boleh kosong',
            'JurusanKelas.required' => 'jurusan tidak boleh kosong'
        ]);

        kelas::create([
            'kelas' => $request->input('KategoriKelas'),
            'jurusan' => $request->input('JurusanKelas'),
            'ruang' => $request->input('RuangKelas')
        ]);

        return redirect()->route('TambahKelas')->with('success', 'Data pengadaan obat berhasil ditambahkan.');
    }
}
