
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CampRent</title>

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

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { min-height: 100vh; background: var(--cream); color: var(--text); font-family: 'Inter', sans-serif; }
        a { color: inherit; text-decoration: none; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 10;
            display: flex;
            flex-direction: column;
            width: 250px;
            padding: 28px 18px 20px;
            background: var(--white);
            border-right: 1px solid var(--border);
        }
        .brand { display: flex; align-items: center; gap: 11px; padding: 0 12px 30px; color: var(--forest); font-size: 23px; font-weight: 800; letter-spacing: -0.8px; }
        .brand-icon { display: grid; place-items: center; width: 39px; height: 39px; border-radius: 12px; background: var(--forest); color: white; font-size: 23px; }
        .sidebar-label { padding: 0 12px; margin-bottom: 11px; color: #92968e; font-size: 10px; font-weight: 800; letter-spacing: 1.5px; }
        .nav-menu { display: grid; gap: 6px; }
        .nav-link { display: flex; align-items: center; gap: 13px; min-height: 46px; padding: 12px 14px; border-radius: 11px; color: #69736a; font-size: 13px; font-weight: 600; transition: .2s; }
        .nav-link:hover, .nav-link.active { background: #eaf0e8; color: var(--forest); }
        .nav-icon { display: grid; place-items: center; width: 22px; font-size: 18px; }
        .sidebar-bottom { margin-top: auto; padding-top: 18px; border-top: 1px solid var(--border); }
        .admin-info { display: flex; align-items: center; gap: 11px; padding: 10px 9px 16px; }
        .avatar { display: grid; flex-shrink: 0; place-items: center; width: 38px; height: 38px; border-radius: 50%; background: #e7eee4; color: var(--forest); font-size: 15px; font-weight: 800; }
        .admin-name { overflow: hidden; color: var(--text); font-size: 12px; font-weight: 700; text-overflow: ellipsis; white-space: nowrap; }
        .admin-role { margin-top: 4px; color: var(--muted); font-size: 11px; }
        .logout-form { margin: 0; }
        .logout-btn { display: flex; align-items: center; gap: 12px; width: 100%; padding: 12px 14px; border: 0; border-radius: 10px; background: transparent; color: #8a5149; font: inherit; font-size: 13px; font-weight: 600; text-align: left; cursor: pointer; }
        .logout-btn:hover { background: #f8eeeb; }

        .main { min-height: 100vh; margin-left: 250px; padding: 32px 38px 28px; }
        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 30px; }
        .page-title { color: var(--text); font-size: 23px; font-weight: 800; letter-spacing: -.6px; }
        .page-subtitle { margin-top: 7px; color: var(--muted); font-size: 12px; line-height: 1.7; }
        .topbar-account { display: flex; align-items: center; gap: 10px; padding: 9px 13px; border: 1px solid var(--border); border-radius: 12px; background: var(--white); color: var(--text); font-size: 12px; font-weight: 600; transition: .2s; }
        .topbar-account:hover { border-color: #b9c8b8; color: var(--forest); }
        .account-symbol { font-size: 17px; }

        .welcome { position: relative; overflow: hidden; margin-bottom: 30px; padding: 32px; border-radius: 18px; background: var(--forest); color: white; }
        .welcome::before, .welcome::after { position: absolute; border: 1px solid rgba(255,255,255,.13); border-radius: 50%; content: ''; pointer-events: none; }
        .welcome::before { top: -55px; right: -5px; width: 210px; height: 210px; }
        .welcome::after { top: -20px; right: 55px; width: 135px; height: 135px; }
        .eyebrow { margin-bottom: 11px; color: #d9e5d9; font-size: 10px; font-weight: 700; letter-spacing: 1.8px; }
        .welcome h2 { position: relative; z-index: 1; margin-bottom: 10px; font-size: clamp(23px, 3vw, 31px); letter-spacing: -.8px; }
        .welcome p:last-child { position: relative; z-index: 1; max-width: 570px; color: #e4e9df; font-size: 13px; line-height: 1.8; }

        .section-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 15px; margin-bottom: 17px; }
        .section-heading h3 { margin-bottom: 6px; font-size: 17px; letter-spacing: -.3px; }
        .section-heading p { color: var(--muted); font-size: 12px; line-height: 1.7; }
        .section-link { flex-shrink: 0; color: var(--forest); font-size: 12px; font-weight: 700; }
        .section-link:hover { text-decoration: underline; }

        .stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; margin-bottom: 32px; }
        .stat-card { min-width: 0; padding: 20px; border: 1px solid var(--border); border-radius: 14px; background: var(--white); }
        .stat-label { color: var(--muted); font-size: 11px; line-height: 1.6; }
        .stat-value { margin-top: 10px; color: var(--forest); font-size: clamp(20px, 2vw, 27px); font-weight: 800; letter-spacing: -.7px; overflow-wrap: anywhere; }
        .stat-note { margin-top: 7px; color: var(--muted); font-size: 10px; line-height: 1.6; }

        .table-wrap { overflow-x: auto; border: 1px solid var(--border); border-radius: 15px; background: var(--white); }
        .rental-table { width: 100%; border-collapse: collapse; text-align: left; }
        .rental-table th { padding: 15px 17px; background: #f9f8f2; color: #737b70; font-size: 10px; font-weight: 800; letter-spacing: .4px; white-space: nowrap; }
        .rental-table td { padding: 16px 17px; border-top: 1px solid var(--border); color: var(--text); font-size: 11px; line-height: 1.8; vertical-align: top; }
        .rental-table tbody tr:hover { background: #fcfbf7; }
        .rental-code { color: var(--forest); font-weight: 800; white-space: nowrap; }
        .rental-customer { font-weight: 600; }
        .rental-items { min-width: 140px; max-width: 230px; }
        .rental-date { white-space: nowrap; }
        .status { display: inline-block; padding: 5px 9px; border-radius: 20px; font-size: 10px; font-weight: 700; white-space: nowrap; }
        .status-menunggu { background: #fff2d7; color: #94661c; }
        .status-disetujui { background: #e6eefb; color: #345d99; }
        .status-dibayar { background: #e5f2e7; color: #2d7041; }
        .status-dikembalikan { background: #e8eee8; color: #315b3d; }
        .status-ditolak { background: #f8e7e4; color: #984c43; }
        .status-default { background: #eeeee9; color: #666b62; }
        .empty-state { padding: 35px 20px; color: var(--muted); text-align: center; font-size: 12px; line-height: 1.8; }
        .menu { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .menu-card { display: flex; align-items: flex-start; gap: 15px; min-width: 0; padding: 22px; border: 1px solid var(--border); border-radius: 15px; background: var(--white); transition: transform .2s, box-shadow .2s, border-color .2s; }
        .menu-card:hover { transform: translateY(-3px); border-color: #c4d2c4; box-shadow: 0 12px 28px rgba(38,57,46,.07); }
        .menu-icon { display: grid; flex-shrink: 0; place-items: center; width: 46px; height: 46px; border-radius: 12px; background: #eaf0e8; color: var(--forest); font-size: 21px; }
        .menu-content { min-width: 0; }
        .menu-content h4 { margin: 3px 0 8px; font-size: 14px; font-weight: 700; }
        .menu-content p { color: var(--muted); font-size: 12px; line-height: 1.8; }
        .menu-arrow { margin-top: 12px; color: var(--forest); font-size: 11px; font-weight: 700; }
        .footer { margin-top: 35px; padding-top: 18px; border-top: 1px solid #e0ddd3; color: var(--muted); font-size: 11px; line-height: 1.7; }

        @media (max-width: 1100px) {
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 900px) {
            .sidebar { width: 215px; padding-right: 13px; padding-left: 13px; }
            .main { margin-left: 215px; padding: 28px 24px; }
            .menu { grid-template-columns: 1fr; }
            .rental-table th, .rental-table td { padding: 13px 12px; }
        }
        @media (max-width: 620px) {
            .sidebar { position: relative; inset: auto; width: 100%; padding: 15px 16px 13px; border-right: 0; border-bottom: 1px solid var(--border); }
            .brand { padding: 0 4px 15px; font-size: 21px; }
            .sidebar-label { margin: 0 4px 8px; }
            .nav-menu { display: flex; gap: 7px; overflow-x: auto; padding-bottom: 3px; }
            .nav-link { flex: 0 0 auto; min-height: 40px; gap: 8px; padding: 10px 12px; font-size: 12px; white-space: nowrap; }
            .nav-icon { font-size: 16px; }
            .sidebar-bottom { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 13px; padding-top: 11px; }
            .admin-info { min-width: 0; padding: 0 4px; }
            .logout-btn { width: auto; padding: 10px; white-space: nowrap; }
            .main { margin-left: 0; padding: 24px 17px; }
            .topbar { align-items: flex-start; margin-bottom: 22px; }
            .page-title { font-size: 21px; }
            .topbar-account { padding: 9px 10px; font-size: 0; }
            .account-symbol { font-size: 17px; }
            .welcome { margin-bottom: 25px; padding: 26px 22px; border-radius: 15px; }
            .welcome::before { right: -90px; }
            .welcome::after { right: -35px; }
            .stats { gap: 10px; margin-bottom: 26px; }
            .stat-card { padding: 15px; }
            .stat-value { font-size: 22px; }
            .section-heading { align-items: flex-start; }
            .rental-table { min-width: 680px; }
            .menu { gap: 12px; }
            .menu-card { padding: 18px; }
            .footer { margin-top: 28px; }
        }
        @media (max-width: 360px) {
            .main { padding-right: 12px; padding-left: 12px; }
            .menu-card { gap: 11px; padding: 15px; }
            .menu-icon { width: 40px; height: 40px; }
            .admin-name { max-width: 130px; }
            .stats { grid-template-columns: 1fr; }
            .section-heading { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-icon">⌁</span>
            <span>CampRent</span>
        </a>

        <p class="sidebar-label">MENU UTAMA</p>
        <nav class="nav-menu" aria-label="Navigasi admin">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <span class="nav-icon">▦</span><span>Dashboard</span>
            </a>
            <a href="{{ route('kategori.index') }}" class="nav-link">
                <span class="nav-icon">▤</span><span>Kategori</span>
            </a>
            <a href="{{ route('barang.index') }}" class="nav-link">
                <span class="nav-icon">⌂</span><span>Barang</span>
            </a>
            <a href="{{ route('admin.penyewaan.index') }}" class="nav-link">
                <span class="nav-icon">▣</span><span>Penyewaan</span>
            </a>
            <a href="{{ route('admin.laporan.index') }}" class="nav-link">
                <span class="nav-icon">▥</span><span>Laporan</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ route('akun.index') }}" class="admin-info">
                <span class="avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</span>
                <span style="min-width:0">
                    <span class="admin-name" style="display:block">{{ Auth::user()->nama }}</span>
                    <span class="admin-role" style="display:block">Administrator</span>
                </span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn"><span class="nav-icon">↪</span><span>Logout</span></button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Ringkasan dan aktivitas terbaru CampRent.</p>
            </div>
        </header>

        <section class="welcome">
            <p class="eyebrow">ADMINISTRATION PANEL</p>
            <h2>Selamat datang, {{ Auth::user()->nama }}!</h2>
            <p>Pantau aktivitas penyewaan dan ringkasan laporan CampRent dari satu halaman. Untuk data lengkap, buka menu Penyewaan atau Laporan.</p>
        </section>

        <section>
            <div class="section-heading">
                <div>
                    <h3>Ringkasan Laporan</h3>
                    <p>Gambaran singkat aktivitas persewaan saat ini.</p>
                </div>
                <a href="{{ route('admin.laporan.index') }}" class="section-link">Laporan lengkap →</a>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <p class="stat-label">Total Penyewaan</p>
                    <p class="stat-value">{{ number_format($totalPenyewaan, 0, ',', '.') }}</p>
                    <p class="stat-note">Seluruh transaksi penyewaan</p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">Menunggu Persetujuan</p>
                    <p class="stat-value">{{ number_format($totalMenunggu, 0, ',', '.') }}</p>
                    <p class="stat-note">Perlu diperiksa oleh admin</p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">Penyewaan Selesai</p>
                    <p class="stat-value">{{ number_format($totalSelesai, 0, ',', '.') }}</p>
                    <p class="stat-note">Penyewaan yang sudah dikembalikan</p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">Total Pendapatan</p>
                    <p class="stat-value" style="font-size:clamp(17px, 1.8vw, 23px)">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    <p class="stat-note">Dari transaksi berstatus dibayar dan dikembalikan</p>
                </div>
            </div>
        </section>

        <section style="margin-bottom:32px">
            <div class="section-heading">
                <div>
                    <h3>Riwayat Penyewaan Terbaru</h3>
                    <p>Menampilkan maksimal 5 transaksi terbaru dari semua pelanggan.</p>
                </div>
                <a href="{{ route('admin.penyewaan.index') }}" class="section-link">Lihat semua →</a>
            </div>

            <div class="table-wrap">
                <table class="rental-table">
                    <thead>
                        <tr>
                            <th>KODE SEWA</th>
                            <th>PELANGGAN</th>
                            <th>BARANG DISEWA</th>
                            <th>TANGGAL SEWA</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penyewaanTerbaru as $item)
                            @php
                                $status = strtolower($item->status ?? '');
                                $statusLabel = [
                                    'menunggu' => 'Menunggu',
                                    'disetujui' => 'Disetujui',
                                    'dibayar' => 'Dibayar',
                                    'dikembalikan' => 'Selesai',
                                    'ditolak' => 'Ditolak',
                                ][$status] ?? ucfirst($status ?: 'Tidak diketahui');
                            @endphp
                            <tr>
                                <td>
                                    <span class="rental-code">
                                        {{ $item->kode_penyewaan ?? ('SEWA-' . $item->id_penyewaan) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="rental-customer">{{ $item->user->nama ?? 'Pelanggan' }}</span>
                                </td>
                                <td class="rental-items">
                                    @forelse ($item->detailPenyewaan as $detail)
                                        <div>{{ $detail->barang->nama_barang ?? $detail->barang->nama ?? 'Barang' }} × {{ $detail->jumlah ?? $detail->qty ?? 1 }}</div>
                                    @empty
                                        <span style="color:var(--muted)">Tidak ada detail barang</span>
                                    @endforelse
                                </td>
                                <td class="rental-date">
                                    @if ($item->tanggal_sewa)
                                        {{ \Carbon\Carbon::parse($item->tanggal_sewa)->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="status status-{{ $status ?: 'default' }}">{{ $statusLabel }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    Belum ada data penyewaan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="footer">CampRent — Sistem Informasi Persewaan Alat Camping</footer>
    </main>
</body>
</html>
