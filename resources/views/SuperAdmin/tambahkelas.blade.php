@extends('Layouts.index')

@section('JudulHalaman', 'Tambah Kelas')
@section('HeaderPage', 'Tambah Kelas')

@section('DataTableLink')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

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
                                <input type="text" class="form-control" placeholder="Contoh : X IPA 1, X IPS 1"
                                    name="ruang_kelas_siswa">
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Ruang Kelas</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Wali Kelas</th>
                                        <th>Jumlah Siswa</th>
                                        <th>L</th>
                                        <th>P</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_kelas as $kelas)
                                    <tr>
                                        <td>{{ $kelas->ruang_kelas }}</td>
                                        <td>{{ $kelas->wali_kelas}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn btn-warning btn-sm mr-3"><i class="fas fa-edit"></i></a>
                                                <form>
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            <!-- row -->
            </div>
        <!-- container fluid -->
        </div>
    </section>
@endsection