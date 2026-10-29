<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan - CamRent</title>

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

        button, input, select {
            font: inherit;
        }

        .main {
            min-height: 100vh;
            margin-left: 250px;
            padding: 32px 38px 28px;
        }

        #penyewaan-content {
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

        @media (prefers-reduced-motion: reduce) {
            #penyewaan-content {
                animation: none;
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

        .panel {
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .panel-heading h2 {
            font-size: 17px;
            letter-spacing: -.3px;
        }

        .panel-heading p {
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 34px;
            padding: 8px 11px;
            border: 1px solid transparent;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
            text-align: center;
        }

        .btn-approve {
            background: #eaf2e7;
            color: #347246;
        }

        .btn-approve:hover {
            background: #dcebd7;
        }

        .btn-reject,
        .btn-cancel {
            background: #f8eeeb;
            color: #984c43;
        }

        .btn-reject:hover,
        .btn-cancel:hover {
            background: #f2dfda;
        }

        .btn-payment {
            background: #edf0f8;
            color: #465b8c;
        }

        .btn-payment:hover {
            background: #dfe5f5;
        }

        .btn-return {
            background: #eaf0e8;
            color: var(--forest);
        }

        .btn-return:hover {
            background: #dce8d9;
        }

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .toolbar-title {
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
        }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            width: min(100%, 650px);
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 9px;
            flex: 1 1 280px;
            min-width: 0;
        }

        .search-form input,
        .filter-form select {
            height: 40px;
            padding: 0 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--white);
            color: var(--text);
            font-size: 12px;
        }

        .search-form input {
            width: 100%;
            min-width: 0;
        }

        .filter-form select {
            flex: 0 1 170px;
            min-width: 150px;
            cursor: pointer;
        }

        .search-form input:focus,
        .filter-form select:focus {
            border-color: #9bb39a;
            box-shadow: 0 0 0 3px rgba(36, 75, 56, .07);
        }

        .btn-search {
            min-width: 65px;
            min-height: 40px;
            padding: 10px 14px;
            background: #eaf0e8;
            color: var(--forest);
        }

        .btn-search:hover {
            background: #dce8d9;
        }

        .btn-reset {
            min-height: 40px;
            padding: 10px 13px;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--muted);
        }

        .btn-reset:hover {
            background: #f4f2eb;
            color: var(--forest);
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: #f9f8f2;
        }

        th {
            padding: 15px 14px;
            color: #737b70;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        td {
            padding: 15px 14px;
            border-top: 1px solid var(--border);
            font-size: 11px;
            line-height: 1.8;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fcfbf7;
        }

        .number {
            width: 45px;
            color: var(--muted);
        }

        .rental-code {
            color: var(--forest);
            font-weight: 700;
            white-space: nowrap;
        }

        .customer-name {
            min-width: 115px;
            font-weight: 700;
        }

        .items-cell {
            min-width: 155px;
        }

        .item-line + .item-line {
            margin-top: 4px;
        }

        .price {
            font-weight: 700;
            white-space: nowrap;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #fbf0d9;
            color: #94691d;
        }

        .status-disetujui {
            background: #edf0f8;
            color: #465b8c;
        }

        .status-dibayar {
            background: #eaf2e7;
            color: #347246;
        }

        .status-dikembalikan {
            background: #e5eee7;
            color: #244b38;
        }

        .status-ditolak,
        .status-dibatalkan {
            background: #f8eeeb;
            color: #984c43;
        }

        .fine {
            font-weight: 600;
            white-space: nowrap;
        }

        .actions {
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            gap: 7px;
            min-width: 145px;
        }

        .action-form {
            width: 100%;
            margin: 0;
        }

        .action-form .btn {
            width: 100%;
        }

        .action-note {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .empty-state {
            padding: 35px 20px;
            color: var(--muted);
            text-align: center;
            line-height: 1.8;
        }

        .pagination-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 20px;
        }

        .pagination-info {
            color: var(--muted);
            font-size: 12px;
        }

        .pagination nav {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 4px;
        }

        .pagination nav > div:first-child {
            display: none;
        }

        .pagination nav > div:last-child {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
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
            font-size: 12px;
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
            color: #aaa;
        }

        .footer {
            margin-top: 35px;
            padding-top: 18px;
            border-top: 1px solid #e0ddd3;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 15px;
            border: 1px solid;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
        }

        .alert-success {
            border-color: #cfe0cc;
            background: #edf5e9;
            color: #315b3d;
        }

        .alert-error {
            border-color: #ead0cb;
            background: #f8eeeb;
            color: #984c43;
        }

        @media (max-width: 1200px) {
            .main {
                padding-right: 24px;
                padding-left: 24px;
            }

            .panel {
                padding: 20px;
            }

            th,
            td {
                padding-right: 11px;
                padding-left: 11px;
            }
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 215px;
                padding: 28px 24px;
            }

            .toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-form {
                width: 100%;
                max-width: none;
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

            .panel {
                padding: 18px 14px;
            }

            .panel-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .panel-heading h2 {
                font-size: 16px;
            }

            .filter-form {
                align-items: stretch;
                flex-direction: column;
            }

            .filter-form select {
                width: 100%;
                flex-basis: auto;
            }

            .search-form {
                flex-basis: auto;
                width: 100%;
            }

            table {
                min-width: 1120px;
            }

            .pagination-wrap {
                align-items: flex-start;
            }

            .footer {
                margin-top: 28px;
            }
        }

        @media (max-width: 380px) {
            .main {
                padding-right: 12px;
                padding-left: 12px;
            }

            .topbar {
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    @include('admin.sidebar')

    <main class="main" id="penyewaan-content">
        <header class="topbar">
            <div>
                <h1 class="page-title">Data Penyewaan</h1>
                <p class="page-subtitle">
                    Kelola penyewaan alat camping dan proses pengembaliannya.
                </p>
            </div>
        </header>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Daftar Penyewaan</h2>
                    <p>Pantau status penyewaan, pembayaran, dan pengembalian barang pelanggan.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <div class="toolbar">
                <div class="toolbar-title">Riwayat penyewaan pelanggan</div>

                <form action="{{ route('admin.penyewaan.index') }}"
                      method="GET"
                      id="form-pencarian"
                      class="filter-form">

                    <select name="status" id="filter-status">
                        <option value="">Semua Status</option>
                        <option value="menunggu" @selected(($status ?? request('status')) === 'menunggu')>Menunggu</option>
                        <option value="disetujui" @selected(($status ?? request('status')) === 'disetujui')>Disetujui</option>
                        <option value="ditolak" @selected(($status ?? request('status')) === 'ditolak')>Ditolak</option>
                        <option value="dibayar" @selected(($status ?? request('status')) === 'dibayar')>Dibayar</option>
                        <option value="dibatalkan" @selected(($status ?? request('status')) === 'dibatalkan')>Dibatalkan</option>
                        <option value="dikembalikan" @selected(($status ?? request('status')) === 'dikembalikan')>Dikembalikan</option>
                    </select>

                    <div class="search-form">
                        <input type="text"
                               name="cari"
                               id="cari-penyewaan"
                               placeholder="Cari kode penyewaan atau nama pelanggan..."
                               value="{{ $cari ?? request('cari') }}"
                               autocomplete="off">

                        <button type="submit" class="btn btn-search">Cari</button>
                    </div>

                    <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-reset">
                        Reset
                    </a>
                </form>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th class="number">NO.</th>
                            <th>KODE PENYEWAAN</th>
                            <th>NAMA PELANGGAN</th>
                            <th>BARANG DISEWA</th>
                            <th>TANGGAL SEWA</th>
                            <th>RENCANA KEMBALI</th>
                            <th>TOTAL HARGA</th>
                            <th>STATUS</th>
                            <th>DENDA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody id="hasil-penyewaan">
                        @forelse ($penyewaan as $item)
                            @php
                                $dataPengembalian = $pengembalian->get($item->id_penyewaan);

                                $tanggalSewa = \Carbon\Carbon::parse($item->tanggal_sewa)->startOfDay();
                                $hariIni = \Carbon\Carbon::today();
                                $bolehDikembalikan = $hariIni->greaterThanOrEqualTo($tanggalSewa);

                                $statusLabel = match ($item->status) {
                                    'menunggu' => 'Menunggu',
                                    'disetujui' => 'Disetujui',
                                    'dibayar' => 'Dibayar',
                                    'dikembalikan' => 'Dikembalikan',
                                    'ditolak' => 'Ditolak',
                                    'dibatalkan' => 'Dibatalkan',
                                    default => ucfirst($item->status),
                                };

                                $statusClass = match ($item->status) {
                                    'menunggu' => 'status-menunggu',
                                    'disetujui' => 'status-disetujui',
                                    'dibayar' => 'status-dibayar',
                                    'dikembalikan' => 'status-dikembalikan',
                                    'ditolak' => 'status-ditolak',
                                    'dibatalkan' => 'status-dibatalkan',
                                    default => '',
                                };
                            @endphp

                            <tr>
                                <td class="number">
                                    {{ $penyewaan->firstItem() + $loop->index }}
                                </td>

                                <td class="rental-code">
                                    {{ $item->kode_penyewaan }}
                                </td>

                                <td class="customer-name">
                                    {{ $item->user->nama ?? '-' }}
                                </td>

                                <td class="items-cell">
                                    @forelse ($item->detailPenyewaan as $detail)
                                        <div class="item-line">
                                            {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                            <span>({{ $detail->jumlah }} unit)</span>
                                        </div>
                                    @empty
                                        -
                                    @endforelse
                                </td>

                                <td>
                                    {{ $tanggalSewa->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_rencana_kembali)->format('d-m-Y') }}
                                </td>

                                <td class="price">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                <td class="fine">
                                    @if ($dataPengembalian)
                                        Rp {{ number_format($dataPengembalian->denda, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    <div class="actions">
                                        @if ($item->status === 'menunggu')
                                            <form action="{{ route('admin.penyewaan.setujui', $item->id_penyewaan) }}"
                                                  method="POST"
                                                  class="action-form">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="btn btn-approve">
                                                    Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.penyewaan.tolak', $item->id_penyewaan) }}"
                                                  method="POST"
                                                  class="action-form"
                                                  onsubmit="return confirm('Yakin ingin menolak penyewaan ini?')">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="btn btn-reject">
                                                    Tolak
                                                </button>
                                            </form>

                                        @elseif ($item->status === 'disetujui')
                                            <form action="{{ route('admin.penyewaan.konfirmasiPembayaran', $item->id_penyewaan) }}"
                                                  method="POST"
                                                  class="action-form"
                                                  onsubmit="return confirm('Pastikan pembayaran sudah diterima. Konfirmasi pembayaran ini?')">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="btn btn-payment">
                                                    Konfirmasi Pembayaran
                                                </button>
                                            </form>

                                        @elseif ($item->status === 'dibayar')
                                            @if (!$bolehDikembalikan)
                                                <form action="{{ route('admin.penyewaan.batalkan', $item->id_penyewaan) }}"
                                                      method="POST"
                                                      class="action-form"
                                                      onsubmit="return confirm('Yakin ingin membatalkan penyewaan ini? Pastikan pelanggan sudah diberi informasi.')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-cancel">
                                                        Batal
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.penyewaan.dikembalikan', $item->id_penyewaan) }}"
                                                      method="POST"
                                                      class="action-form"
                                                      onsubmit="return confirm('Pastikan barang benar-benar sudah diterima kembali. Konfirmasi pengembalian ini?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-return">
                                                        Kembalikan
                                                    </button>
                                                </form>

                                                <span class="action-note">
                                                    Konfirmasi setelah barang diterima dari pelanggan.
                                                </span>
                                            @endif

                                        @elseif ($item->status === 'dikembalikan')
                                            <span class="status-badge status-dikembalikan">
                                                Dikembalikan
                                            </span>

                                        @elseif ($item->status === 'ditolak')
                                            <span class="status-badge status-ditolak">
                                                Ditolak
                                            </span>

                                        @elseif ($item->status === 'dibatalkan')
                                            <span class="status-badge status-dibatalkan">
                                                Dibatalkan
                                            </span>

                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty-state">
                                    Data penyewaan tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">
                <div class="pagination-info">
                    Menampilkan {{ $penyewaan->firstItem() ?? 0 }}-{{ $penyewaan->lastItem() ?? 0 }}
                    dari {{ $penyewaan->total() }} data
                </div>

                <div id="pagination-penyewaan" class="pagination">
                    {{ $penyewaan->links() }}
                </div>
            </div>
        </section>

        <footer class="footer">
            CamRent — Sistem Informasi Persewaan Alat Camping
        </footer>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-pencarian');
            const input = document.getElementById('cari-penyewaan');
            const filterStatus = document.getElementById('filter-status');
            const hasil = document.getElementById('hasil-penyewaan');
            const pagination = document.getElementById('pagination-penyewaan');

            let timer;
            let controller;

            async function cariPenyewaan(url = new URL(form.action, window.location.origin)) {
                if (controller) {
                    controller.abort();
                }

                controller = new AbortController();

                url.searchParams.set('cari', input.value);

                if (filterStatus.value) {
                    url.searchParams.set('status', filterStatus.value);
                } else {
                    url.searchParams.delete('status');
                }

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        signal: controller.signal
                    });

                    if (!response.ok) {
                        return;
                    }

                    const html = await response.text();
                    const dokumen = new DOMParser().parseFromString(html, 'text/html');

                    const hasilBaru = dokumen.querySelector('#hasil-penyewaan');
                    const paginationBaru = dokumen.querySelector('#pagination-penyewaan');
                    const statusBaru = dokumen.querySelector('#filter-status');

                    if (hasilBaru && paginationBaru) {
                        hasil.innerHTML = hasilBaru.innerHTML;
                        pagination.innerHTML = paginationBaru.innerHTML;

                        if (statusBaru) {
                            filterStatus.value = statusBaru.value;
                        }

                        window.history.replaceState({}, '', url);
                    }
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('Pencarian penyewaan gagal:', error);
                    }
                }
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);

                timer = setTimeout(() => {
                    cariPenyewaan();
                }, 300);
            });

            filterStatus.addEventListener('change', function () {
                clearTimeout(timer);
                cariPenyewaan();
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                clearTimeout(timer);
                cariPenyewaan();
            });

            pagination.addEventListener('click', function (event) {
                const link = event.target.closest('a');

                if (!link) {
                    return;
                }

                event.preventDefault();
                cariPenyewaan(new URL(link.href));
            });
        });
    </script>
</body>
</html>