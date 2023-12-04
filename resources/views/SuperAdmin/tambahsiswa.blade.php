@extends('Layouts.index')

@section('JudulHalaman', 'Tambah Siswa')
@section('HeaderPage', 'Penambahan Data Siswa')

@section('TambahSiswa')
    <section class="content">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Penambahan Data Siswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ Route('InputSiswa') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <!-- text input for Nim -->
                            <div class="form-group">
                                <label>Nis</label>
                                <input type="number" class="form-control" name="nis_siswa" placeholder="Nomor Induk Siswa">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama_siswa" placeholder="Nama lengkap">
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin_siswa">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Kelas -->
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control" name="kelas_id">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($dataKelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->ruang_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat_siswa"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </section>
@endsection
