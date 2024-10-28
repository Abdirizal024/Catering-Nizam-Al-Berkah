@extends('layouts.main')

@section('title', 'Beranda - Catering Nizam Al Berkah NAB')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate text-center mb-5">
					<h1 class="mb-2 bread">Testimony Customer</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard')}}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Testimoni <i class="fa fa-chevron-right"></i></span></p>
				</div>
			</div>
		</div>
	</section>


	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading" style="font-size: 36px;">Testimoni</span>
					<h2 class="mb-2" style="font-size: 26px;">Silahkan Isi From Untuk Testimoni Kami</h2>
				</div>
			</div>
			<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
			<div class="row no-gutters">
    <div class="col-sm-12 p-4 p-md-5 d-flex align-items-center justify-content-center bg-primary" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data" class="appointment-form w-100">
            @csrf
            <h3 class="mb-3 text-center">From Testimoni Customer</h3>

            <!-- Name Input -->
            <div class="form-group">
                <label for="name" class="text-white">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama" required>
            </div>

            <!-- Position Input -->
            <div class="form-group">
                <label for="position" class="text-white">Position</label>
				<span class="text-white d-block mb-2 small">( *Misalnya: Customer, Pengguna, atau User* )</span>
                <input type="text" id="position" name="position" class="form-control mt-2" placeholder=" Masukkan Kedudukan">
            </div>

            <!-- Image Input -->
            <div class="form-group">
                <label for="image" class="text-white">Upload Foto Anda</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="form-group">
        <label for="rating" class="text-white">Berikan Rating pada Catering Kami</label>
        <div class="star-rating-input">
        <input type="radio" id="star5" name="rating" value="5" />
        <label for="star5" title="5 stars"><i class="fa fa-star"></i></label>

        <input type="radio" id="star4" name="rating" value="4" />
        <label for="star4" title="4 stars"><i class="fa fa-star"></i></label>

        <input type="radio" id="star3" name="rating" value="3" />
        <label for="star3" title="3 stars"><i class="fa fa-star"></i></label>

        <input type="radio" id="star2" name="rating" value="2" />
        <label for="star2" title="2 stars"><i class="fa fa-star"></i></label>

        <input type="radio" id="star1" name="rating" value="1" />
        <label for="star1" title="1 star"><i class="fa fa-star"></i></label>
    </div>
</div>

            <!-- Testimonial Textarea -->
            <div class="form-group">
                <label for="testimonial" class="text-white">Testimonial</label>
                <textarea id="testimonial" name="testimonial" rows="4" class="ckeditor form-control" placeholder="Tuliskan testimonial Anda di sini" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-white py-3 px-4 w-50 mx-auto">Kirim</button>
            </div>
        </form>
    </div>
</div>
	</div>
		</div>
	</section>

@endsection

@section('extra_js')


@endsection
