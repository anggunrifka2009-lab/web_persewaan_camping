<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
</head>
<body>
    <h1>Edit Profil</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('akun.update') }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama">Nama</label>
        <input id="nama" type="text" name="nama"
            value="{{ old('nama', $user->nama) }}" required>

        <label for="email">Email</label>
        <input id="email" type="email" name="email"
            value="{{ old('email', $user->email) }}" required>

        <label for="no_hp">Nomor HP</label>
        <input id="no_hp" type="text" name="no_hp"
            value="{{ old('no_hp', $user->no_hp) }}">

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat">{{ old('alamat', $user->alamat) }}</textarea>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('akun.index') }}">Kembali</a>
</body>
</html>