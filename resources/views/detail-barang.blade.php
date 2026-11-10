<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $barang->nama_barang }} - CampRent</title>

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
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 40px 28px 70px;
            flex: 1;
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

        .detail-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 38px;
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: var(--white);
        }

        .image-box {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 350px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #fff;
        }

        .image-box img {
            width: 100%;
            height: 350px;
            padding: 12px;
            object-fit: contain;
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 20px;
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        .no-image svg {
            width: 54px;
            height: 54px;
            stroke: var(--forest);
            opacity: .55;
        }

        .detail-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .category {
            align-self: flex-start;
            margin-bottom: 15px;
            padding: 8px 12px;
            border-radius: 7px;
            background: #edf1e8;
            color: var(--forest);
            font-size: 11px;
            font-weight: 600;
        }

        .detail-info h2 {
            margin-bottom: 10px;
            font-size: 30px;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        .description-title {
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: 700;
        }

        .description {
            margin-bottom: 23px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9;
            overflow-wrap: anywhere;
        }

        .info-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 25px;
        }

        .info-item {
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--cream);
        }

        .info-item p:first-child {
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 11px;
        }

        .info-item p:last-child {
            color: var(--forest);
            font-size: 14px;
            font-weight: 700;
        }

        .price {
            margin-bottom: 20px;
            color: var(--forest);
            font-size: 25px;
            font-weight: 800;
        }

        .price span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .rent-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 20px;
            border: none;
            border-radius: 9px;
            background: var(--forest);
            color: white;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .rent-button:hover {
            background: var(--forest-dark);
        }

        .rent-button.disabled {
            background: #e8e8e2;
            color: #898c84;
            cursor: not-allowed;
        }

        .login-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 18px;
            border: 1px solid var(--forest);
            border-radius: 9px;
            color: var(--forest);
            font-size: 12px;
            font-weight: 700;
            transition: .2s ease;
        }

        .login-button:hover {
            background: var(--cream);
        }

        .section {
            margin-top: 38px;
        }

        .section-title {
            margin-bottom: 6px;
            font-size: 18px;
            font-weight: 800;
        }

        .section-sub {
            margin-bottom: 18px;
            color: var(--muted);
            font-size: 12px;
        }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            margin-top: 38px;
            align-items: start;
        }

        .two-col .section {
            margin-top: 0;
            display: flex;
            flex-direction: column;
        }

        .panel {
            height: auto;
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--white);
        }

        .spec-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .spec-table tr+tr td {
            border-top: 1px solid var(--border);
        }

        .spec-table td {
            padding: 12px 0;
        }

        .spec-table td:first-child {
            width: 42%;
            color: var(--muted);
        }

        .spec-table td:last-child {
            color: var(--text);
            font-weight: 600;
        }

        .status-pill {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            background: #edf1e8;
            color: var(--forest);
            font-size: 11px;
            font-weight: 700;
        }

        .status-pill.off {
            background: #efeee8;
            color: #898c84;
        }

        .check-list {
            list-style: none;
        }

        .check-list li {
            position: relative;
            padding: 11px 0 11px 28px;
            color: var(--text);
            font-size: 13px;
            line-height: 1.7;
        }

        .check-list li+li {
            border-top: 1px solid var(--border);
        }

        .check-list li::before {
            content: "";
            position: absolute;
            left: 2px;
            top: 15px;
            width: 12px;
            height: 7px;
            border-left: 2px solid var(--forest);
            border-bottom: 2px solid var(--forest);
            transform: rotate(-45deg);
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .step {
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--cream);
        }

        .step-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            margin-bottom: 14px;
            border-radius: 50%;
            background: var(--forest);
            color: white;
            font-size: 13px;
            font-weight: 700;
        }

        .step h3 {
            margin-bottom: 6px;
            font-size: 14px;
        }

        .step p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
        }

        .related-card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--white);
            transition: border-color .15s;
        }

        .related-card:hover {
            border-color: var(--forest);
        }

        .related-img {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 140px;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .related-img img {
            width: 100%;
            height: 100%;
            padding: 8px;
            object-fit: contain;
        }

        .related-img span {
            color: var(--muted);
            font-size: 11px;
        }

        .related-body {
            padding: 14px;
        }

        .related-body h3 {
            margin-bottom: 6px;
            font-size: 13px;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .related-body p {
            color: var(--forest);
            font-size: 13px;
            font-weight: 800;
        }

        .related-body small {
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
        }

        /* Footer */
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

            .two-col,
            .steps {
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

            .page-title {
                font-size: 20px;
            }

            .detail-card {
                grid-template-columns: 1fr;
                gap: 25px;
                padding: 16px;
            }

            .image-box {
                min-height: 250px;
            }

            .image-box img {
                height: 250px;
            }

            .detail-info h2 {
                font-size: 25px;
            }

            .two-col {
                gap: 28px;
            }

            .panel {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
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

        <div class="topbar">
            <a href="{{ url('/') }}#daftar-barang"
               class="btn-back"
               aria-label="Kembali"
               title="Kembali">
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

            <h1 class="page-title">Detail Barang</h1>
        </div>

        <section class="detail-card">

            <div class="image-box">
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

            <div class="detail-info">

                <span class="category">
                    {{ $barang->kategori->nama_kategori ?? 'Tanpa kategori' }}
                </span>

                <h2>{{ $barang->nama_barang }}</h2>

                <p class="description-title">Deskripsi Barang</p>

                <p class="description">
                    {{ $barang->deskripsi ?: 'Belum ada deskripsi untuk barang ini.' }}
                </p>

                <div class="info-list">
                    <div class="info-item">
                        <p>Stok Tersedia</p>
                        <p>{{ $barang->stok }} unit</p>
                    </div>

                    <div class="info-item">
                        <p>Status Barang</p>
                        <p>{{ ucfirst($barang->status) }}</p>
                    </div>
                </div>

                <p class="price">
                    Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}
                    <span>/ hari</span>
                </p>

                <div class="actions">

                    @auth
                        @if (Auth::user()->role === 'pelanggan')
                            @if ($barang->stok > 0)
                                <a
                                    href="{{ route('penyewaan.create', $barang->id_barang) }}"
                                    class="rent-button"
                                >
                                    Sewa Barang →
                                </a>
                            @else
                                <span class="rent-button disabled">
                                    Stok Habis
                                </span>
                            @endif
                        @else
                            <span class="rent-button disabled">
                                Khusus Pelanggan
                            </span>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="rent-button">
                            Login untuk Menyewa →
                        </a>

                        <a href="{{ route('register') }}" class="login-button">
                            Daftar Akun
                        </a>
                    @endauth

                </div>

            </div>

        </section>

        <div class="two-col">

            <section class="section">
                <h2 class="section-title">Rincian Barang</h2>
                <p class="section-sub">Informasi lengkap barang yang tersedia untuk disewa.</p>

                <div class="panel">
                    <table class="spec-table">
                        <tr>
                            <td>Nama barang</td>
                            <td>{{ $barang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>{{ $barang->kategori->nama_kategori ?? 'Tanpa kategori' }}</td>
                        </tr>
                        <tr>
                            <td>Harga sewa</td>
                            <td>Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }} / hari</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>{{ $barang->stok }} unit</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <span class="status-pill {{ $barang->stok > 0 ? '' : 'off' }}">
                                    {{ $barang->stok > 0 ? ucfirst($barang->status) : 'Stok habis' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>

            <section class="section">
                <h2 class="section-title">Ketentuan Sewa</h2>
                <p class="section-sub">Baca sebelum menyewa agar proses berjalan lancar.</p>

                <div class="panel">
                    <ul class="check-list">
                        <li>Barang harus dikembalikan sesuai tanggal yang disepakati.</li>
                        <li>Periksa kondisi barang saat pengambilan dan pengembalian.</li>
                        <li>Kerusakan atau kehilangan menjadi tanggung jawab penyewa.</li>
                        <li>Keterlambatan pengembalian dapat dikenakan denda.</li>
                        <li>Bawa identitas asli saat mengambil barang.</li>
                    </ul>
                </div>
            </section>

        </div>

        <section class="section">
            <h2 class="section-title">Cara Menyewa</h2>
            <p class="section-sub">Tiga langkah mudah sampai barang siap kamu bawa.</p>

            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Isi form penyewaan</h3>
                    <p>Pilih jumlah barang, tanggal mulai, dan lama sewa.</p>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Tunggu konfirmasi</h3>
                    <p>Admin memeriksa pesananmu dan memastikan stok tersedia.</p>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Ambil barang</h3>
                    <p>Selesaikan pembayaran dan datang ke lokasi sesuai tanggal sewa.</p>
                </div>
            </div>
        </section>

        @isset($barangTerkait)
            @if ($barangTerkait->count())
                <section class="section">
                    <h2 class="section-title">Barang Lain di Kategori Ini</h2>
                    <p class="section-sub">Lengkapi perlengkapan campingmu.</p>

                    <div class="related-grid">
                        @foreach ($barangTerkait as $item)
                            <a href="{{ route('barang.detail', $item->id_barang) }}" class="related-card">
                                <div class="related-img">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama_barang }}">
                                    @else
                                        <span>Foto belum tersedia</span>
                                    @endif
                                </div>

                                <div class="related-body">
                                    <h3>{{ $item->nama_barang }}</h3>
                                    <p>
                                        Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                                        <small>/ hari</small>
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        @endisset

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