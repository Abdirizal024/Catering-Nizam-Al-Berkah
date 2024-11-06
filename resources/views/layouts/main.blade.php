<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Catering Nizam Al Berkah NAB')</title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Link CSS Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @yield('extra_css')
    <style>
        /* Efek hover pada menu-wrap */
.menu-wrap {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 10px;
    transition: all 0.3s ease-in-out;
}

/* Hover Effect: Perbesar gambar dan tambahkan shadow */
.menu-wrap:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px); /* Elemen akan sedikit naik */
}

/* Hover Effect pada gambar */
.menu-img {
    background-size: cover;
    background-position: center;
    height: 200px; /* Sesuaikan tinggi gambar */
    transition: transform 0.3s ease-in-out;
}

/* Perbesar gambar pada hover */
.menu-wrap:hover .menu-img {
    transform: scale(1.1);
}
/* Efek hover pada teks */
.menu-wrap:hover h3,
.menu-wrap:hover h5,
.menu-wrap:hover p,
.menu-wrap:hover .price {
    color: #dc3545; /* Ubah warna teks saat hover */
    transition: color 0.3s ease-in-out;
}
/* Style untuk tombol Back to Top */
#back-to-top {
    position: fixed;
    bottom: 30px;   /* Menempatkan tombol 30px dari bawah */
    left: 30px;    /* Menempatkan tombol 30px dari kanan */
    display: none;  /* Tombol tidak muncul secara default */
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;     /* Lebih besar agar ikon lebih jelas */
    height: 40px;
    font-size: 24px;  /* Ukuran ikon */
    text-align: center;
    line-height: 30px;  /* Menyelaraskan ikon di tengah tombol */
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

/* Hover effect pada tombol */
#back-to-top:hover {
    background-color: #0056b3;
    opacity: 0.8;
    transform: scale(1.1);  /* Efek sedikit membesar pada hover */
}

/* Navbar toggle */
.navbar-brand {
    margin-right: 0;
}

