@extends('admin.layouts.app')

@section('title', ($item ? 'Edit ' : 'Tambah ') . $title)

@section('content')
    <h2 class="tm-block-title">{{ $item ? 'Edit' : 'Tambah' }} {{ $title }}</h2>

    <form action="{{ $item ? route($resource . '.update', $item->id) : route($resource . '.store') }}"
          method="POST">
        @csrf
        @if ($item)
            @method('PUT')
        @endif

        @foreach ($fields as $field)
            <div class="form-group">
                <label for="{{ $field['name'] }}" class="text-white">{{ $field['label'] }}</label>
                @if ($field['type'] === 'textarea')
                    <textarea class="form-control @error($field['name']) is-invalid @enderror"
                              id="{{ $field['name'] }}" name="{{ $field['name'] }}" rows="4"
                              @required($field['required'] ?? false)>{{ old($field['name'], $item ? data_get($item, $field['name']) : '') }}</textarea>
                @else
                    <input class="form-control @error($field['name']) is-invalid @enderror"
                           id="{{ $field['name'] }}" type="{{ $field['type'] }}"
                           name="{{ $field['name'] }}"
                           value="{{ old($field['name'], $item ? data_get($item, $field['name']) : '') }}"
                           @if (isset($field['step'])) step="{{ $field['step'] }}" @endif
                           @if (isset($field['min'])) min="{{ $field['min'] }}" @endif
                           @required($field['required'] ?? false)>
                @endif
                @error($field['name'])
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <button class="btn btn-primary" type="submit">
            {{ $item ? 'Simpan Perubahan' : 'Simpan' }}
        </button>
        <a class="btn btn-secondary ml-2" href="{{ route($resource . '.index') }}">Kembali</a>
    </form>
@endsection
