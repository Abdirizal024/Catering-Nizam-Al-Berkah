@extends('admin.layouts.main')

@section('title', 'Kontak Pesanan | Catering Nizam')

@push('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endpush

@section('content-header')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Kontak</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="/admin">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kontak
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="col-md-6"> <!--begin::Edit No Whatsapp-->
  <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
      <div class="card-header d-flex justify-content-between align-items-center">
          <div class="card-title" style="flex-grow: 1; text-align: left;">Edit No Whatsapp</div>
      </div> <!--end::Header--> <!--begin::Form-->
      <form action="{{ route('update.kontak', $kontak->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <!-- Begin::Body -->
          <div class="card-body">
                            <!-- Kontak -->
              <div class="mb-3">
                  <label for="price" class="form-label">No Whatsapp</label>
                  <input type="number" name="kontak" class="form-control" id="kontak" placeholder="Masukkan Nomor Wa" value="{{ $kontak->kontak }}" required>
              </div>
              <small class="text-slate-400">Contoh: 6212345678</small>
          </div>
          <!-- End::Body -->

          <!-- Begin::Footer -->
          <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          <!-- End::Footer -->
      </form>
  </div> <!--end::Quick Example-->
</div> <!--end::Col-->

@endsection




@push('scripts')

@endpush
