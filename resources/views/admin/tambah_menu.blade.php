@extends('admin.layouts.main')

@section('title', 'From Tambah Menu | Catering Nizam')

@push('styles')
    <!-- DataTables Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">

    @endpush

@section('content-header')

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;"> 
<div class="col-md-6"> <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">From Tambah Menu</div>
        </div> <!--end::Header--> <!--begin::Form-->
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <!-- Begin::Body -->
          <div class="card-body">
              <!-- Nama Menu -->
              <div class="mb-3">
                  <label for="name" class="form-label">Nama Menu</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Menu" required>
              </div>

              <!-- Rincian Menu -->
              <div class="mb-3">
                  <label for="deskripsi" class="form-label">Rincian Menu</label>
                  <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Rincian Menu" required></textarea>
              </div>

              <!-- Harga -->
              <div class="mb-3">
                  <label for="price" class="form-label">Harga</label>
                  <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga" required>
              </div>

              <!-- Upload Gambar -->
              <div class="input-group mb-3">
                  <input type="file" name="gambar" class="form-control" id="gambar">
                  <label class="input-group-text" for="gambar">Upload Gambar</label>
              </div>
          </div>
          <!-- End::Body -->

          <!-- Begin::Footer -->
          <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          <!-- End::Footer -->
      </form>

    </div> <!--end::Quick Example--> <!--begin::Input Group-->
</div> <!--end::Col--> <!--begin::Col-->
@endsection





@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables Bootstrap 4 JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#catering').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#catering_wrapper .col-md-6:eq(0)');
        });
    </script>
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
