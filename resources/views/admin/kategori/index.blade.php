
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori - CampRent</title>

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
        button, input { font: inherit; }

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
        .brand { display: flex; align-items: center; gap: 11px; padding: 0 12px 30px; color: var(--forest); font-size: 23px; font-weight: 800; letter-spacing: -.8px; }
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
        .logout-btn { display: flex; align-items: center; gap: 12px; width: 100%; padding: 12px 14px; border: 0; border-radius: 10px; background: transparent; color: #8a5149; font-size: 13px; font-weight: 600; text-align: left; cursor: pointer; }
        .logout-btn:hover { background: #f8eeeb; }

        .main { min-height: 100vh; margin-left: 250px; padding: 32px 38px 28px; }
        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 30px; }
        .page-title { font-size: 23px; font-weight: 800; letter-spacing: -.6px; }
        .page-subtitle { margin-top: 7px; color: var(--muted); font-size: 12px; line-height: 1.7; }
        .topbar-account { display: flex; align-items: center; gap: 10px; padding: 9px 13px; border: 1px solid var(--border); border-radius: 12px; background: var(--white); font-size: 12px; font-weight: 600; }
        .topbar-account:hover { border-color: #b9c8b8; color: var(--forest); }

        .panel { padding: 25px; border: 1px solid var(--border); border-radius: 16px; background: var(--white); }
        .panel-heading { display: flex; align-items: center; justify-content: space-between; gap: 15px; margin-bottom: 22px; }
        .panel-heading h2 { font-size: 17px; letter-spacing: -.3px; }
        .panel-heading p { margin-top: 7px; color: var(--muted); font-size: 12px; line-height: 1.7; }

        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 40px; padding: 10px 15px; border: 1px solid transparent; border-radius: 10px; font-size: 12px; font-weight: 700; cursor: pointer; transition: .2s; }
        .btn-primary { background: var(--forest); color: white; }
        .btn-primary:hover { background: var(--forest-dark); }
        .btn-light { border-color: var(--border); background: var(--white); color: var(--text); }
        .btn-light:hover { background: var(--cream); }
        .btn-edit { padding: 8px 11px; background: #eaf0e8; color: var(--forest); }
        .btn-edit:hover { background: #dce8d9; }
        .btn-delete { padding: 8px 11px; background: #f8eeeb; color: #984c43; }
        .btn-delete:hover { background: #f2dfda; }

        .table-wrap { overflow-x: auto; border: 1px solid var(--border); border-radius: 12px; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        thead { background: #f9f8f2; }
        th { padding: 15px 18px; color: #737b70; font-size: 10px; font-weight: 800; letter-spacing: .6px; white-space: nowrap; }
        td { padding: 16px 18px; border-top: 1px solid var(--border); font-size: 12px; line-height: 1.7; vertical-align: middle; }
        tbody tr:hover { background: #fcfbf7; }
        .number { width: 70px; color: var(--muted); }
        .category-name { font-weight: 700; }
        .actions { display: flex; align-items: center; gap: 8px; }
        .delete-form { display: inline; margin: 0; }
        .empty-state { padding: 35px 20px; color: var(--muted); text-align: center; line-height: 1.8; }

        .footer { margin-top: 35px; padding-top: 18px; border-top: 1px solid #e0ddd3; color: var(--muted); font-size: 11px; line-height: 1.7; }

        @media (max-width: 900px) {
            .sidebar { width: 215px; padding-right: 13px; padding-left: 13px; }
            .main { margin-left: 215px; padding: 28px 24px; }
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
            .panel { padding: 18px 14px; }
            .panel-heading { align-items: flex-start; }
            .panel-heading h2 { font-size: 16px; }
            .btn { padding: 10px 12px; }
            table { min-width: 470px; }
            .footer { margin-top: 28px; }
        }

        @media (max-width: 380px) {
            .main { padding-right: 12px; padding-left: 12px; }
            .panel-heading { flex-direction: column; }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <span class="nav-icon">▦</span><span>Dashboard</span>
            </a>
            <a href="{{ route('kategori.index') }}" class="nav-link active">
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
                <button type="submit" class="logout-btn">
                    <span class="nav-icon">↪</span><span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1 class="page-title">Data Kategori</h1>
                <p class="page-subtitle">Kelola kategori perlengkapan camping di CampRent.</p>
            </div>
        </header>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Daftar Kategori</h2>
                    <p>Data kategori yang digunakan untuk mengelompokkan barang sewaan.</p>
                </div>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                    <span>＋</span> Tambah Kategori
                </a>
            </div>

            @if (session('success'))
                <div style="margin-bottom:18px;padding:12px 15px;border:1px solid #cfe0cc;border-radius:10px;background:#edf5e9;color:#315b3d;font-size:12px;line-height:1.7;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="margin-bottom:18px;padding:12px 15px;border:1px solid #ead0cb;border-radius:10px;background:#f8eeeb;color:#984c43;font-size:12px;line-height:1.7;">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th class="number">NO.</th>
                            <th>NAMA KATEGORI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $item)
                            <tr>
                                <td class="number">{{ $loop->iteration }}</td>
                                <td class="category-name">{{ $item->nama_kategori }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('kategori.edit', $item->id_kategori) }}" class="btn btn-edit">
                                            Edit
                                        </a>
                                        <form
                                            action="{{ route('kategori.destroy', $item->id_kategori) }}"
                                            method="POST"
                                            class="delete-form"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty-state">
                                    Belum ada kategori. Klik tombol Tambah Kategori untuk menambahkan data.
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
