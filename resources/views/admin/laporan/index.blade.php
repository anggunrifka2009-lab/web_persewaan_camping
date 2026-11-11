<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penyewaan - CampRent</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f5f1e8;
            --white: #fffefa;
            --forest: #244b38;
            --forest-dark: #193a2b;
            --text: #26392e;
            --muted: #7b817a;
            --border: #e4e2d9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .main {
            min-height: 100vh;
            margin-left: 250px;
            padding: 32px 38px 28px;
        }

        #laporan-content {
            animation: contentEnter .3s ease-out;
        }

        @keyframes contentEnter {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-title {
            color: var(--text);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .page-subtitle {
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        /* ===== Filter tanggal ===== */
        .filter-bar {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 22px;
            padding: 16px 18px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--white);
        }

        .filter-bar .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-bar label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 600;
        }

        .filter-bar input[type="date"] {
            padding: 8px 10px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            color: var(--text);
            font: inherit;
            font-size: 12px;
        }

        .filter-bar input[type="date"]:focus {
            outline: none;
            border-color: var(--forest);
        }

        .filter-error {
            width: 100%;
            color: #984c43;
            font-size: 11px;
        }

        .ringkasan {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 32px;
        }

        .card {
            min-width: 0;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--white);
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }

        .card:hover {
            transform: translateY(-2px);
            border-color: #c4d2c4;
            box-shadow: 0 10px 25px rgba(38, 57, 46, .06);
        }

        .card h3 {
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
            line-height: 1.6;
        }

        .angka {
            margin-top: 10px;
            overflow-wrap: anywhere;
            color: var(--forest);
            font-size: clamp(20px, 2vw, 27px);
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .panel {
            min-width: 0;
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: var(--white);
        }

        .panel-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
        }

        .panel-heading h2 {
            margin-bottom: 6px;
            color: var(--text);
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        .panel-heading p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-shrink: 0;
            padding: 9px 14px;
            border: 1px solid transparent;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, border-color .2s;
        }

        .btn-primary {
            border-color: var(--forest);
            background: var(--forest);
            color: white;
        }

        .btn-primary:hover {
            border-color: var(--forest-dark);
            background: var(--forest-dark);
        }

        .btn-secondary {
            border-color: var(--border);
            background: white;
            color: var(--text);
        }

        .btn-secondary:hover {
            background: #f3f1e9;
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--white);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead th {
            padding: 15px 17px;
            background: #f9f8f2;
            color: #737b70;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        tbody td {
            padding: 16px 17px;
            border-top: 1px solid var(--border);
            color: var(--text);
            font-size: 11px;
            line-height: 1.8;
            vertical-align: top;
        }

        tbody tr {
            transition: background .15s;
        }

        tbody tr:hover {
            background: #fcfbf7;
        }

        .number {
            width: 45px;
            color: var(--muted);
            text-align: center;
        }

        .code {
            color: var(--forest);
            font-weight: 800;
            white-space: nowrap;
        }

        .item-name {
            font-weight: 600;
        }

        .price {
            color: var(--forest);
            font-weight: 700;
            white-space: nowrap;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #e8eee8;
            color: #315b3d;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status.unavailable {
            background: #f8e7e4;
            color: #984c43;
        }

        .status.menunggu {
            background: #fff2d7;
            color: #94661c;
        }

        .status.berjalan {
            background: #e6eefb;
            color: #345d99;
        }

        .empty-state {
            padding: 35px 20px;
            color: var(--muted);
            text-align: center;
            font-size: 12px;
            line-height: 1.8;
        }

        .pagination-area {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .pagination-info {
            color: var(--muted);
            font-size: 11px;
        }

        .pagination nav > div:first-child {
            display: none;
        }

        .pagination nav > div:last-child {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pagination a,
        .pagination span[aria-current="page"] span,
        .pagination span[aria-disabled="true"] span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            min-height: 34px;
            padding: 7px 10px;
            margin: 0 2px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--white);
            font-size: 11px;
            text-decoration: none;
        }

        .pagination a {
            color: var(--forest);
        }

        .pagination a:hover {
            background: #eaf0e8;
        }

        .pagination span[aria-current="page"] span {
            border-color: var(--forest);
            background: var(--forest);
            color: white;
        }

        .pagination span[aria-disabled="true"] span {
            color: #b5b7af;
        }

        .pagination svg {
            width: 16px;
            height: 16px;
        }

        #laporan-ajax {
            transition: opacity .15s;
        }

        #laporan-ajax.loading {
            opacity: .55;
            pointer-events: none;
        }

        .footer {
            margin-top: 35px;
            padding-top: 18px;
            border-top: 1px solid #e0ddd3;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        @media (max-width: 1100px) {
            .ringkasan {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 215px;
                padding: 28px 24px;
            }

            .panel {
                padding: 18px;
            }

            .panel-heading {
                align-items: flex-start;
            }

            table {
                min-width: 1050px;
            }

            .pagination-area {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 620px) {
            .main {
                margin-left: 0;
                padding: 24px 17px;
            }

            .topbar {
                align-items: flex-start;
                margin-bottom: 22px;
            }

            .page-title {
                font-size: 21px;
            }

            .page-subtitle {
                font-size: 11px;
            }

            .filter-bar {
                padding: 14px;
            }

            .filter-bar .field {
                flex: 1 1 140px;
            }

            .ringkasan {
                gap: 10px;
                margin-bottom: 26px;
            }

            .card {
                padding: 15px;
            }

            .angka {
                font-size: 22px;
            }

            .panel {
                padding: 15px;
            }

            .panel-heading {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
                margin-bottom: 17px;
            }

            .panel-heading h2 {
                font-size: 16px;
            }

            .panel-heading p {
                font-size: 11px;
            }

            .table-wrap {
                border-radius: 10px;
            }

            .pagination {
                max-width: 100%;
                overflow-x: auto;
            }

            .footer {
                margin-top: 28px;
            }
        }

        @media (max-width: 360px) {
            .main {
                padding-right: 12px;
                padding-left: 12px;
            }

            .ringkasan {
                grid-template-columns: 1fr;
            }

            .panel {
                padding: 12px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            #laporan-content {
                animation: none;
            }

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition: none !important;
            }
        }

        @media print {
            @page {
                size: landscape;
                margin: 10mm;
            }

            body {
                min-height: auto;
                background: white;
                color: #222;
            }

            .main {
                min-height: auto;
                margin: 0;
                padding: 0;
            }

            .topbar {
                margin-bottom: 20px;
            }

            .ringkasan {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 10px;
                margin-bottom: 20px;
            }

            .card {
                padding: 12px;
                border-color: #ccc;
                background: white;
                break-inside: avoid;
            }

            .card:hover {
                transform: none;
                box-shadow: none;
            }

            .panel {
                padding: 0;
                border: none;
                background: white;
            }

            .panel-heading {
                margin-bottom: 12px;
            }

            .btn-primary,
            .filter-bar,
            .pagination-area,
            .footer {
                display: none !important;
            }

            .table-wrap {
                overflow: visible;
                border-color: #ccc;
                border-radius: 0;
            }

            table {
                width: 100%;
                min-width: 0;
            }

            thead {
                display: table-header-group;
            }

            tr {
                break-inside: avoid;
            }

            thead th,
            tbody td {
                padding: 7px 6px;
                border: 1px solid #ccc;
                color: #222;
                font-size: 9px;
            }

            thead th {
                background: #f0f0f0 !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .status {
                border: 1px solid #ccc;
                background: white !important;
                color: #222 !important;
            }
        }
    </style>
