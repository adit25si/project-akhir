
<nav class="navbar navbar-expand-xl">
    <div class="container h-100">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('guest/css/images/Chocolate Cute Beverage Store Logo.png') }}"
                 alt="Logo Adit Chocolate" width="42" height="42" class="mr-2">
            <h1 class="tm-site-title mb-0">Adit Chocolate</h1>
        </a>

        <button class="navbar-toggler ml-auto mr-0" type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Buka navigasi">
            <i class="fas fa-bars tm-nav-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}"
                       href="{{ route('pelanggan.index') }}">
                        <i class="far fa-user"></i> Pelanggan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}"
                       href="{{ route('produk.index') }}">
                        <i class="fas fa-shopping-cart"></i> Produk
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                       href="{{ route('kategori.index') }}">
                        <i class="far fa-list-alt"></i> Kategori
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-block" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Lihat Situs
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
