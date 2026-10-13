<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
</head>
<body>

    <h1>Ganti Password</h1>

    <a href="{{ route('akun.index') }}">Kembali ke Informasi Akun</a>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('akun.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="password_lama">Password Lama</label>
            <input type="password" id="password_lama" name="password_lama" required>
        </div>

        <div>
            <label for="password_baru">Password Baru</label>
            <input type="password" id="password_baru" name="password_baru" required>
        </div>

        <div>
            <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
            <input type="password" id="password_baru_confirmation" name="password_baru_confirmation" required>
        </div>

        <button type="submit">Simpan Password</button>
    </form>

</body>
</html>
