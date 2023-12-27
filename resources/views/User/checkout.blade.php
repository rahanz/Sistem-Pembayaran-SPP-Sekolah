@extends('Layouts.user_index')

@section('JudulHalaman', 'Checkout')
@section('HeaderPage', 'Checkout Pembayaran')

@section('HalamanCheckout')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Checkout</h3>
                        </div>
                        <form action="{{ route('proses_checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="snap_token" value="{{ $pembayaran->snap_token }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama : {{ $data_siswa->nama }}</label><br>
                                    <label for="tahun_ajaran_aktif_saat_membayar">Tahun Ajaran : {{ $tahunAjaranAktif->tahun_ajaran }} - {{ $tahunAjaranAktif->semester }}</label><br>
                                    <label for="waktu_pembayaran">Tanggal Pembayaran : {{ $tanggalPembayaran }}</label><br>
                                    <label for="masukkan_bulan_yang_ingin_dibayar">Tagihan Bulan Spp : </label>
                                    <select class="form-control" name="bulan_yang_dibayarkan">
                                        <option value="">-- Pilih Tagihan Bulan Spp --</option>
                                        @foreach ($bulanTagihanOption as $bulanOpton)
                                            <option value="{{ $bulanOption}}">{{ $bulanOption }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Bayar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