</head>

<body>
    @include('admin.sidebar')

    @php
        $filterAktif = request()->filled('dari') || request()->filled('sampai');
    @endphp

    <main class="main" id="laporan-content">
        <header class="topbar">
            <div>
                <h1 class="page-title">Laporan Penyewaan</h1>
                <p class="page-subtitle">
                    Rekap data penyewaan alat camping dan pendapatan CampRent.
                    @if ($filterAktif)
                        Periode:
                        {{ request('dari') ? \Carbon\Carbon::parse(request('dari'))->format('d-m-Y') : 'awal' }}
                        s/d
                        {{ request('sampai') ? \Carbon\Carbon::parse(request('sampai'))->format('d-m-Y') : 'sekarang' }}.
                    @endif
                    Tanggal cetak: {{ now()->format('d-m-Y') }}
                </p>
            </div>
        </header>

        <form method="GET" action="{{ route('admin.laporan.index') }}" class="filter-bar">
            <div class="field">
                <label for="dari">Dari tanggal</label>
                <input type="date" id="dari" name="dari" value="{{ request('dari') }}">
            </div>

            <div class="field">
                <label for="sampai">Sampai tanggal</label>
                <input type="date" id="sampai" name="sampai" value="{{ request('sampai') }}">
            </div>

            <button type="submit" class="btn btn-primary">Terapkan Filter</button>

            @if ($filterAktif)
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Reset</a>
            @endif

            @if ($errors->any())
                <div class="filter-error">{{ $errors->first() }}</div>
            @endif
        </form>

        <section class="ringkasan">
            <div class="card">
                <h3>Total Penyewaan</h3>
                <div class="angka">{{ number_format($totalPenyewaan, 0, ',', '.') }}</div>
            </div>

            <div class="card">
                <h3>Penyewaan Selesai</h3>
                <div class="angka">{{ number_format($totalSelesai, 0, ',', '.') }}</div>
            </div>

            <div class="card">
                <h3>Menunggu Persetujuan</h3>
                <div class="angka">{{ number_format($totalMenunggu, 0, ',', '.') }}</div>
            </div>

            <div class="card">
                <h3>Penyewaan Ditolak</h3>
                <div class="angka">{{ number_format($totalDitolak, 0, ',', '.') }}</div>
            </div>

            <div class="card">
                <h3>Total Pendapatan</h3>
                <div class="angka">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>

            <div class="card">
                <h3>Total Denda</h3>
                <div class="angka">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Riwayat Penyewaan</h2>
                    <p>Pantau riwayat transaksi, status penyewaan, dan denda pengembalian barang.</p>
                </div>

                <a href="{{ route('admin.laporan.pdf', request()->only(['dari', 'sampai'])) }}" target="_blank" class="btn btn-primary">
                    Cetak Laporan (PDF)
                </a>
            </div>

            <div id="laporan-ajax">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th class="number">NO.</th>
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

                                    $statusClass = match ($status) {
                                        'ditolak', 'dibatalkan' => 'unavailable',
                                        'menunggu' => 'menunggu',
                                        'dikembalikan' => '',
                                        default => 'berjalan',
                                    };

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
                                    <td class="number">{{ $penyewaan->firstItem() + $loop->index }}</td>
                                    <td>
                                        <span class="code">
                                            {{ $item->kode_penyewaan ?? ('SEWA-' . $item->id_penyewaan) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="item-name">{{ $item->user->nama ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @forelse ($item->detailPenyewaan as $detail)
                                            <div>
                                                {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                                ({{ $detail->jumlah ?? 1 }} unit)
                                            </div>
                                        @empty
                                            -
                                        @endforelse
                                    </td>
                                    <td>
                                        {{ $item->tanggal_sewa ? \Carbon\Carbon::parse($item->tanggal_sewa)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td>
                                        {{ $item->tanggal_rencana_kembali ? \Carbon\Carbon::parse($item->tanggal_rencana_kembali)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td>
                                        <span class="price">
                                            Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="price">
                                            {{ $dataPengembalian ? 'Rp ' . number_format($dataPengembalian->denda ?? 0, 0, ',', '.') : '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status {{ $statusClass }}">{{ $statusLabel }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="empty-state">
                                        {{ $filterAktif ? 'Tidak ada data penyewaan pada periode ini.' : 'Belum ada data penyewaan.' }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-area">
                    <div class="pagination-info">
                        @if ($penyewaan->total() > 0)
                            Menampilkan {{ $penyewaan->firstItem() }}-{{ $penyewaan->lastItem() }}
                            dari {{ $penyewaan->total() }} data
                        @else
                            {{ $filterAktif ? 'Tidak ada data pada periode ini.' : 'Belum ada data penyewaan.' }}
                        @endif
                    </div>

                    <div class="pagination">
                        {{ $penyewaan->links() }}
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer">
            CampRent — Sistem Informasi Persewaan Alat Camping
        </footer>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('laporan-ajax');
            let controller = null;

            if (!container) return;

            async function muatHalaman(url, ubahRiwayat = true) {
                if (controller) {
                    controller.abort();
                }

                controller = new AbortController();
                container.classList.add('loading');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        },
                        signal: controller.signal
                    });

                    if (!response.ok) {
                        throw new Error('Gagal memuat laporan.');
                    }

                    const html = await response.text();
                    const dokumen = new DOMParser().parseFromString(html, 'text/html');
                    const bagianBaru = dokumen.querySelector('#laporan-ajax');

                    if (!bagianBaru) {
                        throw new Error('Bagian laporan tidak ditemukan.');
                    }

                    container.innerHTML = bagianBaru.innerHTML;

                    if (ubahRiwayat) {
                        history.pushState({}, '', url);
                    }
                } catch (error) {
                    if (error.name === 'AbortError') return;

                    window.location.href = url;
                } finally {
                    container.classList.remove('loading');
                }
            }

            container.addEventListener('click', function (event) {
                const link = event.target.closest('.pagination a');

                if (!link) return;

                event.preventDefault();
                muatHalaman(link.href);
            });

            window.addEventListener('popstate', function () {
                muatHalaman(window.location.href, false);
            });
        });
    </script>
</body>
</html>