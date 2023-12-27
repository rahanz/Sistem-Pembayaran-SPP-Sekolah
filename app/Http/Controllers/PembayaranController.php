<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\siswa;
use App\Models\Spp;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function proses(Request $request)
    {
        $dataTahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        $userId = auth()->user()->id;
        $bulanTagihan = now()->format('m');
        $hargaSpp = Spp::latest()->value('harga_spp');
        $status = 'Pending';
        $tanggalPembayaran = today();

        $pembayaran = Pembayaran::create([
            'user_id' => $userId,
            'bulan_tagihan' => $bulanTagihan,
            'tahun_ajaran' => $dataTahunAjaranAktif->tahun_ajaran,
            'harga_spp' => $hargaSpp,
            'status' => $status,
            'tanggal_pembayaran' => $tanggalPembayaran,
        ]);

        // Konfigurasi midtrans dari official github
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Penggunaan snap midtrans dari official github
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $hargaSpp,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $pembayaran->snap_token = $snapToken;
        $pembayaran->save();

        return redirect()->route('tampilan_checkout', $pembayaran->id)->with('success', 'Silahkan lanjutkan ke proses pembayaran');
    }


    public function tampilan_checkout(Request $request, Pembayaran $pembayaran)
    {
        $dataTahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
        $data_siswa = auth()->user()->name;
        $products = config('products');
        $product = collect($products)->firstWhere('id', $pembayaran->product_id);

        $hargaSpp = Spp::latest()->value('harga_spp');
        $user_id = $request->input('user_id');

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $hargaSpp,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $pembayaran->snap_token = $snapToken;
        $pembayaran->save();

        $bulanTagihanOptions = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('User.checkout', compact('pembayaran', 'product', 'bulanTagihanOptions', 'data_siswa', 'dataTahunAjaranAktif'));
    }

}
