@extends('admin.layouts.main')

@section('title', 'Halaman Daftar Menu | Catering Nizam')

@push('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Bootstrap 4 CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-flash.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <style>
      table thead th { text-align: center }
      table tbody tr { text-align: center }
  </style>
@endpush

@section('content-header')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Daftar Menu</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="/admin">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Menu Catering
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
<div class="col-12">
<div class="card card-outline card-primary">
  <div class="card-header">
      <h3 class="card-title pt-1">PAKET CATERING NIZAM AL-BERKAH</h3>
  </div>
  <div class="col-md-12 mt-3 text-end">
    <!-- Tombol Tambah Menu -->
    <a href="{{ route('tambah.menu') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Menu
    </a>
</div>
  <div class="card-body">

        <!-- Tabel Menu -->
        @if($menus->isEmpty())
            <p class="text-center">Tidak ada menu tersedia.</p>
        @else
            <table id="tabelMenu" class="table table-bordered table-hover dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Rincian Menu</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $menu->nama }}</td>
                            <td>{{ $menu->deskripsi }}</td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td>
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="gambar" width="50">
                                @else
                                    Tidak Ada Gambar
                                @endif
                            </td>
                            <td>
                              <!-- Tombol Edit -->
                              <a href="{{ route('edit.menu', $menu->id) }}" class="btn btn-warning">
                                  <i class="fas fa-edit"></i> <!-- Icon Edit -->
                                  Edit
                              </a>

                              <!-- Tombol Hapus -->
                              <form action="{{ route('hapus.menu', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">
                                      <i class="fas fa-trash-alt"></i> <!-- Icon Hapus -->
                                      Hapus
                                  </button>
                              </form>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
  </div>
</div>
</div>
</div>
@endsection




@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- Bootstrap 4 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

<!-- File untuk export CSV dan PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <script>
      $(document).ready(function() {
    $('#tabelMenu').DataTable({
      dom: 'Bfrtip', // Mengaktifkan tombol
      responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
            {
                extend: 'colvis', // Tombol untuk mengatur visibilitas kolom
                text: 'Opsi Kolom',
                postfixButtons: ['colvisRestore'] // Menambahkan tombol untuk mengembalikan default visibilitas kolom
            }
        ],
        lengthMenu: [5, 10, 25, 50, 100], // Pilihan jumlah entri

        language: {
            "lengthMenu": "Tampilkan _MENU_ entri per halaman",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "info": "Menampilkan _PAGE_ dari _PAGES_ halaman",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(difilter dari _MAX_ total entri)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            },
            "buttons": {
                "copy": "Salin",
                "print": "Cetak",
                "colvis": "Visibilitas Kolom" // Teks tombol untuk visibilitas kolom
            }
        }
    });
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
