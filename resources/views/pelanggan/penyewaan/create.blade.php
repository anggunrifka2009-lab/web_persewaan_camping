<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penyewaan - {{ $barang->nama_barang }} - CampRent</title>

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
            --muted: #7b817a;
            --border: #e4e2d9;
            --danger: #a52f2f;
            --danger-soft: #fff1f1;
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
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        input,
        button {
            font: inherit;
        }

        :focus-visible {
            outline: 2px solid var(--forest);
            outline-offset: 2px;
        }

        /* Navbar */
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
            color: #eb533f;
        }

        .dropdown-logout:hover {
            background: #f8eeeb;
        }

        .dropdown-logout img {
            display: block;
            width: 17px;
            height: 17px;
            object-fit: contain;
            filter: brightness(0) saturate(100%)
                invert(48%) sepia(77%) saturate(1800%)
                hue-rotate(327deg) brightness(96%) contrast(95%);
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
            padding: 40px 28px 70px;
        }

        .topbar {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 26px;
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

        .page-title {
            font-size: 23px;
            font-weight: 800;
            line-height: 1.4;
        }

        .layout {
            display: grid;
            grid-template-columns: 1.25fr 1fr;
            gap: 26px;
            align-items: start;
        }

        .card {
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: var(--white);
        }

        .card-title {
            margin-bottom: 4px;
            font-size: 16px;
            font-weight: 800;
        }

        .card-sub {
            margin-bottom: 22px;
            color: var(--muted);
            font-size: 12px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid #efc9c1;
            border-radius: 10px;
            background: var(--danger-soft);
            color: var(--danger);
            font-size: 12px;
            line-height: 1.8;
        }

        .alert strong {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .field input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--text);
            font: inherit;
            font-size: 13px;
        }

        .field input:focus {
            border-color: var(--forest);
        }

        .hint {
            margin-top: 7px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .date-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .submit-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px 20px;
            border: none;
            border-radius: 9px;
            background: var(--forest);
            color: white;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .submit-button:hover {
            background: var(--forest-dark);
        }

        .note {
            margin-top: 14px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
            text-align: center;
        }

        .summary {
            position: sticky;
            top: 90px;
            padding: 0;
            overflow: hidden;
        }

        .summary-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 210px;
            border-bottom: 1px solid var(--border);
            background: #fff;
        }

        .summary-image img {
            width: 100%;
            height: 100%;
            padding: 12px;
            object-fit: contain;
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 12px;
        }

        .no-image svg {
            width: 46px;
            height: 46px;
            stroke: var(--forest);
            opacity: .55;
        }

        .summary-body {
            padding: 22px 24px 24px;
        }

        .category {
            display: inline-block;
            margin-bottom: 12px;
            padding: 7px 11px;
            border-radius: 7px;
            background: var(--forest-soft);
            color: var(--forest);
            font-size: 11px;
            font-weight: 600;
        }

        .summary-body h2 {
            margin-bottom: 6px;
            font-size: 20px;
            line-height: 1.35;
            overflow-wrap: anywhere;
        }

        .info-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 18px;
        }

        .info-item {
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--cream);
        }

        .info-item p:first-child {
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 11px;
        }

        .info-item p:last-child {
            color: var(--forest);
            font-size: 13px;
            font-weight: 700;
        }

        .bill {
            padding: 16px;
            border: 1px dashed #c9cfc0;
            border-radius: 10px;
            background: var(--cream);
        }

        .bill-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 5px 0;
            color: var(--muted);
            font-size: 12px;
        }

        .bill-row span:last-child {
            color: var(--text);
            font-weight: 600;
            text-align: right;
        }

        .bill-total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 10px;
            padding-top: 14px;
            border-top: 1px solid #d9dccf;
        }

        .bill-total span {
            font-size: 12px;
            font-weight: 700;
        }

        .bill-total strong {
            color: var(--forest);
            font-size: 22px;
            font-weight: 800;
        }

        .rules {
            margin-top: 26px;
            padding: 22px 26px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--cream);
        }

        .rules h3 {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .rules ul {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 26px;
            list-style: none;
        }

        .rules li {
            position: relative;
            padding: 6px 0 6px 22px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .rules li::before {
            content: "";
            position: absolute;
            left: 2px;
            top: 11px;
            width: 10px;
            height: 6px;
            border-left: 2px solid var(--forest);
            border-bottom: 2px solid var(--forest);
            transform: rotate(-45deg);
        }

        .footer {
            padding: 30px 6%;
            background: var(--forest-dark);
            color: #e4e9df;
            text-align: center;
        }

        .footer strong {
            display: block;
            margin-bottom: 8px;
            color: white;
            font-size: 17px;
        }

        .footer p {
            font-size: 12px;
            line-height: 1.8;
        }

        @media (max-width: 900px) {
            .navbar {
                padding-right: 3%;
                padding-left: 3%;
            }

            .layout {
                grid-template-columns: 1fr;
            }

            .summary {
                position: static;
                order: -1;
            }
        }

        @media (max-width: 850px) {
            .layout {
                grid-template-columns: 1fr;
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
                padding: 30px 18px 50px;
            }

            .topbar {
                gap: 11px;
                margin-bottom: 22px;
            }

            .btn-back {
                width: 38px;
                height: 38px;
            }

            .page-title {
                font-size: 20px;
            }

            .card {
                padding: 20px 16px;
            }

            .summary {
                padding: 0;
            }

            .date-grid,
            .rules ul {
                grid-template-columns: 1fr;
            }

            .rules {
                padding: 20px 18px;
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
                                <img src="{{ asset('images/logout.png') }}" alt="">
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

        <header class="topbar">
            <a href="{{ url()->previous() }}" class="btn-back" aria-label="Kembali">
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

            <h1 class="page-title">Form Penyewaan</h1>
        </header>

        <div class="layout">

            <section class="card">
                <h2 class="card-title">Detail Penyewaan</h2>
                <p class="card-sub">Lama sewa maksimal 7 hari.</p>

                @if ($errors->any())
                    <div class="alert" role="alert">
                        <strong>Penyewaan belum bisa diajukan:</strong>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('penyewaan.store', $barang->id_barang) }}" method="POST">
                    @csrf

                    <div class="field">
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
                        <p class="hint">Stok tersedia {{ $barang->stok }} unit.</p>
                    </div>

                    <div class="date-grid">
                        <div class="field">
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

                        <div class="field">
                            <label for="tanggal_rencana_kembali">Tanggal Pengembalian</label>
                            <input
                                type="date"
                                id="tanggal_rencana_kembali"
                                name="tanggal_rencana_kembali"
                                value="{{ old('tanggal_rencana_kembali') }}"
                                required
                            >
                        </div>
                    </div>

                    <p class="hint" style="margin: -8px 0 22px;">
                        Pilih tanggal mulai dulu. Tanggal pengembalian bisa dipilih 1 sampai 7 hari setelahnya.
                    </p>

                    <button type="submit" class="submit-button">Ajukan Penyewaan</button>

                    <p class="note">Pesanan baru diproses setelah dikonfirmasi admin.</p>
                </form>
            </section>

            <aside class="card summary">
                <div class="summary-image">
                    @if ($barang->foto)
                        <img
                            src="{{ asset('storage/' . $barang->foto) }}"
                            alt="Foto {{ $barang->nama_barang }}"
                        >
                    @else
                        <div class="no-image">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 20 12 4l9 16H3Z" />
                                <path d="M12 4v16" />
                                <path d="m9 20 3-6 3 6" />
                            </svg>
                            <span>Foto belum tersedia</span>
                        </div>
                    @endif
                </div>

                <div class="summary-body">
                    <span class="category">
                        {{ $barang->kategori->nama_kategori ?? '-' }}
                    </span>

                    <h2>{{ $barang->nama_barang }}</h2>

                    <div class="info-list">
                        <div class="info-item">
                            <p>Harga per Hari</p>
                            <p>Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}</p>
                        </div>

                        <div class="info-item">
                            <p>Stok Tersedia</p>
                            <p>{{ $barang->stok }} unit</p>
                        </div>
                    </div>

                    <div class="bill">
                        <div class="bill-row">
                            <span>Jumlah barang</span>
                            <span id="ringkas-jumlah">-</span>
                        </div>

                        <div class="bill-row">
                            <span>Lama sewa</span>
                            <span id="ringkas-lama">-</span>
                        </div>

                        <div class="bill-total">
                            <span>Total Harga</span>
                            <strong id="total-harga">Rp 0</strong>
                        </div>
                    </div>
                </div>
            </aside>

        </div>

        <section class="rules">
            <h3>Sebelum mengajukan</h3>
            <ul>
                <li>Barang harus dikembalikan sesuai tanggal yang dipilih.</li>
                <li>Periksa kondisi barang saat pengambilan dan pengembalian.</li>
                <li>Kerusakan atau kehilangan menjadi tanggung jawab penyewa.</li>
                <li>Keterlambatan pengembalian dapat dikenakan denda.</li>
            </ul>
        </section>

    </main>

    <footer class="footer">
        <strong>⌁ CampRent</strong>
        <p>Sistem Informasi Persewaan Alat Camping</p>
        <p>Siapkan perlengkapanmu, nikmati petualanganmu.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('accountDropdown');
            const toggle = document.getElementById('account-toggle');

            if (dropdown && toggle) {
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
            }

            const tanggalSewa = document.getElementById('tanggal_sewa');
            const tanggalKembali = document.getElementById('tanggal_rencana_kembali');
            const jumlahBarang = document.getElementById('jumlah');
            const totalHarga = document.getElementById('total-harga');
            const ringkasJumlah = document.getElementById('ringkas-jumlah');
            const ringkasLama = document.getElementById('ringkas-lama');
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

                ringkasJumlah.textContent = jumlah >= 1 ? jumlah + ' unit' : '-';
                ringkasLama.textContent = '-';

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

                ringkasLama.textContent = lamaSewa + ' hari';

                const total = jumlah * hargaPerHari * lamaSewa;

                totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
            }

            tanggalSewa.addEventListener('change', aturBatasTanggal);
            tanggalKembali.addEventListener('change', hitungTotalHarga);
            jumlahBarang.addEventListener('input', hitungTotalHarga);

            aturBatasTanggal();
            hitungTotalHarga();
        });
    </script>

</body>
</html>