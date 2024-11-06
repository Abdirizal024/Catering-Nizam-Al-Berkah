<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Catering Nizam Al Berkah')</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-flash.min.css">

    <style>
      .card-header .card-title {
    padding: 10px; /* Atur sesuai kebutuhan */
    font-size: 1.5rem; /* Atur ukuran font */
}

      .nav-item .nav-link.text-end {
    padding-right: 20px; /* Mengatur jarak ke kanan */
}

        /* Menghilangkan background pada navbar atau elemen lain */
        .navbar, .card, .breadcrumb, .content-header {
            background-color: transparent !important;
        }

        /* Jika ingin menghilangkan padding pada header */
        .card-header {
            padding: 0;
        }
        /* Mengubah kursor menjadi tanda silang (not-allowed) saat tombol navigasi tidak aktif */
    .dataTables_paginate .paginate_button.disabled {
        cursor: not-allowed !important;
    }
    </style>
    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Header -->
        @include('admin.partials.header')

        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <main class="app-main">
            <!-- Content Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    @yield('content-header')
                </div>
            </div>

            <!-- App Content -->
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('admin.partials.footer')
    </div>

    <!-- Script to listen to the real-time event -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
  // Enable Pusher logging - jangan aktifkan di production
  Pusher.logToConsole = true;

  var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
      cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
      encrypted: true
  });

  var channel = pusher.subscribe('orders');
  channel.bind('new-order', function(data) {
      // Update notifikasi
      let notificationCount = parseInt(document.getElementById('notification-count').textContent) + 1;
      document.getElementById('notification-count').textContent = notificationCount;
      document.getElementById('notification-header').textContent = notificationCount + " Notifications";

      // Tambahkan notifikasi ke dropdown
      let notificationList = document.getElementById('notification-list');
      let newNotification = document.createElement('a');
      newNotification.href = "/order/" + data.order.id;
      newNotification.className = 'dropdown-item';
      newNotification.innerHTML = `<i class="bi bi-bell me-2"></i> Pesanan baru dari ${data.order.customer_name}`;
      notificationList.prepend(newNotification);
  });
</script>
<!-- Tambahkan JS dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Toggle menu saat tombol hamburger diklik
        $('.navbar-toggler').click(function() {
            $('.collapse').toggleClass('show'); // Tampilkan atau sembunyikan menu
        });
    });
</script>
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @stack('scripts')
</body>
</html>
