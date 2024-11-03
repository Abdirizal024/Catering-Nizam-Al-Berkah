@extends('admin.layouts.main')

@section('title', 'From Tambah Admin | Catering Nizam')

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
                <div class="card-title">Form Tambah Admin</div>
            </div> <!--end::Header-->

            <!--begin::Form-->
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Begin::Body -->
                <div class="card-body">
                    <!-- Nama Admin -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Admin</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Admin" required>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                    </div>

                    <!-- Upload Gambar Profil -->
                    <div class="input-group mb-3">
                        <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                        <label class="input-group-text" for="profile_picture">Upload Gambar Profil</label>
                    </div>
                </div>
                <!-- End::Body -->

                <!-- Begin::Footer -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <!-- End::Footer -->
            </form>
            <!--end::Form-->
        </div> <!--end::Quick Example-->
    </div> <!--end::Col-->
</div> <!--end::d-flex-->
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
