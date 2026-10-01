<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
</head>
<body>

<h1>Tambah Kategori</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf

    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('kategori.index') }}">Kembali</a>

</body>
</html>