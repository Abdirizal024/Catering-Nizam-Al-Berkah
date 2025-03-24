<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!-- Sidebar Brand -->
  <div class="sidebar-brand">
      <a href="{{ route('admin') }}" class="brand-link">
          <img src="{{ asset('images/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
          <span class="brand-text fw-light">Catering NAB</span>
      </a>
  </div>
<!-- Sidebar Menu -->
<div class="sidebar-wrapper">
  <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
          <!-- Menu Items -->
            <!-- Beranda -->
          <li class="nav-item">
              <a href="{{ route('admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i> <!-- Beranda: ikon rumah -->
                  <p>
                      Beranda
                  </p>
              </a>
          </li>
          <!-- Contoh Menu Item -->
          <li class="nav-header">MENU UTAMA</li>

          <!-- Menu Catering -->
          <li class="nav-item">
              <a href="{{ route('admin.menu') }}" class="nav-link {{ request()->is('admin/menu') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-box"></i> <!-- Menu Catering: ikon kotak -->
                  <p>
                      Menu Catering
                  </p>
              </a>
          </li>

          <!-- Transaksi/Pesanan -->
          <li class="nav-item">
              <a href="{{ route('transaksi') }}" class="nav-link {{ request()->is('admin/transaksi') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-file-invoice"></i> <!-- Transaksi/Pesanan: ikon orang -->
                  <p>
                      Transaksi/Pesanan
                  </p>
              </a>
          </li>

          {{-- <!-- Kontak -->
          <li class="nav-item">
              <a href="{{ route('kontak') }}" class="nav-link {{ request()->is('admin/kontak') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-envelope"></i> <!-- Kontak: ikon amplop -->
                  <p>
                      Kontak
                  </p>
              </a>
          </li> --}}

          <!-- Data Admin -->
          <li class="nav-item">
              <a href="{{ route('data.admin') }}" class="nav-link {{ request()->is('admin/admin') ? 'active' : '' }}">
                  <i class="nav-icon fa-solid fa-user-tie"></i> <!-- Data Admin: ikon orang -->
                  <p>
                      Data Admin
                  </p>
              </a>
          </li>

          <li class="nav-header">PENGATURAN</li>

          <!-- Pengaturan Akun -->
          <li class="nav-item">
              <a href="{{ route('profile') }}" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-person-circle"></i> <!-- Pengaturan Akun: ikon akun -->
                  <p>
                      Pengaturan Akun
                  </p>
              </a>
          </li>

         <!-- Logout -->
         <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="nav-link text-end"> <!-- Tambahkan text-end untuk menggeser ke kanan -->
                  <i class="nav-icon fas fa-sign-out-alt"></i> <!-- Logout: Font Awesome icon for sign out -->
                  <p>Keluar</p>
              </button>
          </form>
      </li>
      </ul>
  </nav>
</div>

</aside>
