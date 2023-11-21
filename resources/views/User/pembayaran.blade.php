@extends('Layouts.user_index')

@section('DashboardSIswa')
    <div class="row">
        <div class="col-md-12">
            <!-- Tambahkan kode HTML/Blade sesuai kebutuhan -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tagihan SPP</h3>
                </div>
                <div class="card-body">
                    <!-- Tabel atau elemen lainnya untuk menampilkan data tagihan -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Gantilah dengan data yang sesuai dari controller -->
                            <tr>
                                <td>Juli 2023</td>
                                <td>Sudah Dibayar</td>
                                <td>Rp 500.000</td>
                            </tr>
                            <tr>
                                <td>Agustus 2023</td>
                                <td>Belum Dibayar</td>
                                <td>Rp 500.000</td>
                            </tr>
                            <!-- Tambahkan data tagihan lainnya -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
