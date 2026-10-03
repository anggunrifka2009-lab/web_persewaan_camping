<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyewaan</title>
</head>
<body>
    <h1>Riwayat Penyewaan Saya</h1>

    <a href="{{ route('home') }}">Kembali ke Beranda</a>

    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penyewaan</th>
                <th>Barang Disewa</th>
                <th>Tanggal Sewa</th>
                <th>Rencana Kembali</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($penyewaan as $item)
                <tr>
                    <td>{{ $penyewaan->firstItem() + $loop->index }}</td>
                    <td>{{ $item->kode_penyewaan }}</td>
                    <td>
                        @forelse ($item->detailPenyewaan as $detail)
                            {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                            ({{ $detail->jumlah }} unit)

                            @if (!$loop->last)
                                <br>
                            @endif
                        @empty
                            -
                        @endforelse
                    </td>
                    <td>{{ $item->tanggal_sewa->format('d-m-Y') }}</td>
                    <td>{{ $item->tanggal_rencana_kembali->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Kamu belum memiliki riwayat penyewaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{ $penyewaan->links() }}
</body>
</html>