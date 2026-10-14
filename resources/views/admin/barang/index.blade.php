
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
</head>
<body>
<h1>Data Barang</h1>

<form action="{{ route('barang.index') }}" method="GET" id="form-pencarian">
    <input
        type="text"
        name="cari"
        id="cari-barang"
        placeholder="Cari kode atau nama barang"
        value="{{ $cari }}"
        autocomplete="off"
    >
    <button type="submit">Cari</button>
</form>

<br>

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
    <tbody id="hasil-barang">
        @forelse ($barang as $item)
            <tr>
                <td>{{ $barang->firstItem() + $loop->index }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                <td>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="{{ route('barang.edit', $item->id_barang) }}">Edit</a>
                    <form
                        action="{{ route('barang.destroy', $item->id_barang) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">Data barang tidak ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<br>

<div id="pagination-barang">
    {{ $barang->links() }}
</div>

<br>

<a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-pencarian');
    const input = document.getElementById('cari-barang');
    const hasil = document.getElementById('hasil-barang');
    const pagination = document.getElementById('pagination-barang');

    let timer;

    async function cariBarang() {
        const url = new URL(form.action, window.location.origin);
        url.searchParams.set('cari', input.value);

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) return;

            const html = await response.text();
            const dokumen = new DOMParser().parseFromString(html, 'text/html');
            const hasilBaru = dokumen.querySelector('#hasil-barang');
            const paginationBaru = dokumen.querySelector('#pagination-barang');

            if (hasilBaru && paginationBaru) {
                hasil.innerHTML = hasilBaru.innerHTML;
                pagination.innerHTML = paginationBaru.innerHTML;
            }
        } catch (error) {
            console.error('Pencarian gagal:', error);
        }
    }

    input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(cariBarang, 300);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        clearTimeout(timer);
        cariBarang();
    });

    pagination.addEventListener('click', function (event) {
        const link = event.target.closest('a');

        if (!link) return;

        event.preventDefault();

        const url = new URL(link.href);
        url.searchParams.set('cari', input.value);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const dokumen = new DOMParser().parseFromString(html, 'text/html');
            const hasilBaru = dokumen.querySelector('#hasil-barang');
            const paginationBaru = dokumen.querySelector('#pagination-barang');

            if (hasilBaru && paginationBaru) {
                hasil.innerHTML = hasilBaru.innerHTML;
                pagination.innerHTML = paginationBaru.innerHTML;
            }
        })
        .catch(error => console.error('Pagination gagal:', error));
    });
});
</script>

</body>
</html>