.navbar-collapse {
    display: flex; /* Tetap tampil di desktop */
    justify-content: flex-end;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

@media (max-width: 991.98px) {
    .navbar-collapse {
        display: block;
        position: fixed; /* Tetapkan posisi fixed untuk overlay */
        top: 70px;
        left: 0;
        height: 65%; /* Membuat dropdown mengambil seluruh tinggi layar */
        width: 250px; /* Lebar fixed menu */
        padding: 1rem;
        background-color: rgba(52, 58, 64, 0.95); /* Warna latar belakang dengan transparansi */
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        transform: translateX(-100%); /* Mulai dari luar sisi kiri layar */
        opacity: 0; /* Awalnya tidak terlihat */
        pointer-events: none; /* Cegah interaksi saat tersembunyi */
        transition: transform 0.3s ease, opacity 0.3s ease;
        z-index: 1000; /* Pastikan dropdown berada di atas konten lainnya */
        overflow-y: auto; /* Tambahkan penggulungan vertikal jika konten melebihi tinggi */
    }

    .navbar-collapse.show {
        transform: translateX(0); /* Slide masuk ke tampilan dari kiri */
        opacity: 1; /* Tampilkan dropdown */
        pointer-events: auto; /* Aktifkan interaksi */
    }

    .navbar-brand {
        margin-right: auto;
    }

    .navbar-nav {
        margin-left: 0;
    }

    .navbar-toggler {
        display: block;
        z-index: 1100; /* Pastikan ikon toggler tetap di atas dropdown */
    }
}

/* Warna ikon toggler default */
.navbar-toggler i {
    color: white;
}

/* Warna ikon dan navbar saat di-scroll */
.navbar.scrolled .navbar-toggler i {
    color: black;
}

.navbar.scrolled {
    background-color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}





    </style>
</head>
<body>
    <!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
    @include('partials.header')


@yield('content')
<!-- <a href="https://wa.me/6285654800639?text=Hallo%20Kaka,%20saya%20ingin%20bertanya%3F" class="whatsapp-float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
<span class="whatsapp-text">WhatsApp</span> -->
<!-- <script>
                var url = 'https://wati-integration-prod-service.clare.ai/v2/watiWidget.js?67302';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url;
                var options = {
                "enabled":true,
                "chatButtonSetting":{
                    "backgroundColor":"#00e785",
                    "ctaText":"Obrolan dengan Kami",
                    "borderRadius":"25",
                    "marginLeft": "0",
                    "marginRight": "20",
                    "marginBottom": "20",
                    "ctaIconWATI":false,
                    "position":"right"
                },
                "brandSetting":{
                    "brandName":"Wati",
                    "brandSubTitle":"undefined",
                    "brandImg":"https://www.wati.io/wp-content/uploads/2023/04/Wati-logo.svg",
                    "welcomeText":"Hai!, Ada yang bisa saya bantu?",
                    "messageText":"Saya telah mengunjungi website Catering, dan saya ada beberapa pertanyaan",
                    "backgroundColor":"#00e785",
                    "ctaText":"Obrolan dengan Kami",
                    "borderRadius":"25",
                    "autoShow":true,
                    "phoneNumber":"6285654800639"
                }
                };
                s.onload = function() {
                    CreateWhatsappChatWidget(options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            </script> -->

      <!-- <script async src='https://d2mpatx37cqexb.cloudfront.net/delightchat-whatsapp-widget/embeds/embed.min.js'></script>
        <script>
          var wa_btnSetting = {"btnColor":"#16BE45","ctaText":"Hubungi Kami","cornerRadius":40,"marginBottom":20,"marginLeft":20,"marginRight":20,"btnPosition":"right","whatsAppNumber":"6285654800639","welcomeMessage":"Saya telah mengunjungi website Catering, dan saya ada beberapa pertanyaan","zIndex":999999,"btnColorScheme":"light"};
          var wa_widgetSetting = {"title":"Catering Nizam Al Berkah","subTitle":"Biasanya dibalas dalam 10 menit","headerBackgroundColor":"#FBFFC8","headerColorScheme":"dark","greetingText":"Hai!, \nAda yang bisa saya bantu?","ctaText":"Mulai Chat","btnColor":"#1A1A1A","cornerRadius":40,"welcomeMessage":"Hello","btnColorScheme":"light","brandImage":"https://uploads-ssl.webflow.com/5f68a65cd5188c058e27c898/6204c4267b92625c9770f687_whatsapp-chat-widget-dummy-logo.png","darkHeaderColorScheme":{"title":"#333333","subTitle":"#4F4F4F"}};
          window.onload = () => {
            _waEmbed(wa_btnSetting, wa_widgetSetting);
          };
        </script> -->

<!-- Tombol Back to Top dengan Icon -->
<button id="back-to-top" class="btn btn-primary">
    <i class="fa-solid fa-arrow-up"></i>  <!-- Ikon Font Awesome -->
</button>

<script>
    // Mendapatkan elemen tombol
var backToTopButton = document.getElementById("back-to-top");

// Menampilkan tombol saat scroll lebih dari 200px
window.onscroll = function() {
    if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
        backToTopButton.style.display = "block";  // Menampilkan tombol
    } else {
        backToTopButton.style.display = "none";   // Menyembunyikan tombol
    }
};

// Fungsi untuk scroll kembali ke atas
backToTopButton.onclick = function() {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"  // Efek scroll halus
    });
};

$(document).ready(function() {
      $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggleClass('show');
      });
    });

    document.addEventListener('scroll', function() {
        const navbar = document.getElementById('ftco-navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>


<script
    src='https://sleekflow.io/whatsapp-button.js'
    async
    onLoad="whatsappButton({
    buttonName:'Konsultasi Sekarang',
    buttonIconSize: '32',
    brandImageUrl:'https://sleekflow.io/static/images/sleekflow-icon.png',
    brandName:'Catering Nizam Al Berkah',
    brandSubtitleText:'Biasanya dibalas dalam 10 menit',
    buttonSize:'medium',
    buttonPosition:'right',
    callToAction:'Mulai Chat',
    phoneNumber:'6285349468461',
    welcomeMessage:'Hai!, Ada yang bisa saya bantu?',
    prefillMessage:'Saya telah mengunjungi website Catering, dan saya ada beberapa pertanyaan',
    })"
    >
</script>

{{-- <!-- Load CKEditor 4 -->
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

<!-- Initialize CKEditor -->
<script>
    CKEDITOR.replace('testimonial');
</script> --}}



@include('partials.footer')

    <!-- JavaScript -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&sensor=false"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @yield('extra_js')
</body>
</html>
