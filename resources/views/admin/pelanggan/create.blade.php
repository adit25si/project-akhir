
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan - Adit Chocolate</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f8f5f2; }
        h1 { color: #5b3025; }
        form { max-width: 550px; background: white; padding: 25px; border-radius: 8px; }
        label { display: block; margin-top: 15px; }
        input, textarea { width: 100%; box-sizing: border-box; padding: 10px; margin-top: 5px; }
        button, a { display: inline-block; margin-top: 20px; padding: 10px 15px; border: none; border-radius: 5px; text-decoration: none; cursor: pointer; }
        button { background: #5b3025; color: white; }
        a { background: #ddd; color: black; }
        .error { color: #c0392b; font-size: 14px; }
    </style>
</head>
<body>
    <h1>Tambah Pelanggan</h1>

    @if ($errors->any())
        <div class="error">
            <strong>Periksa kembali data yang diisi:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        <label>Nama *</label>
        <input type="text" name="nama" value="{{ old('nama') }}" required>
        @error('nama') <div class="error">{{ $message }}</div> @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>No. HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}">
        @error('no_hp') <div class="error">{{ $message }}</div> @enderror

        <label>Alamat</label>
        <textarea name="alamat" rows="3">{{ old('alamat') }}</textarea>
        @error('alamat') <div class="error">{{ $message }}</div> @enderror

        <button type="submit">Simpan Pelanggan</button>
        <a href="{{ route('pelanggan.index') }}">Kembali</a>
    </form>
</body>
</html>
