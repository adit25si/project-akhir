@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h2 class="tm-block-title mb-2">{{ $title }}</h2>
            <p class="text-white mb-0">Manajemen data {{ $resource }} Adit Chocolate.</p>
        </div>
        <a class="btn btn-primary mt-3 mt-md-0" href="{{ route($resource . '.create') }}">
            <i class="fas fa-plus mr-2"></i>Tambah {{ ucfirst($resource) }}
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover tm-table-small text-white">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    @foreach ($columns as $column)
                        <th scope="col">{{ $column['label'] }}</th>
                    @endforeach
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @foreach ($columns as $column)
                            @php($value = data_get($item, $column['name']))
                            <td>
                                @if (($column['type'] ?? null) === 'currency' && $value !== null)
                                    Rp {{ number_format((float) $value, 0, ',', '.') }}
                                @else
                                    {{ filled($value) ? $value : '-' }}
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-primary btn-small mr-2"
                                   href="{{ route($resource . '.edit', $item->id) }}">Edit</a>
                                <form action="{{ route($resource . '.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-small" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 2 }}" class="text-center py-4">
                            Belum ada data. Silakan tambah data baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
