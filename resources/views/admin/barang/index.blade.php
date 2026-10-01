<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
</head>
<body>

<h1>Data Barang</h1>

<a href="{{ route('barang.create') }}">Tambah Barang</a>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga Sewa</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($barang as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="{{ route('barang.edit', $item->id_barang) }}">Edit</a>

                    <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>

</body>
</html>