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
        <h3 class="mb-0">Data Admin</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="/admin">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
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
                        <h3 class="card-title pt-1">DAFTAR ADMIN CATERING NIZAM AL-BERKAH</h3>
                    </div>
                    <div class="card-body">
                        <!-- Tabel Admin -->
                        @if($admins->isEmpty())
                            <p class="text-center">Tidak ada admin tersedia.</p>
                        @else
                        <div class="col-md-12 mt-3 text-end">
                          <!-- Tombol Tambah Menu -->
                          <a href="{{ route('admin.tambah') }}" class="btn btn-primary">
                              <i class="fas fa-plus"></i> Tambah Admin
                          </a>
                      </div>
                                            @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      @if (session('error'))
                          <div class="alert alert-danger">
                              {{ session('error') }}
                          </div>
                      @endif

                            <div class="table-responsive">
                                <table id="admin-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Gambar Profil</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->username }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                              <img 
                                              src="{{ asset($admin->profile_picture ? $admin->profile_picture : 'images/default-admin2.png') }}" 
                                              alt="Profile Picture" 
                                              class="img-thumbnail" 
                                              style="width: 50px;"
                                          >
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
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
    $('#admin-table').DataTable({
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
@endpush
