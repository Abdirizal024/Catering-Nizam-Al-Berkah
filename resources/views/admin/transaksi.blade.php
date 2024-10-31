@extends('admin.layouts.main')

@section('title', 'Beranda Admin | Catering Nizam')

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
      .dataTables_wrapper .dataTables_length {
    margin-bottom: 15px; /* Menambahkan jarak di bawah Length Menu */
}
      .dataTables_wrapper .dt-buttons {
    margin-bottom: 15px; /* Menambahkan jarak di bawah tombol */
}
  </style>
@endpush

@section('content-header')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Transaksi/Pesanan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="/admin">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Transaksi
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
      <h3 class="card-title pt-1">TRANSAKSI CATERING NIZAM AL-BERKAH</h3>
  </div>
  <div class="col-md-12 mt-3">
</div>
  <div class="card-body">

        <!-- Tabel Transaksi -->
        @if($orders->isEmpty())
            <p class="text-center">Tidak ada transaksi tersedia.</p>
        @else
        <div class="table-responsive">
          <table id="transaksi-table" class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Nama Customer</th>
                      <th>No WhatsApp</th>
                      <th>Nama Menu</th>
                      <th>Jumlah</th>
                      <th>Total Harga</th>
                      <th>Status</th>
                      <th>Tanggal Transaksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $order)
                  <tr>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->customer_name }}</td>
                      <td>{{ $order->customer_phone }}</td>
                      <td>{{ $order->menu->nama }}</td>
                      <td>{{ $order->quantity }}</td>
                      <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                      <td>
                          @if ($order->status == 'paid')
                          <span class="badge badge-success">Sudah Bayar</span>
                          @elseif ($order->status == 'expired')
                          <span class="badge badge-danger">Expired</span>
                          @else
                          <span class="badge badge-warning">{{ ucfirst($order->status) }}</span>
                          @endif
                      </td>
                      <td>{{ date('d M Y, H:i', strtotime($order->created_at)) }}</td>
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
    $('#transaksi-table').DataTable({
      paging: true,
      info: true,
      autoWidth: false,
      responsive: true,
      dom: 'Blfrtip', // Mengaktifkan tombol
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
            {
                extend: 'colvis', // Tombol untuk mengatur visibilitas kolom
                text: 'Opsi Kolom',
                postfixButtons: ['colvisRestore'] // Menambahkan tombol untuk mengembalikan default visibilitas kolom
            }
        ],

        lengthMenu: [ [15, 25, 30, 50, -1], [15, 25, 30, 50, "All"] ],
        pageLength: 5, // Mengatur jumlah data per halaman default
        language: {
            "lengthMenu": "Tampilkan _MENU_ Entri Perhalaman",
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
@endpush
