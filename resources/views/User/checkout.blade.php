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
                        <form id="pay-form" action="{{ route('proses-checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="snap_token" value="{{ $pembayaran->snap_token }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" hidden name="user_id" value="{{ Auth::user()->id }}">
                                    <label for="nama_siswa">Nama : {{ $data_siswa }}</label><br>
                                    <label for="tahun_ajaran_aktif_saat_membayar">Tahun Ajaran :
                                        {{ $dataTahunAjaranAktif->tahun_ajaran }}</label><br>
                                    <label for="waktu_pembayaran">Tanggal Pembayaran :
                                        {{ \Carbon\Carbon::now()->toDateString() }}</label><br>
                                    <label for="masukkan_bulan_yang_ingin_dibayar">Tagihan Bulan Spp : </label>
                                    <select class="form-control" name="bulan_yang_dibayarkan">
                                        <option value="">-- Pilih Tagihan Bulan Spp --</option>
                                        @foreach ($bulanTagihanOptions as $bulanOption)
                                            <option value="{{ $bulanOption }}">{{ $bulanOption }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-dark" id="pay-button">Bayar Sekarang</button>
                            </div>
                        </form>
                        <div hidden class="card-body">
                            <h5>Hasil JSON:</h5>
                            <pre id="result-json"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <!-- Tambahkan script Snap.js dan konfigurasi client key -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from the previous step
            snap.pay('<?= $snapToken ?>', {
                // Optional
                onSuccess: function(result) {
                    // Penanganan ketika pembayaran berhasil
                    document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);

                    // Setelah pembayaran berhasil, submit form secara otomatis
                    document.getElementById('pay-form').submit();
                },
                // Optional
                onPending: function(result) {
                    // Penanganan ketika pembayaran dalam status pending
                    document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    // Penanganan ketika terjadi kesalahan pada pembayaran
                    document.getElementById('result-json').innerHTML = JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endpush
