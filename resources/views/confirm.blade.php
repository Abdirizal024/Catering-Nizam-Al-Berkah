@extends('layouts.main')

@section('title', 'Konfirmasi Pesanan - Catering Nizam Al Berkah')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate text-center mb-5">
        <h1 class="mb-2 bread">Konfirmasi Pesanan</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard')}}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Konfrimasi Pesanan <i class="fa fa-chevron-right"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading" style="font-size: 36px;">Konfirmasi Pesanan</span>
                <h2 class="mb-2" style="font-size: 26px;">Silahkan Isi Form Konfirmasi Pesanan</h2>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-sm-12 p-4 p-md-5 d-flex align-items-center justify-content-center bg-primary" style="max-width: 600px; margin: 0 auto;">
                <form action="{{ route('order.process') }}" method="POST" class="appointment-form w-100">
                    @csrf
                    <h3 class="mb-3 text-center">Form Konfirmasi Pesanan</h3>
                    <h4 class="text-white">Menu Yang Di Pilih :</h4>
                    <h5 class="text-white">Nama Menu : {{ $menu->nama }}</h5>
                    <p class="text-white">Rincian Menu : {{ $menu->deskripsi }}</p>
                    <p class="text-white">Harga : Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>


                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                    <!-- Nama Anda Input -->
                    <div class="form-group">
                        <label for="customer_name" class="text-white">Nama Anda</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Masukkan Nama" required>
                    </div>

                    <!-- No WhatsApp Input -->
                    <div class="form-group">
                        <label for="customer_phone" class="text-white">No WhatsApp</label>
                        <input type="text" name="customer_phone" class="form-control" placeholder="Masukkan No WhatsApp" required>
                    </div>

                    <!-- Nama Alamat Input -->
                    <div class="form-group">
                        <label for="customer_address" class="text-white">Alamat Pengiriman</label>
                        <input type="text" name="customer_address" class="form-control" placeholder="Masukkan Alamat Pengiriman" required>
                    </div>

                     <!-- Jumlah ynag mau dibeli Input -->
                    <div class="form-group">
                        <label for="quantity" class="text-white">Jumlah/Porsi</label>
                        <input type="text" name="quantity" class="form-control" placeholder="Masukkan Jumlah" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-white py-3 px-4 w-50 mx-auto">Konfirmasi Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection

@section('extra_js')

    <script>
        // Any additional JavaScript for the homepage
    </script>
@endsection
