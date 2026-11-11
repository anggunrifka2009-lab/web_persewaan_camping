<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penyewaan - CampRent</title>
    <style>
        @page { margin: 20px 25px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; color: #222; }
        h1 { font-size: 16px; margin: 0 0 4px; color: #244b38; }
        .sub { color: #666; font-size: 9px; margin-bottom: 14px; }

        table { width: 100%; border-collapse: collapse; }

        .ringkasan td {
            width: 33.33%;
            border: 1px solid #ccc;
            padding: 8px 10px;
        }
        .ringkasan .label { color: #666; font-size: 9px; }
        .ringkasan .angka { font-size: 14px; font-weight: bold; color: #244b38; margin-top: 3px; }

        .data { margin-top: 16px; }
        .data th {
            background: #f0f0f0;
            border: 1px solid #ccc;
            padding: 6px 5px;
            font-size: 8.5px;
            text-align: left;
        }
        .data td {
            border: 1px solid #ccc;
            padding: 5px;
            vertical-align: top;
        }
        .data thead { display: table-header-group; }
        .data tr { page-break-inside: avoid; }
        .center { text-align: center; }
        .bold { font-weight: bold; }

        .footer { margin-top: 18px; color: #777; font-size: 8px; text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Penyewaan</h1>
    <div class="sub">
        Rekap data penyewaan alat camping dan pendapatan CampRent.
        Tanggal cetak: {{ now()->format('d-m-Y') }}
    </div>

    <table class="ringkasan">
        <tr>
            <td>
                <div class="label">Total Penyewaan</div>
                <div class="angka">{{ number_format($totalPenyewaan, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="label">Penyewaan Selesai</div>
                <div class="angka">{{ number_format($totalSelesai, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="label">Menunggu Persetujuan</div>
                <div class="angka">{{ number_format($totalMenunggu, 0, ',', '.') }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="label">Penyewaan Ditolak</div>
                <div class="angka">{{ number_format($totalDitolak, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="label">Total Pendapatan</div>
                <div class="angka">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="label">Total Denda</div>
                <div class="angka">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th class="center" style="width:25px">NO.</th>
                <th>KODE PENYEWAAN</th>
                <th>PELANGGAN</th>
                <th>BARANG DISEWA</th>
                <th>TANGGAL SEWA</th>
                <th>RENCANA KEMBALI</th>
                <th>TOTAL HARGA</th>
                <th>DENDA</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penyewaan as $item)
                @php
                    $dataPengembalian = $pengembalian->get($item->id_penyewaan);
                    $status = strtolower($item->status ?? '');
                    $statusLabel = match ($status) {
                        'dikembalikan' => 'Selesai',
                        'ditolak' => 'Ditolak',
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'dibayar' => 'Dibayar',
                        'dibatalkan' => 'Dibatalkan',
                        default => ucfirst($status ?: 'Tidak diketahui'),
                    };
                @endphp
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td class="bold">{{ $item->kode_penyewaan ?? ('SEWA-' . $item->id_penyewaan) }}</td>
                    <td>{{ $item->user->nama ?? '-' }}</td>
                    <td>
                        @forelse ($item->detailPenyewaan as $detail)
                            <div>{{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }} ({{ $detail->jumlah ?? 1 }} unit)</div>
                        @empty
                            -
                        @endforelse
                    </td>
                    <td>{{ $item->tanggal_sewa ? \Carbon\Carbon::parse($item->tanggal_sewa)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $item->tanggal_rencana_kembali ? \Carbon\Carbon::parse($item->tanggal_rencana_kembali)->format('d-m-Y') : '-' }}</td>
                    <td>Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $dataPengembalian ? 'Rp ' . number_format($dataPengembalian->denda ?? 0, 0, ',', '.') : '-' }}</td>
                    <td>{{ $statusLabel }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="center">Belum ada data penyewaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">CampRent — Sistem Informasi Persewaan Alat Camping</div>
</body>
</html>