<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>
<body>

<h1>Tambah Barang</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('barang.store') }}" method="POST">
    @csrf

    <label>Kategori</label>
    <select name="id_kategori" required>
        <option value="">Pilih Kategori</option>

        @foreach ($kategori as $item)
            <option value="{{ $item->id_kategori }}">
                {{ $item->nama_kategori }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Nama Barang</label>
    <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required>

    <br><br>

    <label>Deskripsi</label>
    <textarea name="deskripsi" required>{{ old('deskripsi') }}</textarea>

    <br><br>

    <label>Harga Sewa</label>
    <input type="text" name="harga_sewa" id="harga_sewa" value="{{ old('harga_sewa') }}" required>

    <script>
    const hargaSewa = document.getElementById('harga_sewa');
    hargaSewa.addEventListener('input', function () {
        let angka = this.value.replace(/\D/g, '');
        this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    });
    </script>

    <br><br>

    <label>Stok</label>
    <input type="number" name="stok" value="{{ old('stok') }}" required>

    <br><br>

    <label>Status</label>
    <select name="status" required>
        <option value="tersedia">Tersedia</option>
        <option value="tidak tersedia">Tidak Tersedia</option>
    </select>

    <br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('barang.index') }}">Kembali</a>

</body>
</html>