<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun</title>
</head>
<body>
    <h1>Informasi Akun</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p><strong>Nama:</strong> {{ $user->nama }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Nomor HP:</strong> {{ $user->no_hp ?: '-' }}</p>
    <p><strong>Alamat:</strong> {{ $user->alamat ?: '-' }}</p>
    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

    <a href="{{ route('akun.edit') }}">Edit Profil</a>
    <a href="{{ route('akun.password') }}">Ganti Password</a>

    @if ($user->role === 'admin')
        <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
    @else
        <a href="{{ route('home') }}">Kembali ke Beranda</a>
    @endif
</body>
</html>