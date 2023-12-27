<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\spp;
use App\Models\TahunAjaran;
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

    public function edit_kelas(Request $request, $id)
    {
        $dataKelas = kelas::find($id);
        $request->validate(
            [
                'wali_kelas_siswa' => ['required', Rule::unique('kelas', 'wali_kelas')->ignore($dataKelas->id)],
                'ruang_kelas_siswa' => ['required', Rule::unique('kelas', 'ruang_kelas')->ignore($dataKelas->id)],
            ],
            [
                'wali_kelas_siswa.required' => 'Wali kelas tidak boleh kosong',
                'wali_kelas_siswa.unique' => 'data wali kelas sudah ada',
                'ruang_kelas_siswa.unique' => 'ruang kelas sudah punya Wali kelas',
                'ruang_kelas_siswa.required' => 'ruang kelas tidak boleh kosong'
            ]
        );

        $dataKelas->wali_kelas = $request->input('wali_kelas_siswa');
        $dataKelas->ruang_kelas = $request->input('ruang_kelas_siswa');
        $dataKelas->save();

        return redirect()->route('TambahKelas')->with('success', 'Data kelas berhasil diupdate.');
    }

    public function delete_kelas($id)
    {
        $dataKelas = Kelas::find($id);
        if ($dataKelas) {
            $dataKelas->delete();
            return redirect()->route('TambahKelas')->with('success', 'Data kelas berhasil dihapus.');
        } else {
            return redirect()->route('TambahKelas')->with('error', 'Data kelas tidak ditemukan.');
        }
    }

    // handling database untuk halaman tambah_siswa
    public function input_siswa(Request $request)
    {
        $request->validate(
            [
                'no_hp_siswa' => 'required|numeric|unique:siswa,no_hp',
                'nama_siswa' => 'required',
                'jenis_kelamin_siswa' => 'required',
                'kelas_id' => 'required|exists:kelas,id',
                'alamat_siswa' => 'required',
            ],
            [
                'no_hp_siswa.required' => 'nis tidak boleh kosong',
                'no_hp_siswa.unique' => 'nis sudah ada dalam database',
                'no_hp_siswa.numeric' => 'nis harus berupa angka',
                'nama_siswa.required' => 'nama siswa tidak boleh kosong',
                'jenis_kelamin_siswa.required' => 'jenis kelamin siswa tidak boleh kosong',
                'kelas_id.required' => 'kelas tidak boleh kosong',
                'alamat_siswa.required' => 'alamat siswa tidak boleh kosong'
            ]
        );

        Siswa::create([
            'no_hp' => $request->input('no_hp_siswa'),
            'nama' => $request->input('nama_siswa'),
            'jenis_kelamin' => $request->input('jenis_kelamin_siswa'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat_siswa'),
        ]);

        return redirect()->route('TambahDataSiswa')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function upload_siswa(Request $request)
    {
        $request->validate([
            'file_siswa' => 'required|file|mimes:csv,xls,xlsx',
        ]);

        $file = $request->file('file_siswa');
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            // Hapus spasi ekstra
            $row = array_map("trim", $row);

            // Pengecekan jika jumlah elemen dalam $header dan $row tidak sama
            if (count($header) != count($row)) {
                continue;  // Lewati baris ini
            }

            $row = array_combine($header, $row);

            Siswa::create([
                'nis' => $row['nis'],
                'nama' => $row['nama'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'kelas_id' => $row['kelas_id'],
                'alamat' => $row['alamat'],
            ]);
        }

        return back()->with('success', 'Data siswa berhasil di-import.');
    }

    // memanggil data halaman siswa
    public function data_siswa(Request $request)
    {
        $kelas_id = $request->input('kelas_siswa');
        $siswa = Siswa::where('kelas_id', $kelas_id)->get();
        $kelasDipilih = Kelas::find($kelas_id);
        $dataRuangKelas = Kelas::all();
        return view('SuperAdmin.siswa', compact('siswa', 'dataRuangKelas', 'kelasDipilih'));
    }

    public function edit_siswa(Request $request, $id)
    {
        $dataSiswa = siswa::find($id);
        $request->validate(
            [
                'nama_siswa' => ['required', Rule::unique('siswa', 'nama')->ignore($dataSiswa->id)],
                'no_hp_siswa' => ['required', Rule::unique('siswa', 'no_hp')->ignore($dataSiswa->id)],
            ]
        );
        $dataSiswa->nama = $request->input('nama_siswa');
        $dataSiswa->no_hp = $request->input('no_hp_siswa');
        // Update field lainnya sesuai kebutuhan
        $dataSiswa->save();

        return redirect()->route('DataSiswa')->with('success', 'Data siswa berhasil diupdate.');
    }

    public function delete_siswa($id)
    {
        $dataSiswa = Siswa::find($id);
        if ($dataSiswa) {
            $dataSiswa->delete();
            return redirect()->route('DataSiswa')->with('success', 'Data siswa berhasil dihapus.');
        } else {
            return redirect()->route('DataSiswa')->with('error', 'Data siswa tidak ditemukan.');
        }
    }

    // halaman spp
    public function input_spp(Request $request)
    {
        $request->validate([
            'biaya_spp' => 'required|numeric',
        ]);

        spp::create([
            'harga_spp' => $request->input('biaya_spp'),
        ]);

        return redirect()->route('PembayaranSPP')->with('success', 'Biaya SPP berhasil disimpan.');
    }

    public function update_spp(Request $request)
    {
        $request->validate([
            'biaya_spp' => 'required|numeric',
        ]);

        $biaya_spp = spp::latest()->first();
        $biaya_spp->harga_spp = $request->input('biaya_spp');
        $biaya_spp->save();

        return redirect()->route('PembayaranSPP')->with('success', 'Biaya SPP berhasil diperbarui.');
    }

    public function input_tahun_ajaran(Request $request)
    {
        $request->validate([
            'tahun_ajaran_form' => 'required',
            'semester_form' => 'required'
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => $request->input('tahun_ajaran_form'),
            'semester' => $request->input('semester_form')
        ]);

        return back()->with('success', 'Data tahun ajaran berhasil ditambahkan');
    }

    public function edit_tahun_ajaran(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran_form' => 'required',
            'semester_form' => 'required'
        ]);

        $tahun_ajaran = TahunAjaran::find($id);
        if ($tahun_ajaran) {
            $tahun_ajaran->tahun_ajaran = $request->input('tahun_ajaran_form');
            $tahun_ajaran->semester = $request->input('semester_form');
            $tahun_ajaran->save();

            return back()->with('success', 'Data tahun ajaran berhasil diupdate.');
        } else {
            return back()->with('error', 'Data tahun ajaran tidak ditemukan.');
        }
    }

    public function delete_tahun_ajaran($id)
    {
        $tahun_ajaran = TahunAjaran::find($id);
        if ($tahun_ajaran) {
            $tahun_ajaran->delete();
            return back()->with('success', 'Data tahun ajaran berhasil dihapus.');
        } else {
            return back()->with('error', 'Data tahun ajaran tidak ditemukan.');
        }
    }

    public function tahun_ajaran_aktif(Request $request)
    {
        $request->validate([
            'tahun_ajaran_aktif' => 'required|exists:tahun_ajaran,id',
        ]);
    
        // set semua tahun ajaran dan semester menjadi tidak aktif
        TahunAjaran::where('is_active', true)->update(['is_active' => false]);
    
        // set tahun ajaran dan semester yang dipilih menjadi aktif
        $tahun_ajaran = TahunAjaran::find($request->tahun_ajaran_aktif);
        $tahun_ajaran->is_active = true;
        $tahun_ajaran->save();

        return back()->with('success', 'Data tahun ajaran aktif berhasil diupdate');
    }
}
