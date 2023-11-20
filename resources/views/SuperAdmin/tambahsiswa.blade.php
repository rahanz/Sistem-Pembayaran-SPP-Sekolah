@extends('Layouts.index')

@section('JudulHalaman', 'Tambah Siswa')
@section('HeaderPage', 'Penambahan Data Siswa')
@section('TambahSiswa')

    <section class="content">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Penambahan Siswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nim</label>
                                <input type="text" class="form-control" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control">
                                    <option>Kelas X</option>
                                    <option>Kelas XI</option>
                                    <option>Kelas XII</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jurusan</label>
                                <select class="form-control">
                                    <option>IPA</option>
                                    <option>IPS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

@endsection
