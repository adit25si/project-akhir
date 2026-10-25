
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

        {{-- Partial View Navbar --}}
        @include('admin.partials.navbar')

        <main class="container tm-mt-big tm-mb-big">
            <div class="row tm-content-row">
                <section class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">

                        {{-- Pesan Success --}}
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Pesan Error --}}
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Pesan Validasi --}}
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

                        {{-- Isi Halaman --}}
                        @yield('content')

                    </div>
                </section>
            </div>

            {{-- Footer --}}
            <footer class="tm-footer text-center mt-4">
                <p class="text-white">Adit Chocolate</p>
            </footer>
        </main>
    </div>

    {{-- JavaScript --}}
    <script src="{{ asset('admin/jquery-ui-datepicker/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/jquery-ui-datepicker/js/bootstrap.min.js') }}"></script>
</body>
</html>
