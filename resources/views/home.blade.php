<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampRent - Persewaan Alat Camping</title>

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

        html {
            scroll-padding-top: 90px;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--white);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select {
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
            flex-shrink: 0;
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

        .hero {
            position: relative;
            overflow: hidden;
            padding: 78px 6%;
            background:
                linear-gradient(
                    90deg,
                    rgba(19, 49, 35, .94),
                    rgba(26, 61, 43, .76)
                ),
                url('https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=1800&q=85')
                center 55% / cover;
            color: white;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 720px;
        }

        .hero-label {
            display: inline-block;
            margin-bottom: 22px;
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, .28);
            border-radius: 30px;
            color: #e2eadf;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.3px;
        }

        .hero h1 {
            max-width: 650px;
            margin-bottom: 20px;
            font-size: clamp(34px, 5.2vw, 58px);
            line-height: 1.14;
            letter-spacing: -2px;
        }

        .hero h1 span {
            color: #d5dfc8;
        }

        .hero p {
            max-width: 530px;
            margin-bottom: 29px;
            color: #e3e9df;
            font-size: 15px;
            line-height: 1.9;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 13px;
        }

        .hero-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 20px;
            border-radius: 10px;
            background: var(--white);
            color: var(--forest);
            font-size: 13px;
            font-weight: 700;
            transition: transform .2s;
        }

        .hero-primary:hover {
            transform: translateY(-2px);
        }

        .hero-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 19px;
            border: 1px solid rgba(255, 255, 255, .4);
            border-radius: 10px;
            color: white;
            font-size: 13px;
            font-weight: 600;
        }

        .hero-secondary:hover {
            background: rgba(255, 255, 255, .1);
        }

        .benefits {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            padding: 27px 6%;
            border-bottom: 1px solid var(--border);
            background: var(--white);
        }

        .benefit {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .benefit-icon {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #edf1e8;
            color: var(--forest);
            font-size: 20px;
        }

        .benefit h3 {
            margin-bottom: 5px;
            font-size: 13px;
            line-height: 1.5;
        }

        .benefit p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .container {
            flex: 1;
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 60px 28px 70px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 27px;
        }

        .section-label {
            margin-bottom: 9px;
            color: var(--forest);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
        }

        .section-header h2 {
            margin-bottom: 9px;
            font-size: clamp(24px, 3vw, 32px);
            letter-spacing: -1px;
        }

        .section-header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .product-count {
            flex-shrink: 0;
            padding: 9px 13px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--muted);
            font-size: 12px;
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

        .btn-reset {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 10px 13px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-reset:hover {
            background: #f4f2eb;
            color: var(--forest);
        }

        .empty-state {
            padding: 48px 20px;
            border: 1px dashed #cbd2c5;
            border-radius: 16px;
            background: var(--cream);
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 14px;
            font-size: 34px;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            font-size: 18px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            transition: transform .2s, box-shadow .2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(38, 57, 46, .08);
        }

        .product-illustration {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
            margin: 15px 18px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #ffffff;
        }

        .product-illustration img {
            display: block;
            width: 100%;
            height: 100%;
            padding: 8px;
            object-fit: contain;
        }

        .no-image {
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        .product-info {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding: 0 18px 18px;
        }

        .product-info h3 {
            margin-bottom: 9px;
            font-size: 16px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .stock {
            margin-bottom: 17px;
            color: var(--muted);
            font-size: 12px;
        }

        .stock.available {
            color: var(--forest);
        }

        .stock.empty {
            color: #a52f2f;
        }

        .product-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .price-label {
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 10px;
        }

        .price {
            color: var(--forest);
            font-size: 17px;
            font-weight: 800;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .price span {
            font-size: 10px;
            font-weight: 500;
        }

        .rent-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            padding: 10px 12px;
            border-radius: 8px;
            background: var(--forest);
            color: white;
            font-size: 11px;
            font-weight: 700;
            text-align: center;
        }

        .rent-btn:hover {
            background: var(--forest-dark);
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

            .hero {
                padding: 65px 5%;
            }

            .benefits {
                padding-right: 5%;
                padding-left: 5%;
                grid-template-columns: 1fr;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .filter-form {
                width: 100%;
                max-width: none;
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

            .hero {
                padding: 53px 6%;
            }

            .hero h1 {
                font-size: 37px;
            }

            .product-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 15px;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-form {
                align-items: stretch;
            }

            .filter-form select {
                flex: 1 1 100%;
                width: 100%;
            }

            .search-form {
                flex: 1 1 100%;
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

    <section class="hero">
        <div class="hero-content">
            <div class="hero-label">YOUR CAMPING ADVENTURE STARTS HERE</div>

            <h1>
                Petualangan seru dimulai dari
                <span>perlengkapan yang tepat.</span>
            </h1>

            <p>
                Temukan dan sewa perlengkapan camping sesuai kebutuhanmu.
                Lebih praktis untuk mempersiapkan perjalanan dan menikmati alam.
            </p>

            <div class="hero-actions">
                <a href="#daftar-barang" class="hero-primary">
                    Jelajahi Perlengkapan →
                </a>

                @guest
                    <a href="{{ route('register') }}" class="hero-secondary">
                        Buat Akun
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <section class="benefits">
        <div class="benefit">
            <div class="benefit-icon">⌂</div>
            <div>
                <h3>Perlengkapan Camping</h3>
                <p>Pilihan alat untuk menemani perjalananmu.</p>
            </div>
        </div>

        <div class="benefit">
            <div class="benefit-icon">✓</div>
            <div>
                <h3>Proses Praktis</h3>
                <p>Lihat barang dan harga sewa dalam satu halaman.</p>
            </div>
        </div>

        <div class="benefit">
            <div class="benefit-icon">♧</div>
            <div>
                <h3>Siap Berpetualang</h3>
                <p>Persiapkan kebutuhan sebelum berangkat.</p>
            </div>
        </div>
    </section>

    <main class="container" id="daftar-barang">

        <div class="section-header">
            <div>
                <div class="section-label">CAMPING ESSENTIALS</div>
                <h2>Daftar Alat Camping</h2>
                <p>Temukan perlengkapan yang kamu butuhkan untuk petualangan berikutnya.</p>
            </div>

            <div class="product-count" id="jumlah-barang">
                {{ $barang->count() }} barang terdaftar
            </div>
        </div>

        <div class="toolbar">
            <div class="toolbar-title">Daftar perlengkapan camping</div>

            <form action="{{ url('/') }}" method="GET" id="form-pencarian" class="filter-form">
                <select name="kategori" id="filter-kategori" aria-label="Pilih kategori">
                    <option value="">Semua Kategori</option>

                    @foreach ($kategori as $itemKategori)
                        <option
                            value="{{ $itemKategori->id_kategori }}"
                            @selected((string) ($kategoriDipilih ?? '') === (string) $itemKategori->id_kategori)
                        >
                            {{ $itemKategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                <div class="search-form">
                    <input
                        type="text"
                        name="cari"
                        id="cari-barang"
                        placeholder="Cari nama barang..."
                        value="{{ $cari ?? request('cari') }}"
                        autocomplete="off"
                    >
                </div>

                <button type="button" class="btn-reset" id="btn-reset">
                    Reset
                </button>
            </form>
        </div>

        <div id="hasil-barang">
            @if ($barang->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">⌂</div>
                    <h3>Barang tidak ditemukan</h3>
                    <p>Coba gunakan kata kunci atau kategori yang berbeda.</p>
                </div>
            @else
                <div class="product-grid">
                    @foreach ($barang as $item)
                        <article class="product-card">
                            <div class="product-illustration">
                                @if ($item->foto)
                                    <img
                                        src="{{ asset('storage/' . $item->foto) }}"
                                        alt="Foto {{ $item->nama_barang }}"
                                        loading="lazy"
                                    >
                                @else
                                    <span class="no-image">Foto belum tersedia</span>
                                @endif
                            </div>

                            <div class="product-info">
                                <h3>{{ $item->nama_barang }}</h3>

                                @if ($item->stok > 0)
                                    <p class="stock available">
                                        ✓ Stok tersedia: {{ $item->stok }}
                                    </p>
                                @else
                                    <p class="stock empty">Stok sedang habis</p>
                                @endif

                                <div class="product-bottom">
                                    <div>
                                        <p class="price-label">Harga sewa</p>
                                        <p class="price">
                                            Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                                            <span>/ hari</span>
                                        </p>
                                    </div>

                                    <a href="{{ route('barang.detail', $item->id_barang) }}" class="rent-btn">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>

    </main>

    <footer class="footer">
        <strong>⌁ CampRent</strong>
        <p>Sistem Informasi Persewaan Alat Camping</p>
        <p>Siapkan perlengkapanmu, nikmati petualanganmu.</p>
    </footer>

    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }

        if (window.location.hash === '#daftar-barang') {
            setTimeout(function() {
                history.replaceState(null, null, window.location.pathname + window.location.search);
            }, 100);
        } else {
            window.scrollTo(0, 0);
        }

        document.addEventListener('DOMContentLoaded', function () {

            const dropdown = document.getElementById('accountDropdown');
            const toggle = document.getElementById('account-toggle');

            if (dropdown && toggle) {
                toggle.addEventListener('click', function (event) {
                    event.stopPropagation();

                    const isOpen = dropdown.classList.toggle('show');
                    toggle.setAttribute('aria-expanded', isOpen);
                });

                document.addEventListener('click', function (event) {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        dropdown.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                        toggle.focus();
                    }
                });
            }

            const form = document.getElementById('form-pencarian');
            const input = document.getElementById('cari-barang');
            const filterKategori = document.getElementById('filter-kategori');
            const tombolReset = document.getElementById('btn-reset');
            const hasil = document.getElementById('hasil-barang');
            const jumlahBarang = document.getElementById('jumlah-barang');

            const hasilAwal = hasil.innerHTML;
            const jumlahAwal = jumlahBarang.innerHTML;

            let timer = null;
            let controller = null;

            async function cariBarang() {
                if (controller) {
                    controller.abort();
                }

                controller = new AbortController();

                const url = new URL(form.action, window.location.origin);

                if (input.value.trim() !== '') {
                    url.searchParams.set('cari', input.value.trim());
                }

                if (filterKategori.value !== '') {
                    url.searchParams.set('kategori', filterKategori.value);
                }

                try {
                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        },
                        signal: controller.signal
                    });

                    if (!response.ok) {
                        throw new Error('Gagal memuat');
                    }

                    const html = await response.text();
                    const dokumen = new DOMParser().parseFromString(html, 'text/html');

                    const hasilBaru = dokumen.querySelector('#hasil-barang');
                    const jumlahBaru = dokumen.querySelector('#jumlah-barang');

                    if (!hasilBaru || !jumlahBaru) {
                        throw new Error('Struktur hasil pencarian tidak ditemukan');
                    }

                    hasil.innerHTML = hasilBaru.innerHTML;
                    jumlahBarang.innerHTML = jumlahBaru.innerHTML;

                    window.history.replaceState({}, '', url.toString());

                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error(error);
                    }
                }
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                clearTimeout(timer);
                cariBarang();
            });

            input.addEventListener('input', function() {
                clearTimeout(timer);
                timer = setTimeout(cariBarang, 300);
            });

            filterKategori.addEventListener('change', function() {
                clearTimeout(timer);
                cariBarang();
            });

            tombolReset.addEventListener('click', function() {
                clearTimeout(timer);

                if (controller) {
                    controller.abort();
                }

                input.value = '';
                filterKategori.value = '';

                hasil.innerHTML = hasilAwal;
                jumlahBarang.innerHTML = jumlahAwal;

                window.history.replaceState({}, '', form.action);
            });
        });
    </script>

</body>
</html>