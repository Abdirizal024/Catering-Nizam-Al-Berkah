@extends('admin.layouts.main')

@section('title', 'From Edit Admin | Catering Nizam')

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
                <div class="card-title">Form Edit Admin</div>
            </div> <!--end::Header--> 

            <!--begin::Form-->
            <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Begin::Body -->
                <div class="card-body">
                    <!-- Nama Admin -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Admin</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Admin" value="{{ old('name', $admin->name) }}" required>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" value="{{ old('username', $admin->username) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" value="{{ old('email', $admin->email) }}" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password">
                    </div>

                    <!-- Upload Gambar Profil -->
                    <div class="input-group mb-3">
                        <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                        <label class="input-group-text" for="profile_picture">Upload Gambar Profil (Opsional)</label>
                    </div>
                    
                     <!-- Menampilkan Gambar Profil Saat Ini atau Gambar Default -->
        <div class="mb-3">
          <label class="form-label">Gambar Profil Saat Ini :</label>
          <div>
              <img 
                  src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('images/default-profile.png') }}" 
                  alt="Gambar Profil Admin" 
                  style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
              >
          </div>
          <small class="form-text text-muted">Jika tidak diunggah, gambar default akan digunakan.</small>
                </div>
                <!-- End::Body -->

                <!-- Begin::Footer -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
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
