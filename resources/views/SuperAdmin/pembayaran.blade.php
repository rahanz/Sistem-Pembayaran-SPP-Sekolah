@extends('Layouts.index')

@section('JudulHalaman', 'Pembayaran SPP')
@section('HeaderPage', 'Pembayaran SPP')

@section('Pembayaran')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan Biaya Pembayaran SPP</h3>
                        </div>
                        @if ($biaya_spp)
                            <form method="POST" action="{{ route('UpdateSPP') }}">
                                @csrf
                                @method('PUT')
                            @else
                                <form method="POST" action="{{ route('InputSPP') }}">
                                    @csrf
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="biaya_spp">Biaya SPP</label>
                                <input type="number" name="biaya_spp" class="form-control" id="biaya_spp"
                                    placeholder="inputkan biaya spp perbulan"
                                    value="{{ $biaya_spp ? $biaya_spp->harga_spp : '' }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">{{ $biaya_spp ? 'Update' : 'Submit' }}</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- right column -->
                <div class="col-md-6">
                    <!-- Display the latest SPP fee -->
                    <div class="card bg-light mb-3 shadow">
                        <div class="card-header text-white bg-navy">Biaya SPP Yang Harus di Bayarkan Siswa</div>
                        <div class="card-body">
                            @if ($biaya_spp)
                                <h5 class="card-title font-weight-bold">Rp
                                    {{ number_format($biaya_spp->harga_spp, 2, ',', '.') }}</h5>
                                <p class="card-text text-muted">Biaya SPP per bulan SMAN 7 Kota Bengkulu.</p>
                            @else
                                <p class="card-text">Belum ada biaya SPP yang ditetapkan.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Menginputkan Tahun AJaran -->
                <div class="col-md-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Input Tahun Ajaran dan Semester</h3>
                        </div>
                        <form method="POST" action="{{ Route('InputTahunAjaran') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran_form" class="form-control" id="tahun_ajaran"
                                        placeholder="Masukkan tahun ajaran, misal: 2023/2024" value="">
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester_form" class="form-control" id="semester">
                                        <option value="">-- Pilih Semester --</option>
                                        <option value="ganjil">Ganjil</option>
                                        <option value="genap">Genap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Setting tahun ajaran aktif -->
                <div class="col-md-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Setting Tahun Ajaran dan Semester Aktif</h3>
                        </div>
                        <form method="POST" action="{{ Route('TahunAjaranAktif') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tahun_ajaran_aktif">Tahun Ajaran Aktif</label>
                                    <select name="tahun_ajaran_aktif" class="form-control" id="tahun_ajaran_aktif">
                                        <option>-- Pilih Tahun Ajaran Aktif --</option>
                                        @foreach ($data_tahun_ajaran as $tahun_ajaran)
                                            <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->tahun_ajaran }} - {{ $tahun_ajaran->semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Tabel Data Tahun Ajaran -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Tahun Ajaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_tahun_ajaran as $TahunAjaran)
                                        <tr>
                                            <td>{{ $TahunAjaran->tahun_ajaran }}</td>
                                            <td>{{ $TahunAjaran->semester }}</td>
                                            <td>
                                                @if ($TahunAjaran->is_active)
                                                    Tahun Ajaran Aktif @else
                                                    Bukan Tahun Ajaran Aktif
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!-- Tombol Edit -->
                                                    <button type="button" class="btn btn-warning btn-sm mr-3"
                                                        data-toggle="modal" data-target="#editModal{{ $TahunAjaran->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <!-- Tombol Delete -->
                                                    <form action="{{ Route('HapusTahunAjaran', $TahunAjaran->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Edit -->
            @foreach ($data_tahun_ajaran as $TahunAjaran)
                <div class="modal fade" id="editModal{{ $TahunAjaran->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Tahun Ajaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ Route('EditTahunAjaran', $TahunAjaran->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <input type="text" name="tahun_ajaran_form" class="form-control"
                                            id="tahun_ajaran" value="{{ $TahunAjaran->tahun_ajaran }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <select name="semester_form" class="form-control" id="semester">
                                            <option value="ganjil"
                                                {{ $TahunAjaran->semester == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                                            <option value="genap"
                                                {{ $TahunAjaran->semester == 'genap' ? 'selected' : '' }}>Genap</option>
                                        </select>
                                    </div>
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
    </section>
@endsection
