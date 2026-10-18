<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Adit Chocolate</title>
    <link rel="stylesheet" href="{{ asset('admin/jquery-ui-datepicker/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/jquery-ui-datepicker/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/jquery-ui-datepicker/css/templatemo-style.css') }}">
</head>
<body id="reportsPage">
    <div id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('guest/css/images/Chocolate Cute Beverage Store Logo.png') }}"
                         alt="" width="42" height="42" class="mr-2">
                    <h1 class="tm-site-title mb-0">Adit Chocolate</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Buka navigasi">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}"
                               href="{{ route('pelanggan.index') }}">
                                <i class="far fa-user"></i>Pelanggan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}"
                               href="{{ route('produk.index') }}">
                                <i class="fas fa-shopping-cart"></i>Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                               href="{{ route('kategori.index') }}">
                                <i class="far fa-list-alt"></i>Kategori
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>Lihat Situs
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container tm-mt-big tm-mb-big">
            <div class="row tm-content-row">
                <section class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Periksa kembali data yang diisi.</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </section>
            </div>
            <footer class="tm-footer text-center mt-4">
                <p class="text-white">Adit Chocolate</p>
            </footer>
        </main>
    </div>

    <script src="{{ asset('admin/jquery-ui-datepicker/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/jquery-ui-datepicker/js/bootstrap.min.js') }}"></script>
</body>
</html>
