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
                        <div class="col-sm-6">
                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama_siswa" placeholder="Nama lengkap">
                            </div>
                            <!-- No HP -->
                            <div class="form-group">
                                <label>No Handphone</label>
                                <input type="number" class="form-control" name="no_hp_siswa" placeholder="Nomor Handphone Aktif">
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
                <!-- Tombol untuk memunculkan modal -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">Upload
                    CSV/Excel</button>
            </div>
            </form>
        </div>
    </section>

    <!-- Modal Upload CSV -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ Route('UploadSiswa') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>File CSV</label>
                            <input type="file" class="form-control" name="file_siswa">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
