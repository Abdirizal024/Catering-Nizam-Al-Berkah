@extends('layouts.main')

@section('title', 'Pembayaran Berhasil - Catering Nizam Al Berkah NAB')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center mb-5">
                <h1 class="mb-2 bread">Pembayaran Berhasil</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard') }}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Pembayaran <i class="fa fa-chevron-right"></i></span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading" style="font-size: 36px;">Status Pembayaran</span>
                <h2 class="mb-2" style="font-size: 26px;">Terima Kasih atas Pembayaran Anda</h2>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Rincian Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Pembayaran Anda telah berhasil! Terima kasih telah memesan dari kami.</p>
                        <div class="text-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
