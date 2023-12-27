<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran SPP</title>
</head>
<body>
    <h1>Pembayaran SPP</h1>
    <button id="pay-button">Bayar Sekarang</button>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}'); // Replace it with your transaction token
      };
    </script>
</body>
</html>
