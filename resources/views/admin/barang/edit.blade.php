<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>

<h1>Edit Barang</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Kategori</label>
    <select name="id_kategori" required>
        @foreach ($kategori as $item)
            <option value="{{ $item->id_kategori }}"
                {{ $barang->id_kategori == $item->id_kategori ? 'selected' : '' }}>
                {{ $item->nama_kategori }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Kode Barang</label>
    <input type="text" value="{{ $barang->kode_barang }}" readonly>
    
    <br><br>

    <label>Nama Barang</label>
    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" required>

    <br><br>

    <label>Deskripsi</label>
    <textarea name="deskripsi" required>{{ $barang->deskripsi }}</textarea>

    <br><br>

    <label>Harga Sewa</label>
    <input type="text" name="harga_sewa" id="harga_sewa"
        value="{{ number_format($barang->harga_sewa, 0, ',', '.') }}" required>

    <br><br>

    <label>Stok</label>
    <input type="number" name="stok" value="{{ $barang->stok }}" required>

    <br><br>

    <label>Status</label>
    <select name="status" required>
        <option value="tersedia" {{ $barang->status == 'tersedia' ? 'selected' : '' }}>
            Tersedia
        </option>
        <option value="tidak tersedia" {{ $barang->status == 'tidak tersedia' ? 'selected' : '' }}>
            Tidak Tersedia
        </option>
    </select>

    <br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('barang.index') }}">Kembali</a>

<script>
const hargaSewa = document.getElementById('harga_sewa');

hargaSewa.addEventListener('input', function () {
    let angka = this.value.replace(/\D/g, '');
    this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});
</script>

</body>
</html>