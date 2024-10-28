<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Catering Nizam <span>Al Berkah</span></a>
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="oi oi-menu icon-menu"></span> Menu Catering
</button>


        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('dashboard') }}" class="nav-link">Beranda</a></li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}" class="nav-link">Tentang Kami</a></li>
                <li class="nav-item {{ Request::is('menu') ? 'active' : '' }}"><a href="{{ route('menu') }}" class="nav-link">Menu</a></li>
                <li class="nav-item {{ Request::is('testimoni.create') ? 'active' : '' }}"><a href="{{ route('testimoni.create') }}" class="nav-link">Testimoni</a></li>
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}" class="nav-link">Kontak</a></li>
                <li class="nav-item {{ Request::is('login') ? 'active' : '' }}"><a href="{{ route('login') }}" class="nav-link">Login Admin</a></li>
                <!-- Ikon pencarian -->
    {{-- <li class="nav-item">
        <a href="#" class="nav-link" id="search-icon">
            <span class="fa fa-search"></span>
        </a>
    </li> --}}

            </ul>
        </div>
    </div>
</nav>
