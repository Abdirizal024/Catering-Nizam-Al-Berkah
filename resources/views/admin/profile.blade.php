@extends('admin.layouts.main')

@section('title', 'Profile Admin | Catering Nizam Al-Berkah')

@push('styles')
    <style>
        /* Styling untuk profil card */
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .card-body {
            padding: 20px;
        }

        .profile-username {
            font-weight: 600;
            font-size: 1.2em;
        }

        .text-center {
            text-align: center;
        }

        /* Styling untuk gambar profil */
        .profile-user-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Mengatur tampilan keseluruhan list-group-item */
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            font-size: 16px;
            border: 1rem;
            /* Menghilangkan garis pembatas antar item */
        }


        /* Mengatur nilai di sebelah kanan */
        .list-group-item a {
            font-weight: 400;
            color: #555;
            text-decoration: none;
            margin-bottom: 1rem !important;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        /* Tambahan styling untuk username */
        .profile-username {
            font-size: 22px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
        }

        /* Styling untuk gambar profil */
        .profile-img-small {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Styling untuk shadow kecil pada gambar */
        .shadow-sm {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .list-group-item.border-bottom {
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            /* Ganti warna sesuai kebutuhan */
        }
    </style>
@endpush

@section('content-header')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Profile</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Profile
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <!-- Kartu Profil -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <!-- Gambar Profil -->
                            <div class="text-center my-3">
                                <img class="profile-user-img img-fluid img-circle profile-img-small shadow-sm mx-auto d-block"
                                    src="{{ asset($currentAdmin->profile_picture ? $currentAdmin->profile_picture : 'images/default-admin2.png') }}"
                                    alt="User profile picture">
                            </div>


                            <!-- Informasi Admin -->
                            <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}
                            </h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item border-bottom">
                                    <b>Username</b> <a
                                        class="float-right">{{ Auth::guard('admin')->user()->username ?? 'Admin' }}</a>
                                </li>
                                <li class="list-group-item border-bottom">
                                    <b>Email</b> <a
                                        class="float-right">{{ Auth::guard('admin')->user()->email ?? 'admin123@gmail.com' }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xs-12 mt-3 mt-md-0"> <!-- Tambahkan margin atas untuk perangkat mobile -->
                    <div class="card card-outline card-success">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <!-- Tautan Tab Data Diri -->
                                <li class="nav-item">
                                    <a class="nav-link active" href="#datadiri" data-bs-toggle="tab">Data Diri</a>
                                </li>
                                <!-- Tautan Tab Kata Sandi -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#sandi" data-bs-toggle="tab">Kata Sandi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Tab Data Diri -->
                                <div class="tab-pane fade show active" id="datadiri">
                                    <form class="form-horizontal" action="{{ route('profile.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', auth()->user()->name) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email', auth()->user()->email) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username"
                                                    value="{{ old('username', auth()->user()->username) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 col-form-label">Gambar Profil</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control-file" name="profile_picture">
                                                @if (auth()->user()->profile_picture)
                                                    <br>
                                                    <img src="{{ asset($currentAdmin->profile_picture ? $currentAdmin->profile_picture : 'images/default-admin2.png') }}"
                                                        alt="Profile Picture" class="img-thumbnail mt-2"
                                                        style="width: 100px;">
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12 text-center">
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-success">Perbaharui</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Tab Kata Sandi -->
                                <div class="tab-pane fade" id="sandi">
                                    <form class="form-horizontal" action="{{ route('password.update') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 col-form-label">Kata Sandi Lama</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="slama" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 col-form-label">Sandi Baru</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="sbaru" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 col-form-label">Konfirmasi Sandi Baru</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="sbaru_confirmation"
                                                    required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-sm btn-outline-success">Ubah Kata
                                                Sandi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                }
            ],
            chart: {
                height: 300,
                type: "area",
                toolbar: {
                    show: false
                },
            },
            legend: {
                show: false
            },
            colors: ["#0d6efd", "#20c997"],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            },
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
            tooltip: {
                x: {
                    format: "MMMM yyyy"
                }
            },
        };

        const sales_chart = new ApexCharts(document.querySelector("#revenue-chart"), sales_chart_options);
        sales_chart.render();
    </script>
@endpush
