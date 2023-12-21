@extends('Layouts.index')

@section('JudulHalaman', 'Data Siswa')
@section('HeaderPage', 'Data Siswa')

@section('DataSiswa')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Data Siswa dan Kelas</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ Route('TampilTabel') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="data_kelas">Kelas</label>
                                <select class="form-control select2" name="kelas_siswa">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($dataRuangKelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->ruang_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- footer -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @if (count($siswa) > 0)
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kelas {{ isset($kelasDipilih) ? $kelasDipilih->ruang_kelas : '' }}
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No Hp</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $data_siswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data_siswa->nama }}</td>
                                                <td>{{ $data_siswa->no_hp }}</td>
                                                <td>{{ $data_siswa->jenis_kelamin }}</td>
                                                <td>{{ $data_siswa->alamat }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="#" class="btn btn-warning btn-sm mr-3"
                                                            data-toggle="modal"
                                                            data-target="#editSiswaModal{{ $data_siswa->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ Route('DeleteSiswa', $data_siswa->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"><i
                                                                    class="fas fa-trash"></i></button>
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
    @endif

    <!-- Modal Edit Siswa -->
    @foreach ($siswa as $data_siswa)
        <div class="modal fade" id="editSiswaModal{{ $data_siswa->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editSiswaModalLabel{{ $data_siswa->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSiswaModalLabel{{ $data_siswa->id }}">Edit Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ Route('EditSiswa', $data_siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <!-- Form Edit -->
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input type="text" class="form-control" name="nama_siswa"
                                    value="{{ $data_siswa->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="No_Hp">No Hp</label>
                                <input type="text" class="form-control" placeholder="Contoh : 08123456789"
                                    name="no_hp_siswa" value="{{ $data_siswa->no_hp }}">
                            </div>
                            <div class="form-group">
                                <label for="Jenis_Kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin_siswa" class="form-control">
                                    <option value="Laki-laki" {{ $data_siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $data_siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label for="Alamat">Alamat</label>
                                <textarea class="form-control" name="alamat_siswa">{{ $data_siswa->alamat }}</textarea>
                            </div>
                            <!-- Tambahkan form lainnya sesuai kebutuhan -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection


@section('StyleHalamanSiswa')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">
@endsection

@section('ScriptHalmanSiswa')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('adminlte/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
@endsection
