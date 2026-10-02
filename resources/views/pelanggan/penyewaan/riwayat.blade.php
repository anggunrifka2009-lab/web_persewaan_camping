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

    @if ($penyewaan->isEmpty())
        <p>Belum ada riwayat penyewaan.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Penyewaan</th>
                    <th>Tanggal Sewa</th>
                    <th>Rencana Kembali</th>
                    <th>Total Harga</th>
                    <th>Pengambilan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penyewaan as $item)
                    <tr>
                        <td>{{ $penyewaan->firstItem() + $loop->index }}</td>
                        <td>{{ $item->kode_penyewaan }}</td>
                        <td>{{ $item->tanggal_sewa->format('d-m-Y') }}</td>
                        <td>{{ $item->tanggal_rencana_kembali->format('d-m-Y') }}</td>
                        <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td>
                            {{ $item->jenis_pengambilan === 'diambil' ? 'Diambil sendiri' : 'Dikirim' }}
                        </td>
                        <td>{{ ucfirst($item->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $penyewaan->links() }}
    @endif
</body>
</html>