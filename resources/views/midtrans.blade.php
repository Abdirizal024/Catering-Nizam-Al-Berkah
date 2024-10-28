@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Pembayaran</h2>
    <button id="pay-button">Bayar Sekarang</button>
</div>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert('transaksi berhasil!'); // Handle success response
                console.log(result);
            },
            onPending: function(result){
                alert('waiting your payment!'); // Handle pending response
                console.log(result);
            },
            onError: function(result){
                alert('payment failed!'); // Handle error response
                console.log(result);
            }
        });
    };
</script>
@endsection
