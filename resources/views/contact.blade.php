@extends('layouts.main')

@section('title', 'Kontak Kami - Catering Nizam Al Berkah')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate text-center mb-5">
        <h1 class="mb-2 bread">Hubungi Kami</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('dashboard')}}">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Kontak Kami <i class="fa fa-chevron-right"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section contact-section bg-light">
  <div class="container">
    <div class="row d-flex contact-info">
      <div class="col-md-12">
        <h2 class="h4 font-weight-bold">Informasi Kontak</h2>
      </div>
      <div class="w-100"></div>
      <div class="col-md-3 d-flex">
       <div class="dbox">
         <p><span>Alamat :</span> Jl. Sei Andai Komplek Permata Hijau 4 No.9, Sungai Jingah, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70122</p>
       </div>
     </div>
     <div class="col-md-3 d-flex">
       <div class="dbox">
         <p><span>No Telepon </span> <a href="wa.me/6285349468461">+6285349468461</a></p>
       </div>
     </div>
     <div class="col-md-3 d-flex">
       <div class="dbox">
       <p><span>Email :</span> <a href="https://mail.google.com/mail/?view=cm&fs=1&to=radenehsan21@gmail.com" target="_blank">radenehsan21@gmail.com</a></p>
       </div>
     </div>
     <div class="col-md-3 d-flex">
       <div class="dbox">
         <p><span>Website</span> <a href="#">catering.nizam.com</a></p>
       </div>
     </div>
   </div>
 </div>
</section>
<section class="ftco-section ftco-no-pt contact-section">
 <div class="container">
  <div class="row d-flex align-items-stretch no-gutters">
   <div class="col-md-6 p-5 order-md-last">
    <h2 class="h4 mb-5 font-weight-bold">Hubungi Kami</h2>
    <form action="#">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Your Name">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Your Email">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Subject">
      </div>
      <div class="form-group">
        <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
      </div>
    </form>
  </div>
  <div class="col-md-6 d-flex align-items-stretch">
    <div id="map"></div>
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