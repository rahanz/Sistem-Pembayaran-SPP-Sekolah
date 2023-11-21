@extends('Layouts.index')

@section('JudulHalaman', 'Tambah Kelas')
@section('HeaderPage', 'Tambah Kelas')

@section('TambahKelas')
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Gedung Kelas Baru</h3>
            </div>
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kelas</label>
                        <select class="form-control">
                            <option>Kelas X</option>
                            <option>Kelas XI</option>
                            <option>Kelas XII</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jurusan</label>
                        <select class="form-control">
                            <option>IPA</option>
                            <option>IPS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Ruang</label>
                        <input type="number" class="form-control" placeholder="Nomor kelas, IPA 1, IPS 1">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
