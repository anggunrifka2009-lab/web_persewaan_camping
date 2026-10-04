<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penyewaan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #333;
        }

        .ringkasan {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 15px;
            margin: 25px 0;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 18px;
        }

        .card h3 {
            margin-top: 0;
            font-size: 15px;
        }

        .angka {
            font-size: 22px;
            font-weight: bold;
        }

        .aksi {
            margin: 20px 0;
        }

        button, .tombol {
            display: inline-block;
            padding: 9px 14px;
            margin-right: 6px;
            border: 1px solid #888;
            border-radius: 4px;
            background: #f5f5f5;
            color: #222;
            text-decoration: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 9px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f0f0f0;
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 700px) {
            body {
                margin: 15px;
            }

            .tabel-wrapper {
                overflow-x: auto;
            }
        }

        @media print {
            .aksi, .pagination, .navigasi {
                display: none !important;
            }

            body {
                margin: 0;
            }

            .ringkasan {
                grid-template-columns: repeat(3, 1fr);
            }

            tr {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <h1>Laporan Penyewaan Alat Camping</h1>
    <p>Tanggal cetak: {{ now()->format('d-m-Y') }}</p>

    <div class="ringkasan">
        <div class="card">
            <h3>Total Penyewaan</h3>
            <div class="angka">{{ $totalPenyewaan }}</div>
        </div>

        <div class="card">
            <h3>Penyewaan Selesai</h3>
            <div class="angka">{{ $totalSelesai }}</div>
        </div>

        <div class="card">
            <h3>Menunggu Persetujuan</h3>
            <div class="angka">{{ $totalMenunggu }}</div>
        </div>

        <div class="card">
            <h3>Penyewaan Ditolak</h3>
            <div class="angka">{{ $totalDitolak }}</div>
        </div>

        <div class="card">
            <h3>Total Pendapatan</h3>
            <div class="angka">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>
        </div>

        <div class="card">
            <h3>Total Denda</h3>
            <div class="angka">
                Rp {{ number_format($totalDenda, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="aksi">
        <button type="button" onclick="window.print()">Cetak Laporan</button>
        <a href="{{ route('admin.dashboard') }}" class="tombol navigasi">
            Kembali ke Dashboard
        </a>
        <a href="{{ route('admin.penyewaan.index') }}" class="tombol navigasi">
            Data Penyewaan
        </a>
    </div>

    <h2>Riwayat Penyewaan</h2>

    <div class="tabel-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Penyewaan</th>
                    <th>Pelanggan</th>
                    <th>Barang Disewa</th>
                    <th>Tanggal Sewa</th>
                    <th>Rencana Kembali</th>
                    <th>Total Harga</th>
                    <th>Denda</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($penyewaan as $item)
                    @php
                        $dataPengembalian = DB::table('pengembalian')
                            ->where('id_penyewaan', $item->id_penyewaan)
                            ->first();
                    @endphp

                    <tr>
                        <td>{{ $penyewaan->firstItem() + $loop->index }}</td>
                        <td>{{ $item->kode_penyewaan }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>

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

                        <td>
                            Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>

                        <td>
                            @if ($dataPengembalian)
                                Rp {{ number_format($dataPengembalian->denda, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if ($item->status === 'dikembalikan')
                                Selesai
                            @elseif ($item->status === 'ditolak')
                                Ditolak
                            @else
                                {{ ucfirst($item->status) }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">Belum ada data penyewaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $penyewaan->links() }}
    </div>
</body>
</html>