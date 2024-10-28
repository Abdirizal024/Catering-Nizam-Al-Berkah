@extends('layouts.main')

@section('title', 'Tentang Kami - Catering Nizam Al Berkah')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate text-center mb-5">
        <h1 class="mb-2 bread">Tentang Kami</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard')}}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Tentang Kami <i class="fa fa-chevron-right"></i></span></p>
      </div>
    </div>
  </div>
</section>


<section class="ftco-section ftco-no-pt ftco-no-pb">
 <div class="container">
  <div class="row d-flex">
    <div class="col-md-6 d-flex">
     <div class="img img-2 w-100 mr-md-2" style="background-image: url(images/bg_6.jpg);"></div>
     <div class="img img-2 w-100 ml-md-2" style="background-image: url(images/bg_4.jpg);"></div>
   </div>
   <div class="col-md-6 ftco-animate makereservation p-4 p-md-5">
     <div class="heading-section ftco-animate mb-5">
      <span class="subheading">This is our secrets</span>
      <h2 class="mb-4">Perfect Ingredients</h2>
      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
      </p>
      <p><a href="#" class="btn btn-primary">Learn more</a></p>
    </div>
  </div>
</div>
</div>
</section>

<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_4.jpg);" data-stellar-background-ratio="0.5">
 <div class="container">
  <div class="row d-md-flex align-items-center justify-content-center">
   <div class="col-lg-10">
    <div class="row d-md-flex align-items-center">
      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text">
            <strong class="number" data-number="100">0</strong>
            <span>Tasty Dishes</span>
          </div>
        </div>
      </div>
      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text">
            <strong class="number" data-number="4000">0</strong>
            <span>Dishes Served</span>
          </div>
        </div>
      </div>
      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text">
            <strong class="number" data-number="10">0</strong>
            <span>Restaurants</span>
          </div>
        </div>
      </div>
      <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text">
            <strong class="number" data-number="10000">0</strong>
            <span>Happy Customers</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
			<!-- Google Maps Section -->
			<div class="row justify-content-center mb-5 pb-5">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Maps</span>
					<h2 class="mb-4">Lokasi Catering Kami</h2>
				</div>
			</div>
				<!-- Map Container -->
				<div class="card-body">
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2041296.4257442676!2d113.8720768!3d-2.188902399999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423890458b6f3%3A0x9d253dd8a63cd7cd!2sCatering%20NAB%20Nizam%20al%20berkah!5e0!3m2!1sid!2sid!4v1727458744873!5m2!1sid!2sid"
                      width="600"
                      height="450"
                      style="border: 0; width: 100%"
                      allowfullscreen=""
                      loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                  </div>
		</section>
@endsection

@section('extra_js')

    <script>
        // Any additional JavaScript for the homepage
    </script>
@endsection