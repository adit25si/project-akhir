
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - Adit Chocolate</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 35px;
            background: #f8f5f2;
            color: #3d2923;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 {
            color: #5b3025;
            margin: 0 0 8px;
        }

        .subtitle {
            color: #77665f;
            margin: 0;
        }

        .tambah, .edit, .hapus {
            display: inline-block;
            padding: 9px 13px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .tambah {
            background: #5b3025;
            color: white;
        }

        .edit {
            background: #e7b65c;
            color: #302016;
        }

        .hapus {
            background: #c0392b;
            color: white;
        }

        .alert {
            padding: 14px 16px;
            margin: 15px 0;
            border-radius: 6px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.07);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 13px 12px;
            border-bottom: 1px solid #eadfd9;
            text-align: left;
        }

        th {
            background: #5b3025;
            color: white;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fcf8f5;
        }

        .aksi {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .aksi form {
            margin: 0;
        }

        .kosong {
            text-align: center;
            color: #77665f;
            padding: 25px;
        }

        @media (max-width: 600px) {
            body {
                padding: 18px;
            }

            .card {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <h1>Data Pelanggan</h1>
            <p class="subtitle">Manajemen data pelanggan Adit Chocolate</p>
        </div>

        <a class="tambah" href="{{ route('pelanggan.create') }}">
            + Tambah Pelanggan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($errors) && $errors->any())
        <div class="alert alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <h2>Daftar Pelanggan</h2>

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
                        <td>{{ $item->email ?: '-' }}</td>
                        <td>{{ $item->no_hp ?: '-' }}</td>
                        <td>{{ $item->alamat ?: '-' }}</td>
                        <td>
                            <div class="aksi">
                                <a class="edit"
                                   href="{{ route('pelanggan.edit', $item->id) }}">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('pelanggan.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="hapus" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="kosong">
                            Belum ada data pelanggan.
                            Silakan klik Tambah Pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
