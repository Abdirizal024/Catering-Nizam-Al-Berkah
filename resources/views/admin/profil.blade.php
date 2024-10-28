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
  <div class="col-md-3">
              <!-- Begin::Card Profile -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
    
                    <!-- Gambar Profil -->
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            
                             alt="User profile picture">
                    </div>
    
                    <h3 class="profile-username text-center">{{ optional($user)->name }}</h3>
<p class="text-muted text-center">{{ optional($user)->role }}</p>

                    
                </div>
            </div>
            <!-- End::Card Profile -->

      {{-- <!-- Card About Me -->
      <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title">About Me</h3>
          </div>
          <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Education</strong>
              <p class="text-muted">{{ $admin->education }}</p>
              <hr>
              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
              <p class="text-muted">{{ $admin->location }}</p>
              <hr>
              <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
              <p class="text-muted">
                  @foreach(explode(',', $admin->skills) as $skill)
                      <span class="tag tag-info">{{ $skill }}</span>
                  @endforeach
              </p>
              <hr>
              <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
              <p class="text-muted">{{ $admin->notes }}</p>
          </div>
      </div>
  </div> --}}

  <!-- Bagian Kanan untuk Activity, Timeline, Settings -->
  <div class="col-md-9">
      <div class="card">
          <div class="card-header p-2">
              <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
              </ul>
          </div>
          <div class="card-body">
              <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                      <!-- Aktivitas dan Postingan Admin -->
                  </div>

                  <div class="tab-pane" id="timeline">
                      <!-- Timeline Admin -->
                  </div>

                  <div class="tab-pane" id="settings">
                      <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')

                          <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                  <input type="text" name="name" class="form-control" id="inputName" value="{{ $user->username }}" required>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="email" name="email" class="form-control" id="inputEmail" value="" required>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="inputLocation" class="col-sm-2 col-form-label">Location</label>
                              <div class="col-sm-10">
                                  <input type="text" name="location" class="form-control" id="inputLocation" value="">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                              <div class="col-sm-10">
                                  <input type="text" name="skills" class="form-control" id="inputSkills" value="">
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger">Update Profile</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
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
