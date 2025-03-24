@extends('layouts.main')

@section('title', 'Detail Pesanan - Catering Nizam Al Berkah NAB')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
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
                <span class="subheading" style="font-size: 36px;">Detail Pesanan Anda</span>
                <h2 class="mb-2" style="font-size: 26px;">Rincian Pesanan dan Pembayaran</h2>
            </div>
        </div>

        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="row no-gutters">
                <div class="col-sm-12 p-4 p-md-5 d-flex align-items-center justify-content-center bg-primary" style="max-width: 600px; margin: 0 auto;">
                    <div class="card w-100">
                        <div class="card-header text-center">
                            <h3 class="text-center">Rincian Pesanan</h3>
                                @if ($order->status == 'expired')
    <div class="text-center">
        <a href="{{ route('order.continue', $order->id) }}" class="btn btn-warning mt-4">Lanjutkan Pembayaran</a>
    </div>
    @endif
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th style="text-align: left;">Nama Lengkap :</th>
                                    <td>{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">No WhatsApp :</th>
                                    <td>{{ $order->customer_phone }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Alamat Pengiriman :</th>
                                    <td>{{ $order->customer_address }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Pesanan Menu :</th>
                                    <td>{{ $order->menu->nama }}; {{ $order->menu->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Harga Satuan :</th>
                                    <td>Rp {{ number_format($order->menu->harga, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Jumlah yang Dibeli :</th>
                                    <td>{{ $order->quantity }}</td>
                                </tr>
                            </table>

                            <!-- Tombol Bayar Sekarang -->
                            <div class="text-center">
                                <button id="pay-button" class="btn btn-danger py-3 px-4 w-50 mx-auto mt-4">Bayar Sekarang</button>
                            </div>
                        </div>
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
                window.location.href = "{{ route('order.invoice', ['id' => $order->id]) }}";
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
