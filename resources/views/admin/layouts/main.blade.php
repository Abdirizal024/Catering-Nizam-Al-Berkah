<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Catering Nizam Al Berkah')</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-flash.min.css">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">

    @notifyCss
    <!-- Tambahkan Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tambahkan pustaka Pusher -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!-- Tambahkan pustaka Moment.js dengan dukungan lokal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js"></script>



    <script>
        // Setel Moment.js ke Bahasa Indonesia
        moment.locale('id');

        // Konfigurasi Pusher
        Pusher.logToConsole = true;

        var pusher = new Pusher('6ef09698a200a2787a3f', {
            cluster: 'ap1',
            encrypted: true
        });

        // Subscribe ke channel 'orders'
        var channel = pusher.subscribe('orders');

        // Fungsi pembaruan badge
        function updateBadgeCount(count) {
            $('#notification-badge').text(count);
        }

        // Inisialisasi jumlah notifikasi
        let notificationCount = 0;

        // Bind event 'new-order' untuk menerima data notifikasi
        channel.bind('new-order', function(data) {
            notificationCount++;

            // Perbarui badge count
            updateBadgeCount(notificationCount);

            // Cek jika ada teks 'Tidak ada notifikasi baru' dan hapus jika ada
            if ($('#notification-list').find('p').length) {
                $('#notification-list').empty();
            }

            // Buat data notifikasi baru dengan waktu saat ini
            let notificationData = {
                id: 'notif_' + new Date().getTime(), // ID unik untuk setiap notifikasi
                content: `
            <a href="" class="dropdown-item notification-item" data-timestamp="${moment().toISOString()}">
                <i class="bi bi-person-fill me-2"></i>
                Pesanan baru dari <strong>${data.order.customer_name}</strong>
                <div class="total-price">Total: Rp ${data.order.total_price}</div> <!-- Total Harga -->
                <div class="time-relative">${moment().fromNow()}</div> <!-- Waktu Relatif dalam Bahasa Indonesia -->
            </a>
        `
            };

            // Simpan notifikasi secara lokal
            localStorage.setItem(notificationData.id, JSON.stringify(notificationData));

            // Tambahkan notifikasi baru ke daftar
            $("#notification-list").prepend(notificationData.content);
        });

        // Menangani klik pada item notifikasi
        $(document).on('click', '.notification-item', function(event) {
            event.preventDefault();

            // Arahkan ke halaman yang dituju
            window.location.href = $(this).attr('href');

            // Hapus notifikasi yang diklik dari daftar dropdown
            $(this).next('.dropdown-divider').remove(); // Hapus divider setelah item
            $(this).remove(); // Hapus item notifikasi itu sendiri

            // Kurangi jumlah notifikasi dan perbarui badge
            notificationCount = Math.max(0, notificationCount - 1);
            updateBadgeCount(notificationCount);
        });
    </script>




    <style>
        /* Agar teks "Pesanan baru dari" dan nama pelanggan dalam satu baris */
        .notification-item-content {
            display: flex;
            align-items: center;
        }

        .notification-item-content strong {
            margin-left: 5px;
            white-space: nowrap;
        }

        /* Total harga dan waktu di bawah nama pelanggan */
        .notification-item .total-price,
        .notification-item .time-relative {
            font-size: 0.85em;
            color: #6c757d;
        }

        /* Margin atas untuk memisahkan harga dan waktu dari teks utama */
        .total-price {
            margin-top: 5px;
        }

        /* Tambahkan garis bawah hanya untuk header dan garis atas hanya untuk footer */
        .dropdown-header {
            border-bottom: 1px solid #dee2e6;
        }

        .dropdown-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Ketika notifikasi diklik, hilangkan teks tebal */
        .notification-item.read {
            font-weight: normal;
        }

        /* Menata jika tidak ada notifikasi baru */
        #notification-list p {
            text-align: center;
            color: #777;
            font-size: 14px;
        }

        .card-header .card-title {
            padding: 10px;
            /* Atur sesuai kebutuhan */
            font-size: 1.5rem;
            /* Atur ukuran font */
        }

        .nav-item .nav-link.text-end {
            padding-right: 20px;
            /* Mengatur jarak ke kanan */
        }

        /* Menghilangkan background pada navbar atau elemen lain */
        .navbar,
        .card,
        .breadcrumb,
        .content-header {
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


    <x-notify::notify />
    @notifyJs
    <!-- Tambahkan Toastr JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Tambahkan JS dan jQuery -->
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
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @stack('scripts')
</body>

</html>
