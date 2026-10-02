<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persewaan Alat Camping</title>
</head>
<body>

<nav>
    <strong>Persewaan Alat Camping</strong>

    <div>
        @auth
            <span>Halo, {{ Auth::user()->nama }}</span>

            @if (Auth::user()->role === 'pelanggan')
                <a href="{{ route('penyewaan.riwayat') }}">Riwayat Penyewaan</a>
            @endif

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</nav>

<div class="container">
    <h1>Sistem Informasi Persewaan Alat Camping</h1>

    <p>Temukan dan sewa berbagai alat camping dengan mudah.</p>

    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Daftar</a>
    @endguest

    <h2>Daftar Alat Camping</h2>

    @if ($barang->isEmpty())
        <p>Belum ada alat camping yang tersedia.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Sewa per Hari</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($barang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>
                            @auth
                                @if (Auth::user()->role === 'pelanggan')
                                    <a href="{{ route('penyewaan.create', $item->id_barang) }}">Sewa</a>
                                @else
                                    -
                                @endif
                            @else
                                <a href="{{ route('login') }}">Login untuk menyewa</a>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>