@extends('layouts.main')

@section('title', 'Detail Pesanan - Catering Nizam Al Berkah NAB')

@section('content')
<section class="hero-wrap hero-wrap-2" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center mb-5">
                <h1 class="mb-2 bread">Detail Pesanan</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard') }}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Detail Pesanan <i class="fa fa-chevron-right"></i></span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading" style="font-size: 36px;">Rincian Pesanan</span>
                <h2 class="mb-2" style="font-size: 26px;">Detail Pesanan Anda</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Rincian Pesanan</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <!-- Nama Lengkap -->
                            <div class="form-group">
                                <label for="customer_name">Nama Lengkap :</label>
                                <input type="text" id="customer_name" class="form-control" value="{{ $order->customer_name }}" readonly>
                            </div>

                            <!-- No WhatsApp -->
                            <div class="form-group">
                                <label for="customer_phone">No WhatsApp :</label>
                                <input type="text" id="customer_phone" class="form-control" value="{{ $order->customer_phone }}" readonly>
                            </div>

                            <!-- Pesanan Menu -->
                            <div class="form-group">
                                <label for="menu">Pesanan Menu :</label>
                                <textarea id="menu" class="form-control" rows="3" readonly>{{ $order->menu->nama }}; {{ $order->menu->deskripsi }}</textarea>
                            </div>

                            <!-- Harga -->
                            <div class="form-group">
                                <label for="harga">Harga :</label>
                                <input type="text" id="harga" class="form-control" value="Rp {{ number_format($order->menu->harga, 0, ',', '.') }}" readonly>
                            </div>

                            <!-- Tombol Bayar Sekarang -->
                            <div class="text-center">
                                <button id="pay-button" class="btn btn-primary mt-4">Bayar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('extra_js')
<!-- Midtrans Script -->
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        // Snap token dari server-side, ambil dari controller
        snap.pay('{{ $snapToken }}', {
 // Fungsi ini akan dipanggil setelah pembayaran selesai
 onSuccess: function(result) {
                // Arahkan ke halaman order success dengan order_id
                window.location.href = "/order-success?order_id={{ $order->id }}";
            },
            onPending: function(result) {
                alert('Menunggu Pembayaran!'); // Bisa diarahkan ke halaman menunggu pembayaran
            },
            onError: function(result) {
                alert('Pembayaran Gagal!');
            },
            onClose: function() {
                alert('Anda menutup pembayaran!');
            }
        });
    };
</script>
@endsection
