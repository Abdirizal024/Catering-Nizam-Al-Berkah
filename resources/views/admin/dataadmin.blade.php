@extends('admin.layouts.main')

@section('title', 'Beranda Admin | Catering Nizam')

@push('styles')
    <!-- Tambahkan CSS tambahan jika diperlukan -->
@endpush

@section('content-header')
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
@endsection

@section('content')
    <div class="row">
        <!-- Contoh Small Box -->
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <!-- SVG Path -->
                </svg>
                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- Tambahkan Small Boxes lainnya di sini -->
    </div>

    <!-- Tambahkan konten lain seperti Chart, Chat, dll. di sini -->
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
