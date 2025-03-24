@extends('layouts.main')

@section('title', 'Invoice - Catering Nizam Al Berkah NAB')

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center mb-5">
                    <h1 class="mb-2 bread">Invoice Pesanan</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard') }}">Beranda <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Invoice <i
                                class="fa fa-chevron-right"></i></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                </div>
            </div>

            <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="row no-gutters">
                    <div class="col-sm-12 p-4 p-md-5 d-flex align-items-center justify-content-center bg-primary"
                        style="max-width: 750px; margin: 0 auto;">
                        <div class="card w-250">
                            <div class="card-header text-center">
                                <h3 class="text-center">Invoice Pesanan</h3>
                            </div>
                                <div class="card-body">
                                    <div id="printable-area">
                                        <h1 class="invoice-title">INVOICE PESANAN CATERING NIZAM</h1>
                                    <!-- Heading Invoice dengan posisi di atas -->
                                    <div class="d-flex justify-content-between align-items-center mb-3" id="print-btn">
                                        <h2 class="mt-0 mb-2 text-3xl font-bold" style="font-size: 26px; color: black;">
                                            INVOICE-{{ $order->id }}
                                        </h2>
                                        <button class="btn btn-outline-secondary d-flex align-items-center" id="print-button" aria-label="Cetak Invoice">
                                            <i class="fas fa-print icon-spacing" aria-hidden="true"></i>
                                            CETAK
                                        </button>
                                    </div>

                                    <div class="mb-6">
                                        <p class="text-dark"><strong>Nama Customer:</strong> {{ $order->customer_name }}</p>
                                        <p class="text-dark"><strong>Alamat Tujuan:</strong> {{ $order->customer_address }}
                                        </p>
                                        <p class="text-dark"><strong>No Hp Customer:</strong> {{ $order->customer_phone }}
                                        </p>
                                    </div>

                                    <div class="mb-6">
                                        <h3 class="text-lg font-semibold mb-2">STATUS PEMBAYARAN :</h3>
                                        <span
                                            class="badge text-white
                                        @if ($order->status == 'Pending') bg-warning text-uppercase
                                        @elseif ($order->status == 'Sudah Dibayar') bg-success text-uppercase
                                        @elseif ($order->status == 'Canceled') bg-danger text-uppercase
                                        @elseif ($order->status == 'Expired') bg-secondary text-uppercase @endif">
                                            {{ strtoupper($order->status) }}
                                        </span>
                                    </div>

                                    <div class="mb-6">
                                        <p><strong>Metode Pembayaran :</strong> {{ ucfirst($order->payment_method) }}</p>
                                        <p><strong>Bank :</strong> {{ $order->bank }} </p>
                                        <p><strong>Transaksi ID :</strong> {{ $order->transaction_id }}</p>
                                        <p><strong>Tanggal Pembayaran :</strong> {{ $order->paid_at ? \Carbon\Carbon::parse($order->paid_at)->format('d-m-Y H:i') : 'Belum Dibayar' }}</p>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Menu</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Harga Satuan</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $order->menu->nama }}</td>
                                                <td>{{ $order->menu->deskripsi }}</td>
                                                <!-- Deskripsi menu ditambahkan di sini -->
                                                <td>Rp {{ number_format($order->menu->harga, 0, ',', '.') }}</td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td>Subtotal</td>
                                                <td>Rp
                                                    {{ number_format($order->total_price + $order->ongkir, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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


<!-- Tambahkan ini di bagian head atau sebelum closing body tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>


<!-- Tambahkan script ini di bagian bawah body -->
<script>
 $(document).ready(function() {
    let isPrinting = false;

    $("#print-button").on("click", function() {
        if (!isPrinting) {
            isPrinting = true;
            $("#printable-area").printThis({
                importCSS: true,
                importStyle: true,
                loadCSS: "", // Tambahkan CSS khusus untuk mencetak jika diperlukan
                pageTitle: "",
                removeInline: false,
                printDelay: 333,
                header: null,
                footer: null,
                base: false,
                formValues: true,
                canvas: true,
                doctypeString: '<!DOCTYPE html>',
                removeScripts: false,
                copyTagClasses: false,
                beforePrintEvent: null,
                beforePrint: null,
                afterPrint: function() {
                    isPrinting = false;
                }
            });
        }
    });
});


    </script>
@endsection
