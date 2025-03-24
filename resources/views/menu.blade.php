@extends('layouts.main')

@section('title', 'Menu - Catering Nizam Al Berkah')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate text-center mb-5">
					<h1 class="mb-2 bread">Menu</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard')}}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Menu <i class="fa fa-chevron-right"></i></span></p>
				</div>
			</div>
		</div>
	</section>

    <section class="ftco-section">
        <div class="container">
            <!-- Judul Section -->
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Specialties</span>
                    <h2 class="mb-4">Menu Kami</h2>
                </div>
            </div>
            <!-- Daftar Menu -->
            <div class="row">
                @foreach($menus as $menu)
                <div class="col-md-6 col-lg-4 mb-4"> <!-- Menambahkan margin bawah -->
                    <div class="menu-wrap hover-effect">
                        <!-- Nama Menu -->
                        <div class="heading-menu text-center ftco-animate">
                            <h3>{{ $menu->nama }}</h3>
                        </div>

                        <!-- Gambar dan Deskripsi Menu -->
                        <div class="menus d-flex ftco-animate">
                            <!-- Gambar Menu -->
                            <div class="menu-img img" style="background-image: url({{ asset('storage/' . $menu->gambar) }});"></div>
                            <!-- Rincian Menu -->
                            <div class="text pl-3"> <!-- Menambahkan padding kiri -->
                                <h5 class="mt-2 mb-2">Rincian Menu</h5>
                                <p>{{ $menu->deskripsi }}</p>

                                <!-- Harga -->
                                <div class="one-forth">
                                    <span class="price mb-2 d-block" style="white-space: nowrap;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                </div>

                                <!-- Tombol Pesan Sekarang -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('order.confirm', $menu->id) }}">
                                        <button type="button" class="btn btn-primary mt-3">Pesan Sekarang</button>
                                    </a>
                                </div>
                            </div> <!-- End .text -->
                        </div> <!-- End .menus -->
                    </div> <!-- End .menu-wrap -->
                </div> <!-- End .col-md-6 col-lg-4 -->
                @endforeach
            </div> <!-- End .row -->
        </div> <!-- End .container -->
    </section>

@endsection

@section('extra_js')



@endsection
