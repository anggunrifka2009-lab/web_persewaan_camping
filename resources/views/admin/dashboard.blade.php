<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>

<div class="navbar">
    <h2>Admin Persewaan</h2>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<div class="container">

    <div class="welcome">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, {{ Auth::user()->nama }}</p>
    </div>

    <div class="menu">

        <a href="{{ route('kategori.index') }}">
            <h3>Kategori</h3>
            <p>Kelola kategori alat camping.</p>
        </a>

        <a href="{{ route('barang.index') }}">
            <h3>Barang</h3>
            <p>Kelola data alat camping.</p>
        </a>

        <a href="{{ route('admin.penyewaan.index') }}">
            <h3>Penyewaan</h3>
            <p>Kelola transaksi penyewaan.</p>
        </a>

        <a href="#">
            <h3>Pembayaran</h3>
            <p>Kelola pembayaran pelanggan.</p>
        </a>

        <a href="#">
            <h3>Pengembalian</h3>
            <p>Kelola pengembalian dan denda.</p>
        </a>

        <a href="#">
            <h3>Laporan</h3>
            <p>Lihat dan cetak laporan.</p>
        </a>

    </div>

</div>

</body>
</html>