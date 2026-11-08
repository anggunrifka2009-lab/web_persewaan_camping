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
            --text: #26392e;
            --muted: #7b817a;
            --border: #e4e2d9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            min-height: 100vh;
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

        .navbar {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            width: 100%;
            padding: 18px 6%;
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
            letter-spacing: -0.8px;
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
        }

        .nav-link {
            padding: 10px 12px;
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--forest);
        }

        .nav-form {
            flex-shrink: 0;
            margin: 0;
        }

        .nav-button {
            padding: 10px 17px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .nav-button:hover {
            border-color: var(--forest);
            color: var(--forest);
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
            transition: background 0.2s;
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
                    rgba(19, 49, 35, 0.94),
                    rgba(26, 61, 43, 0.76)
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
            border: 1px solid rgba(255, 255, 255, 0.28);
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
            transition: transform 0.2s;
        }

        .hero-primary:hover {
            transform: translateY(-2px);
        }

        .hero-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 19px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 10px;
            color: white;
            font-size: 13px;
            font-weight: 600;
        }

        .hero-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
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

        .btn-search {
            min-width: 65px;
            min-height: 40px;
            padding: 10px 14px;
            border: 0;
            border-radius: 9px;
            background: #eaf0e8;
            color: var(--forest);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-search:hover {
            background: #dce8d9;
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
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(38, 57, 46, 0.08);
        }

        .product-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 17px 18px 0;
        }

        .product-category {
            max-width: 70%;
            overflow: hidden;
            padding: 7px 10px;
            border-radius: 7px;
            background: #edf1e8;
            color: var(--forest);
            font-size: 11px;
            font-weight: 600;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-code {
            color: var(--muted);
            font-size: 10px;
            overflow-wrap: anywhere;
            text-align: right;
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

        .rent-btn.disabled {
            background: #e8e8e2;
            color: #898c84;
            cursor: not-allowed;
        }

        .rent-login {
            color: var(--forest);
            font-size: 11px;
            font-weight: 700;
            line-height: 1.6;
            text-align: right;
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
                padding-right: 4%;
                padding-left: 4%;
            }

            .hero {
                padding: 65px 5%;
            }

            .benefits {
                padding-right: 5%;
                padding-left: 5%;
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
                flex-wrap: wrap;
                gap: 13px;
                padding: 16px 5%;
            }

            .brand {
                font-size: 21px;
            }

            .brand-icon {
                font-size: 26px;
            }

            .nav-menu {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
                gap: 9px;
                padding-top: 3px;
            }

            .nav-link {
                padding: 9px 10px;
                font-size: 12px;
            }

            .nav-button,
            .nav-cta {
                padding: 10px 13px;
                font-size: 12px;
            }

            .hero {
                padding: 53px 6%;
                background-position: 60% center;
            }

            .hero-label {
                margin-bottom: 18px;
                font-size: 9px;
                letter-spacing: 1px;
            }

            .hero h1 {
                font-size: 37px;
                letter-spacing: -1.5px;
            }

            .hero p {
                font-size: 13px;
                line-height: 1.8;
            }

            .benefits {
                grid-template-columns: minmax(0, 1fr);
                gap: 18px;
                padding: 23px 6%;
            }

            .container {
                padding: 42px 18px 50px;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

            .toolbar {
                align-items: flex-start;
                flex-direction: column;
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

            .product-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 15px;
            }

            .product-illustration {
                height: 220px;
            }
        }

        @media (max-width: 380px) {
            .navbar {
                padding-right: 13px;
                padding-left: 13px;
            }

            .nav-menu {
                gap: 6px;
            }

            .nav-link {
                padding: 9px 7px;
            }

            .hero {
                padding: 45px 6%;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .hero-primary,
            .hero-secondary {
                text-align: center;
            }

            .container {
                padding-right: 13px;
                padding-left: 13px;
            }

            .product-info {
                padding-right: 14px;
                padding-left: 14px;
            }

            .product-bottom {
                gap: 8px;
            }

            .price {
                font-size: 15px;
            }

            .rent-btn {
                padding: 10px;
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
            @if (Auth::user()->role === 'pelanggan')
                <a href="{{ route('penyewaan.riwayat') }}" class="nav-link">
                    Riwayat Penyewaan
                </a>
            @endif

            <a href="{{ route('akun.index') }}" class="nav-link">
                Informasi Akun
            </a>

            <form action="{{ route('logout') }}" method="POST" class="nav-form">
                @csrf
                <button type="submit" class="nav-button">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <a href="{{ route('register') }}" class="nav-cta">Daftar Sekarang</a>
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
            <p>
                Temukan perlengkapan yang kamu butuhkan untuk petualangan berikutnya.
            </p>
        </div>

        <div class="product-count" id="jumlah-barang">
            {{ $barang->count() }} barang terdaftar
        </div>
    </div>

    <div class="toolbar">
        <div class="toolbar-title">Daftar perlengkapan camping</div>

        <form action="{{ url('/') }}"
              method="GET"
              id="form-pencarian"
              class="filter-form">

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

                <h3>
                    @if (!empty($kategoriDipilih) || !empty($cari))
                        Barang tidak ditemukan
                    @else
                        Belum ada alat camping
                    @endif
                </h3>

                <p>
                    @if (!empty($kategoriDipilih) || !empty($cari))
                        Coba gunakan kata kunci atau kategori yang berbeda.
                    @else
                        Daftar perlengkapan akan ditampilkan di sini setelah tersedia.
                    @endif
                </p>
            </div>
        @else
            <div class="product-grid">
                @foreach ($barang as $item)
                    <article class="product-card">

                        <div class="product-top">
                            <span class="product-category">
                                {{ $item->kategori->nama_kategori ?? 'Tanpa kategori' }}
                            </span>

                            <span class="product-code">
                                {{ $item->kode_barang }}
                            </span>
                        </div>

                        <div class="product-illustration">
                            @if ($item->foto)
                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="Foto {{ $item->nama_barang }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                >

                                <span class="no-image" style="display: none;">
                                    Foto tidak dapat ditampilkan
                                </span>
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
                                <p class="stock empty">
                                    Stok sedang habis
                                </p>
                            @endif

                            <div class="product-bottom">
                                <div>
                                    <p class="price-label">Harga sewa</p>

                                    <p class="price">
                                        Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                                        <span>/ hari</span>
                                    </p>
                                </div>

                                @auth
                                    @if (Auth::user()->role === 'pelanggan')
                                        @if ($item->stok > 0)
                                            <a
                                                href="{{ route('penyewaan.create', $item->id_barang) }}"
                                                class="rent-btn"
                                            >
                                                Sewa →
                                            </a>
                                        @else
                                            <span class="rent-btn disabled">
                                                Stok Habis
                                            </span>
                                        @endif
                                    @else
                                        <span class="product-code">
                                            Khusus pelanggan
                                        </span>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="rent-login">
                                        Login untuk<br>menyewa →
                                    </a>
                                @endauth
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
document.addEventListener('DOMContentLoaded', function () {
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

        const kataKunci = input.value.trim();
        const kategori = filterKategori.value;

        if (kataKunci !== '') {
            url.searchParams.set('cari', kataKunci);
        }

        if (kategori !== '') {
            url.searchParams.set('kategori', kategori);
        }

        try {
            const response = await fetch(url.toString(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                },
                signal: controller.signal
            });

            if (!response.ok) {
                throw new Error('Pencarian gagal. Status: ' + response.status);
            }

            const html = await response.text();
            const dokumen = new DOMParser().parseFromString(html, 'text/html');

            const hasilBaru = dokumen.querySelector('#hasil-barang');
            const jumlahBaru = dokumen.querySelector('#jumlah-barang');

            if (!hasilBaru || !jumlahBaru) {
                throw new Error('Elemen hasil pencarian tidak ditemukan.');
            }

            hasil.innerHTML = hasilBaru.innerHTML;
            jumlahBarang.innerHTML = jumlahBaru.innerHTML;

            window.history.replaceState({}, '', url.toString());

        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('Pencarian barang gagal:', error);
            }
        }
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        clearTimeout(timer);
        cariBarang();
    });

    input.addEventListener('input', function () {
        clearTimeout(timer);

        timer = setTimeout(function () {
            cariBarang();
        }, 300);
    });

    filterKategori.addEventListener('change', function () {
        clearTimeout(timer);
        cariBarang();
    });

    tombolReset.addEventListener('click', function () {
        clearTimeout(timer);

        if (controller) {
            controller.abort();
            controller = null;
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