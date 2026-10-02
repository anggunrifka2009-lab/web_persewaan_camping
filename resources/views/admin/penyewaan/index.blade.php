<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan</title>
</head>
<body>
    <h1>Data Penyewaan</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('admin.penyewaan.index') }}" method="GET" id="form-pencarian">
        <input
            type="text"
            name="cari"
            id="cari-penyewaan"
            placeholder="Cari kode penyewaan atau nama pelanggan"
            value="{{ $cari }}"
            autocomplete="off"
        >
        <button type="submit">Cari</button>
        <a href="{{ route('admin.penyewaan.index') }}">Reset</a>
    </form>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penyewaan</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Sewa</th>
                <th>Rencana Kembali</th>
                <th>Total Harga</th>
                <th>Pengambilan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody id="hasil-penyewaan">
            @forelse ($penyewaan as $item)
                <tr>
                    <td>{{ $penyewaan->firstItem() + $loop->index }}</td>
                    <td>{{ $item->kode_penyewaan }}</td>
                    <td>{{ $item->user->nama ?? '-' }}</td>
                    <td>{{ $item->tanggal_sewa->format('d-m-Y') }}</td>
                    <td>{{ $item->tanggal_rencana_kembali->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->jenis_pengambilan) }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>
                        @if ($item->status === 'menunggu')
                            <form action="{{ route('admin.penyewaan.setujui', $item->id_penyewaan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Setujui</button>
                            </form>

                            <form action="{{ route('admin.penyewaan.tolak', $item->id_penyewaan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Tolak</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Data penyewaan tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <div id="pagination-penyewaan">
        {{ $penyewaan->links() }}
    </div>

    <br>

    <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-pencarian');
            const input = document.getElementById('cari-penyewaan');
            const hasil = document.getElementById('hasil-penyewaan');
            const pagination = document.getElementById('pagination-penyewaan');
            let timer;

            async function muatPenyewaan(url) {
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
                    const hasilBaru = dokumen.querySelector('#hasil-penyewaan');
                    const paginationBaru = dokumen.querySelector('#pagination-penyewaan');

                    if (hasilBaru && paginationBaru) {
                        hasil.innerHTML = hasilBaru.innerHTML;
                        pagination.innerHTML = paginationBaru.innerHTML;
                    }
                } catch (error) {
                    console.error('Gagal memuat penyewaan:', error);
                }
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);

                timer = setTimeout(function () {
                    muatPenyewaan(new URL(form.action, window.location.origin));
                }, 300);
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                clearTimeout(timer);
                muatPenyewaan(new URL(form.action, window.location.origin));
            });

            pagination.addEventListener('click', function (event) {
                const link = event.target.closest('a');

                if (!link) return;

                event.preventDefault();
                muatPenyewaan(new URL(link.href));
            });
        });
    </script>
</body>
</html>