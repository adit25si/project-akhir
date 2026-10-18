@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h2 class="tm-block-title mb-2">Dashboard</h2>
            <p class="text-white mb-0">Kelola data master Adit Chocolate dari satu tempat.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <a class="btn btn-primary btn-block h-100" href="{{ route('pelanggan.index') }}">
                Kelola Data Pelanggan
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a class="btn btn-primary btn-block h-100" href="{{ route('produk.index') }}">
                Kelola Data Produk
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a class="btn btn-primary btn-block h-100" href="{{ route('kategori.index') }}">
                Kelola Data Kategori
            </a>
        </div>
    </div>
@endsection
