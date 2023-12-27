<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function proses(Request $request)
    {
        $dataTahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        $userId = auth()->user()->id;
        $bulanTagihan = $request->input('bulan_tagihan');
        $hargaSpp = $request->input('harga_spp');
        $status = 'Pending';
        $tanggalPembayaran = now();

        $pembayaran = Pembayaran::create([
            'user_id' => $userId,
            'bulan_tagihan' => $bulanTagihan,
            'tahun_ajaran' => $dataTahunAjaranAktif->tahun_ajaran,
            'harga_spp' => $hargaSpp,
            'status' => $status,
            'tanggal_pembayaran' => $tanggalPembayaran,
        ]);

        // configurasi midtrans dari official github
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // penggunaan snap midtrans dari official github
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $hargaSpp,
            ),
            'customer_details' => array (
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $pembayaran->snap_token = $snapToken;
        $pembayaran->save();

        return redirect()->route('checkout', $pembayaran->id)->with('success', 'Silahkan lanjutkan ke proses pembayaran');
    }

    public function checkout(Pembayaran $pembayaran)
    {
        $products = config('products');
        $product = collect($products)->firstWhere('id', $pembayaran->product_id);

        $bulanTagihanOptions = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('checkout', compact('pembayaran', 'product', 'bulanTagihanOptions'));
    }
}
