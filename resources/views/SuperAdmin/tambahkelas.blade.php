@extends('Layouts.index')

@section('JudulHalaman', 'Tambah Kelas')
@section('HeaderPage', 'Tambah Kelas')

@section('TambahKelas')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Ruang Kelas</h3>
            </div>
            <form action="{{ Route('InputTambahKelas') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Kelas -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Wali Kelas</label>
                                <input type="text" class="form-control" name="wali_kelas_siswa">
                            </div>
                        </div>
                        <!-- Jurusan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kelas</label>
                                <input type="text" class="form-control" placeholder="Contoh : X IPA 1, X IPS 1" name="ruang_kelas_siswa">
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