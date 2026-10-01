<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
</head>
<body>

<h1>Edit Kategori</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('kategori.index') }}">Kembali</a>

</body>
</html>