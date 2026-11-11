<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyewaan - CampRent</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f5f1e8;
            --white: #fffefa;
            --forest: #244b38;
            --forest-dark: #193a2b;
            --forest-soft: #edf1e8;
            --text: #26392e;
            --muted: #6f766e;
            --border: #e4e2d9;
            --red: #984c43;
            --red-bg: #f8eeeb;
            --green-bg: #eaf2e7;
            --blue-bg: #edf0f8;
            --radius-lg: 16px;
            --radius-md: 10px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--white);
            color: var(--text);
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 13px;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        :focus-visible {
            outline: 2px solid var(--forest);
            outline-offset: 2px;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            width: 100%;
            padding: 15px 2%;
            border-bottom: 1px solid var(--border);
            background: rgba(255, 254, 250, 0.97);
            backdrop-filter: blur(12px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-shrink: 0;
            color: var(--forest);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .brand-icon {
            font-size: 29px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 14px;
            min-width: 0;
            margin-left: auto;
        }

        .nav-link {
            padding: 10px 12px;
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            transition: color .2s;
        }

        .nav-link:hover {
            color: var(--forest);
        }

        .account-dropdown-wrapper {
            position: relative;
        }

        .account-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 8px 5px 5px;
            border: 1px solid transparent;
            border-radius: 30px;
            background: transparent;
            cursor: pointer;
            transition: background .2s;
        }

        .account-dropdown-toggle:hover,
        .account-dropdown-wrapper.show .account-dropdown-toggle {
            background: var(--forest-soft);
        }

        .nav-account {
            display: grid;
            flex-shrink: 0;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e7eee4;
            color: var(--forest);
            font-size: 15px;
            font-weight: 800;
        }

        .dropdown-arrow {
            width: 15px;
            height: 15px;
            color: var(--muted);
            transition: transform .2s;
        }

        .account-dropdown-wrapper.show .dropdown-arrow {
            transform: rotate(180deg);
        }

        .account-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            z-index: 101;
            width: 220px;
            padding: 7px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--white);
            box-shadow: 0 10px 30px rgba(38, 57, 46, .12);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: opacity .2s ease, transform .2s ease, visibility .2s;
        }

        .account-dropdown-wrapper.show .account-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 12px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: var(--text);
            font-size: 12px;
            font-weight: 600;
            text-align: left;
            cursor: pointer;
            transition: background .2s;
        }

        .dropdown-item:hover {
            background: #f2f3ed;
        }

        .dropdown-item svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            color: var(--muted);
        }

        .dropdown-divider {
            height: 1px;
            margin: 5px 4px;
            background: var(--border);
        }

        .nav-form {
            margin: 0;
        }

        .dropdown-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 14px;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #eb533f;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            cursor: pointer;
            transition: background .2s;
        }

        .dropdown-logout:hover {
            background: #f8eeeb;
        }

        .dropdown-logout svg {
            display: block;
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            color: #eb533f;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .nav-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 17px;
            border-radius: 9px;
            background: var(--forest);
            color: white;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            transition: background .2s;
        }

        .nav-cta:hover {
            background: var(--forest-dark);
        }

        .container {
            flex: 1;
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 48px 28px 70px;
        }

        .page-head {
            margin-bottom: 28px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 38px;
            height: 38px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--forest);
            transition: background .2s;
        }

        .btn-back:hover {
            background: var(--forest-soft);
        }

        .btn-back svg {
            display: block;
            width: 20px;
            height: 20px;
        }

        .section-label {
            margin-bottom: 9px;
            color: var(--forest);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
        }

        .page-head h1 {
            font-size: clamp(24px, 3vw, 32px);
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -1px;
        }

        .page-head p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .panel {
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            background: var(--white);
        }

        .panel-heading {
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border);
        }

        .panel-heading h2 {
            font-size: 17px;
            font-weight: 700;
        }

        .panel-heading p {
            margin-top: 4px;
            color: var(--muted);
            font-size: 13px;
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid;
            border-radius: var(--radius-md);
            font-size: 13px;
        }

        .alert-success {
            border-color: #cfe0cc;
            background: var(--green-bg);
            color: var(--forest);
            font-weight: 600;
        }

        .alert-error {
            border-color: #ead0cb;
            background: var(--red-bg);
            color: var(--red);
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        table {
            width: 100%;
            min-width: 980px;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: #f9f8f2;
        }

        th {
            padding: 13px 14px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            border-top: 1px solid var(--border);
            font-size: 12px;
            vertical-align: top;
        }

        tbody tr:hover {
            background: #fcfbf7;
        }

        .col-no {
            width: 52px;
            color: var(--muted);
        }

        .code {
            color: var(--forest);
            font-weight: 700;
            white-space: nowrap;
        }

        .price {
            font-weight: 700;
            white-space: nowrap;
        }

        .status {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #fbf0d9;
            color: #94691d;
        }

        .status-disetujui {
            background: var(--blue-bg);
            color: #465b8c;
        }

        .status-dibayar {
            background: var(--green-bg);
            color: #347246;
        }

        .status-dikembalikan {
            background: #e5eee7;
            color: var(--forest);
        }

        .status-ditolak,
        .status-dibatalkan {
            background: var(--red-bg);
            color: var(--red);
        }

        .note {
            display: block;
            max-width: 260px;
            color: var(--muted);
            font-size: 12px;
        }

        .empty {
            padding: 40px 20px;
            color: var(--muted);
            text-align: center;
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
            font-size: 13px;
        }

        .pagination {
            color: var(--forest);
            font-size: 13px;
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
            padding: 6px 10px;
            margin: 0 2px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
        }

        .pagination a {
            color: var(--forest);
            transition: background .2s;
        }

        .pagination a:hover {
            background: var(--forest-soft);
        }

        .pagination span[aria-current="page"] span {
            border-color: var(--forest);
            background: var(--forest);
            color: #fff;
        }

        .pagination span[aria-disabled="true"] span {
            color: #aaa;
        }

        .pagination svg {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 900px) {
            .navbar {
                padding-right: 3%;
                padding-left: 3%;
            }
        }

        @media (max-width: 650px) {
            .navbar {
                align-items: center;
                flex-wrap: nowrap;
                gap: 13px;
                padding: 14px 5%;
            }

            .brand {
                font-size: 21px;
            }

            .brand-icon {
                font-size: 26px;
            }

            .nav-menu {
                width: auto;
                flex-shrink: 0;
                justify-content: flex-end;
                margin-left: auto;
            }

            .nav-account {
                width: 38px;
                height: 38px;
            }

            .account-dropdown {
                width: 210px;
            }

            .container {
                padding: 24px 16px 48px;
            }

            .page-head h1 {
                font-size: 24px;
            }

            .panel {
                padding: 20px 14px;
            }

            .pagination-wrap {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="brand">
            <span class="brand-icon">⌁</span>
            CampRent
        </a>

        <div class="nav-menu">
            @auth
                <div class="account-dropdown-wrapper" id="accountDropdown">

                    <button
                        type="button"
                        class="account-dropdown-toggle"
                        id="account-toggle"
                        aria-label="Menu akun"
                        aria-expanded="false"
                        aria-controls="account-menu"
                    >
                        <span class="nav-account">
                            {{ strtoupper(mb_substr(Auth::user()->nama, 0, 1)) }}
                        </span>

                        <svg class="dropdown-arrow"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>

                    <div class="account-dropdown" id="account-menu">

                        <a href="{{ route('akun.index') }}" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 aria-hidden="true">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                            </svg>
                            <span>Informasi Akun</span>
                        </a>

                        @if (Auth::user()->role === 'pelanggan')
                            <a href="{{ route('penyewaan.riwayat') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="M3 3v5h5"/>
                                    <path d="M3.5 13a9 9 0 1 0 2.1-6.2L3 8"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                                <span>Riwayat Penyewaan</span>
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>

                        <form action="{{ route('logout') }}" method="POST" class="nav-form">
                            @csrf

                            <button type="submit" class="dropdown-item dropdown-logout">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>

                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-link">
                    Login
                </a>

                <a href="{{ route('register') }}" class="nav-cta">
                    Daftar Sekarang
                </a>
            @endauth
        </div>
    </nav>

    <main class="container">

        <div class="page-head">

            <div class="page-heading">
                <a href="{{ route('home') }}"
                   class="btn-back"
                   aria-label="Kembali ke Beranda"
                   title="Kembali ke Beranda">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         aria-hidden="true">
                        <path d="m12 19-7-7 7-7"/>
                        <path d="M19 12H5"/>
                    </svg>
                </a>

                <h1>Riwayat Penyewaan</h1>
            </div>

            <p>Informasi status dan proses penyewaan alat camping kamu.</p>
        </div>

        <section class="panel">

            @if (session('success'))
                <div class="alert alert-success" role="status">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Penyewaan</th>
                            <th>Barang Disewa</th>
                            <th>Tanggal Sewa</th>
                            <th>Rencana Kembali</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($penyewaan as $item)
                            @php
                                $tanggalSewa = \Carbon\Carbon::parse($item->tanggal_sewa)->startOfDay();

                                $statusLabel = match ($item->status) {
                                    'menunggu' => 'Menunggu Persetujuan',
                                    'disetujui' => 'Menunggu Pembayaran',
                                    'dibayar' => 'Sudah Dibayar',
                                    'dikembalikan' => 'Selesai',
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
                                <td class="col-no">
                                    {{ $penyewaan->firstItem() + $loop->index }}
                                </td>

                                <td class="code">
                                    {{ $item->kode_penyewaan }}
                                </td>

                                <td>
                                    @forelse ($item->detailPenyewaan as $detail)
                                        <div>
                                            {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                            ({{ $detail->jumlah }} unit)
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
                                    <span class="status {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                <td>
                                    <span class="note">
                                        @if ($item->status === 'menunggu')
                                            Penyewaan sedang menunggu persetujuan admin.
                                        @elseif ($item->status === 'disetujui')
                                            Silakan lakukan pembayaran sesuai instruksi admin.
                                        @elseif ($item->status === 'dibayar' && now()->lt($tanggalSewa))
                                            Pembayaran dikonfirmasi. Jadwal sewa dimulai
                                            {{ $tanggalSewa->format('d-m-Y') }}.
                                        @elseif ($item->status === 'dibayar')
                                            Jadwal sewa telah tiba. Pengembalian menunggu konfirmasi admin.
                                        @elseif ($item->status === 'dikembalikan')
                                            Barang telah dikembalikan dan penyewaan selesai.
                                        @elseif ($item->status === 'ditolak')
                                            Pengajuan penyewaan ditolak oleh admin.
                                        @elseif ($item->status === 'dibatalkan')
                                            Penyewaan telah dibatalkan.
                                        @else
                                            Tidak ada keterangan tambahan.
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty">
                                    Kamu belum memiliki riwayat penyewaan.
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

                <div class="pagination">
                    {{ $penyewaan->appends(request()->query())->links() }}
                </div>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('accountDropdown');
            const toggle = document.getElementById('account-toggle');

            if (!dropdown || !toggle) return;

            toggle.addEventListener('click', function (e) {
                e.stopPropagation();

                const isOpen = dropdown.classList.toggle('show');
                toggle.setAttribute('aria-expanded', isOpen);
            });

            document.addEventListener('click', function (e) {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    dropdown.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        });
    </script>

</body>

</html>