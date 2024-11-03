@extends('admin.layouts.main')

@section('title', 'Beranda Admin | Catering Nizam')

@push('styles')
    <!-- Tambahkan CSS tambahan jika diperlukan -->
@endpush


@section('content-header')
@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Beranda</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Beranda
                </li>
            </ol>
        </div>
    </div>

<!-- Statistik Jumlah Menu, Pesanan, Admin -->
<div class="row mt-4">
    <!-- Jumlah Menu -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info d-flex flex-column justify-content-between h-100">
            <div class="d-flex align-items-center justify-content-between p-3">
                <div>
                    <h3>{{ $menuCount }}</h3> <!-- Jumlah Menu -->
                    <p>Jumlah Menu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-utensils" style="font-size: 4rem;"></i> <!-- Ikon untuk Menu -->
                </div>
            </div>
            <a href="{{ route('admin.menu') }}" class="small-box-footer d-block text-center p-2" style="background-color: rgba(0,0,0,0.1); color: white;">
                Lihat Menu <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Jumlah Pesanan -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success d-flex flex-column justify-content-between h-100">
            <div class="d-flex align-items-center justify-content-between p-3">
                <div>
                    <h3>{{ $orderCount }}</h3> <!-- Jumlah Pesanan -->
                    <p>Jumlah Pesanan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart" style="font-size: 4rem;"></i> <!-- Ikon untuk Pesanan -->
                </div>
            </div>
            <a href="{{ route('transaksi') }}" class="small-box-footer d-block text-center p-2" style="background-color: rgba(0,0,0,0.1); color: white;">
                Lihat Pesanan <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Jumlah Admin -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning d-flex flex-column justify-content-between h-100">
            <div class="d-flex align-items-center justify-content-between p-3">
                <div>
                    <h3>{{ $adminCount }}</h3> <!-- Jumlah Admin -->
                    <p>Jumlah Admin</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-shield" style="font-size: 4rem;"></i> <!-- Ikon untuk Admin -->
                </div>
            </div>
            <a href="{{ route('data.admin') }}" class="small-box-footer d-block text-center p-2" style="background-color: rgba(0,0,0,0.1); color: white;">
                Lihat Admin <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

@endsection



@push('scripts')
    <!-- Tambahkan JavaScript tambahan jika diperlukan -->
    <!-- Contoh ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
    <script>
        const sales_chart_options = {
            series: [{
                name: "Digital Goods",
                data: [28, 48, 40, 19, 86, 27, 90],
            },
            {
                name: "Electronics",
                data: [65, 59, 80, 81, 56, 55, 40],
            }],
            chart: {
                height: 300,
                type: "area",
                toolbar: { show: false },
            },
            legend: { show: false },
            colors: ["#0d6efd", "#20c997"],
            dataLabels: { enabled: false },
            stroke: { curve: "smooth" },
            xaxis: {
                type: "datetime",
                categories: [
                    "2023-01-01",
                    "2023-02-01",
                    "2023-03-01",
                    "2023-04-01",
                    "2023-05-01",
                    "2023-06-01",
                    "2023-07-01",
                ],
            },
            tooltip: { x: { format: "MMMM yyyy" } },
        };

        const sales_chart = new ApexCharts(document.querySelector("#revenue-chart"), sales_chart_options);
        sales_chart.render();
    </script>
@endpush
