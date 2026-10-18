
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - Adit Chocolate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f8f5f2;
        }
        h1 { color: #5b3025; }
        .tambah, .edit, .hapus {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .tambah { background: #5b3025; color: white; }
        .edit { background: #e7b65c; color: black; }
        .hapus { background: #c0392b; color: white; }
        .alert { background: #d4edda; padding: 12px; margin: 15px 0; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
        }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #5b3025; color: white; }
    </style>
</head>
<body>
    <h1>Data Pelanggan Adit Chocolate</h1>

    <a class="tambah" href="{{ route('pelanggan.create') }}">
        + Tambah Pelanggan
    </a>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelanggan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <a class="edit"
                           href="{{ route('pelanggan.edit', $item->id) }}">Edit</a>

                        <form action="{{ route('pelanggan.destroy', $item->id) }}"
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="hapus" type="submit"
                                onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
