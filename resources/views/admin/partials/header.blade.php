<!-- Navbar -->
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!-- Start navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>
    <!-- End navbar links -->

    <ul class="navbar-nav ms-auto">
<!-- Notifications Dropdown Menu -->
<li class="nav-item dropdown">
  <a class="nav-link" data-bs-toggle="dropdown" href="#">
      <i class="bi bi-bell-fill"></i>
      <span id="notification-count" class="navbar-badge badge text-bg-warning">0</span>
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
      <span class="dropdown-item dropdown-header" id="notification-header">0 Notifications</span>
      <div class="dropdown-divider"></div>
      <div id="notification-list"></div>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">
          See All Notifications
      </a>
  </div>
</li>



<!-- Tampilkan Username dan Profile Picture Admin -->
<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
       <img src="{{ asset($currentAdmin->profile_picture ? $currentAdmin->profile_picture : 'images/default-admin2.png') }}"
     class="user-image rounded-circle" alt="User Image"/>
        <span class="d-none d-md-inline">{{ $currentAdmin->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <!-- User image -->
        <li class="user-header text-bg-primary">
           <img src="{{ asset($currentAdmin->profile_picture ? $currentAdmin->profile_picture : 'images/default-admin2.png') }}"
     class="user-image rounded-circle shadow" alt="User Image"/>
            <p>
                {{ $currentAdmin->username }} - Administrasi
                <small>
                  Member since
                  {{ \Carbon\Carbon::parse($currentAdmin->last_login_at)->format('d M Y, H:i') }}
              </small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <!-- Tombol Profile dan Logout dengan Border -->
<a href="{{ route('profile') }}" class="btn btn-outline-secondary btn-flat border">
  <i class="fas fa-user"></i> Profil
</a>
<a href="{{ route('logout') }}" class="btn btn-outline-secondary btn-flat border float-end"
 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  <i class="fa fa-fw fa-power-off"></i> Keluar
</a>
      </li>

      <!-- Form Logout -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>

    </ul>
</li>

    </ul>
  </div>
  <!--end::Container-->
</nav>
<!-- /.navbar -->
