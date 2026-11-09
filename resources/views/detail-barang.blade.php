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
            background: var(--white);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 2px solid var(--forest);
            outline-offset: 2px;
        }

        /* Navbar Sesuai Home */
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
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--white);
            color: var(--forest);
            transition: .2s ease;
        }

        .btn-back:hover {
            background: var(--cream);
        }

        .btn-back svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
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
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--white);
            height: auto;
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

        /* Footer Sesuai Home */
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
        }

        @media (max-width: 800px) {
            .two-col,
            .steps {
                grid-template-columns: 1fr;
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

            .container {
                padding: 30px 18px 50px;
            }

            .topbar {
                gap: 11px;
                margin-bottom: 22px;
            }

            .btn-back {
                width: 39px;
                height: 39px;
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

    <main class="container">

        <div class="topbar">
            <a href="{{ url('/') }}#daftar-barang" class="btn-back" aria-label="Kembali">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M19 12H5" />
                    <path d="m12 19-7-7 7-7" />
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

</body>

</html>