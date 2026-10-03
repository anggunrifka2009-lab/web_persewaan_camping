<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penyewaan</title>
</head>
<body>
    <h1>Form Penyewaan Alat Camping</h1>

    <a href="{{ route('home') }}">Kembali ke Beranda</a>

    <h2>{{ $barang->nama_barang }}</h2>
    <p>Kode Barang: {{ $barang->kode_barang }}</p>
    <p>Kategori: {{ $barang->kategori->nama_kategori ?? '-' }}</p>
    <p>Harga Sewa per Hari: Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}</p>
    <p>Stok Tersedia: {{ $barang->stok }}</p>
    <p>Total Harga: <strong id="total-harga">Rp 0</strong></p>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('penyewaan.store', $barang->id_barang) }}" method="POST">
        @csrf

        <div>
            <label for="jumlah">Jumlah Barang</label>
            <input
                type="number"
                id="jumlah"
                name="jumlah"
                min="1"
                max="{{ $barang->stok }}"
                value="{{ old('jumlah', 1) }}"
                required
            >
        </div>

        <div>
            <label for="tanggal_sewa">Tanggal Mulai Sewa</label>
            <input
                type="date"
                id="tanggal_sewa"
                name="tanggal_sewa"
                min="{{ date('Y-m-d') }}"
                value="{{ old('tanggal_sewa') }}"
                required
            >
        </div>

        <div>
            <label for="tanggal_rencana_kembali">Tanggal Pengembalian</label>
            <input
                type="date"
                id="tanggal_rencana_kembali"
                name="tanggal_rencana_kembali"
                value="{{ old('tanggal_rencana_kembali') }}"
                required
            >
        </div>

        <button type="submit">Ajukan Penyewaan</button>
    </form>

    <script>
        const tanggalSewa = document.getElementById('tanggal_sewa');
        const tanggalKembali = document.getElementById('tanggal_rencana_kembali');
        const jumlahBarang = document.getElementById('jumlah');
        const totalHarga = document.getElementById('total-harga');
        const hargaPerHari = {{ $barang->harga_sewa }};

        function formatTanggal(tanggal) {
            const tahun = tanggal.getFullYear();
            const bulan = String(tanggal.getMonth() + 1).padStart(2, '0');
            const hari = String(tanggal.getDate()).padStart(2, '0');

            return `${tahun}-${bulan}-${hari}`;
        }

        function aturBatasTanggal() {
            if (!tanggalSewa.value) {
                tanggalKembali.min = '';
                tanggalKembali.max = '';
                hitungTotalHarga();
                return;
            }

            const mulai = new Date(tanggalSewa.value + 'T00:00:00');
            const minKembali = new Date(mulai);
            const maxKembali = new Date(mulai);

            minKembali.setDate(minKembali.getDate() + 1);
            maxKembali.setDate(maxKembali.getDate() + 7);

            tanggalKembali.min = formatTanggal(minKembali);
            tanggalKembali.max = formatTanggal(maxKembali);

            if (
                tanggalKembali.value &&
                (
                    tanggalKembali.value < tanggalKembali.min ||
                    tanggalKembali.value > tanggalKembali.max
                )
            ) {
                tanggalKembali.value = '';
            }

            hitungTotalHarga();
        }

        function hitungTotalHarga() {
            const jumlah = parseInt(jumlahBarang.value) || 0;

            if (
                !tanggalSewa.value ||
                !tanggalKembali.value ||
                jumlah < 1 ||
                jumlah > Number(jumlahBarang.max)
            ) {
                totalHarga.textContent = 'Rp 0';
                return;
            }

            const mulai = new Date(tanggalSewa.value + 'T00:00:00');
            const kembali = new Date(tanggalKembali.value + 'T00:00:00');
            const lamaSewa = Math.round((kembali - mulai) / 86400000);

            if (lamaSewa < 1 || lamaSewa > 7) {
                totalHarga.textContent = 'Rp 0';
                return;
            }

            const total = jumlah * hargaPerHari * lamaSewa;

            totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        tanggalSewa.addEventListener('change', aturBatasTanggal);
        tanggalKembali.addEventListener('change', hitungTotalHarga);
        jumlahBarang.addEventListener('input', hitungTotalHarga);

        aturBatasTanggal();
        hitungTotalHarga();
    </script>
</body>
</html>