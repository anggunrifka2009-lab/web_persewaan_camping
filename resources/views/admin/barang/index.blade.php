<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - CampRent</title>

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

        button, input {
            font: inherit;
        }

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

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 12px 30px;
            color: var(--forest);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .brand-icon {
            display: grid;
            place-items: center;
            width: 39px;
            height: 39px;
            border-radius: 12px;
            background: var(--forest);
            color: white;
            font-size: 23px;
        }

        .sidebar-label {
            padding: 0 12px;
            margin-bottom: 11px;
            color: #92968e;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .nav-menu {
            display: grid;
            gap: 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 46px;
            padding: 12px 14px;
            border-radius: 11px;
            color: #69736a;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #eaf0e8;
            color: var(--forest);
        }

        .nav-icon {
            display: grid;
            place-items: center;
            width: 22px;
            font-size: 18px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 9px 16px;
        }

        .avatar {
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

        .admin-name {
            overflow: hidden;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .admin-role {
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 14px;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #8a5149;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #f8eeeb;
        }

        .main {
            min-height: 100vh;
            margin-left: 250px;
            padding: 32px 38px 28px;
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

        .topbar-account {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 13px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--white);
            font-size: 12px;
            font-weight: 600;
        }

        .topbar-account:hover {
            border-color: #b9c8b8;
            color: var(--forest);
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
            gap: 8px;
            min-height: 40px;
            padding: 10px 15px;
            border: 1px solid transparent;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary {
            background: var(--forest);
            color: white;
        }

        .btn-primary:hover {
            background: var(--forest-dark);
        }

        .btn-edit {
            padding: 8px 11px;
            background: #eaf0e8;
            color: var(--forest);
        }

        .btn-edit:hover {
            background: #dce8d9;
        }

        .btn-delete {
            padding: 8px 11px;
            background: #f8eeeb;
            color: #984c43;
        }

        .btn-delete:hover {
            background: #f2dfda;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 8px;
            width: min(100%, 420px);
        }

        .search-form input {
            width: 100%;
            min-width: 0;
            height: 40px;
            padding: 10px 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--white);
            color: var(--text);
            font-size: 12px;
        }

        .search-form input:focus {
            border-color: #9aaf98;
            box-shadow: 0 0 0 3px #eaf0e8;
        }

        .btn-search {
            min-height: 40px;
            background: #eaf0e8;
            color: var(--forest);
        }

        .btn-search:hover {
            background: #dce8d9;
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
            font-size: 12px;
            line-height: 1.7;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fcfbf7;
        }

        .number {
            width: 55px;
            color: var(--muted);
        }

        .code,
        .item-name,
        .price {
            font-weight: 700;
        }

        .code {
            color: var(--forest);
        }

        .foto-barang {
            display: block;
            width: 60px;
            height: 50px;
            object-fit: cover;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #f5f3ec;
        }

        .foto-kosong {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 50px;
            padding: 4px;
            border: 1px dashed var(--border);
            border-radius: 8px;
            background: #f5f3ec;
            color: var(--muted);
            font-size: 9px;
            line-height: 1.4;
            text-align: center;
        }

        .stock {
            display: inline-block;
            min-width: 30px;
            padding: 3px 9px;
            border-radius: 8px;
            background: #eaf0e8;
            color: var(--forest);
            font-weight: 700;
            text-align: center;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #eaf3e6;
            color: #397348;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status.unavailable {
            background: #f8eeeb;
            color: #984c43;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .delete-form {
            display: inline;
            margin: 0;
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

        @media (max-width: 1100px) {
            .main {
                padding-right: 24px;
                padding-left: 24px;
            }

            .panel {
                padding: 20px;
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 215px;
                padding-right: 13px;
                padding-left: 13px;
            }

            .main {
                margin-left: 215px;
                padding: 28px 20px;
            }

            .panel-heading {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .search-form {
                width: 100%;
                max-width: none;
            }
        }

        @media (max-width: 620px) {
            .sidebar {
                position: relative;
                inset: auto;
                width: 100%;
                padding: 15px 16px 13px;
                border-right: 0;
                border-bottom: 1px solid var(--border);
            }

            .brand {
                padding: 0 4px 15px;
                font-size: 21px;
            }

            .sidebar-label {
                margin: 0 4px 8px;
            }

            .nav-menu {
                display: flex;
                gap: 7px;
                overflow-x: auto;
                padding-bottom: 3px;
            }

            .nav-link {
                flex: 0 0 auto;
                min-height: 40px;
                gap: 8px;
                padding: 10px 12px;
                font-size: 12px;
                white-space: nowrap;
            }

            .nav-icon {
                font-size: 16px;
            }

            .sidebar-bottom {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                margin-top: 13px;
                padding-top: 11px;
            }

            .admin-info {
                min-width: 0;
                padding: 0 4px;
            }

            .logout-btn {
                width: auto;
                padding: 10px;
                white-space: nowrap;
            }

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

            .topbar-account {
                padding: 9px 10px;
                font-size: 0;
            }

            .panel {
                padding: 18px 14px;
            }

            .panel-heading {
                align-items: flex-start;
            }

            .panel-heading h2 {
                font-size: 16px;
            }

            .btn {
                padding: 10px 12px;
            }

            table {
                min-width: 850px;
            }

            .footer {
                margin-top: 28px;
            }

            .pagination-wrap {
                align-items: flex-start;
            }
        }

        @media (max-width: 380px) {
            .main {
                padding-right: 12px;
                padding-left: 12px;
            }

            .panel-heading {
                flex-direction: column;
            }
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

            <a href="{{ route('kategori.index') }}" class="nav-link">
                <span class="nav-icon">▤</span><span>Kategori</span>
            </a>

            <a href="{{ route('barang.index') }}" class="nav-link active">
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
                    <span class="nav-icon">↪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1 class="page-title">Data Barang</h1>
                <p class="page-subtitle">Kelola daftar alat camping yang tersedia untuk disewa.</p>
            </div>
        </header>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Daftar Barang</h2>
                    <p>Data perlengkapan camping yang tersedia untuk disewakan.</p>
                </div>

                <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    <span>+</span> Tambah Barang
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

            <form action="{{ route('barang.index') }}" method="GET" id="form-pencarian" class="search-form" style="margin-bottom:20px;">
                <input
                    type="text"
                    name="cari"
                    id="cari-barang"
                    placeholder="Cari kode atau nama barang..."
                    value="{{ $cari }}"
                    autocomplete="off"
                >

                <button type="submit" class="btn btn-search">Cari</button>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th class="number">NO.</th>
                            <th>FOTO</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>KATEGORI</th>
                            <th>HARGA SEWA</th>
                            <th>STOK</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody id="hasil-barang">
                        @forelse ($barang as $item)
                            <tr>
                                <td class="number">
                                    {{ $barang->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    @if ($item->foto)
                                        <img
                                            src="{{ asset('storage/' . $item->foto) }}"
                                            alt="Foto {{ $item->nama_barang }}"
                                            class="foto-barang"
                                            loading="lazy"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                        >

                                        <div class="foto-kosong" style="display:none;">
                                            Foto tidak tersedia
                                        </div>
                                    @else
                                        <div class="foto-kosong">
                                            Belum ada foto
                                        </div>
                                    @endif
                                </td>

                                <td class="code">{{ $item->kode_barang }}</td>

                                <td class="item-name">{{ $item->nama_barang }}</td>

                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>

                                <td class="price">
                                    Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="stock">{{ $item->stok }}</span>
                                </td>

                                <td>
                                    <span class="status {{ strtolower($item->status) === 'tidak tersedia' ? 'unavailable' : '' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-edit">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('barang.destroy', $item->id_barang) }}"
                                            method="POST"
                                            class="delete-form"
                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">
                                    Data barang tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">
                <div class="pagination-info" id="info-barang">
                    Menampilkan
                    {{ $barang->firstItem() ?? 0 }}-{{ $barang->lastItem() ?? 0 }}
                    dari {{ $barang->total() }} data
                </div>

                <div class="pagination" id="pagination-barang">
                    {{ $barang->appends(request()->query())->links() }}
                </div>
            </div>
        </section>

        <footer class="footer">
            CampRent — Sistem Informasi Persewaan Alat Camping
        </footer>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-pencarian');
            const input = document.getElementById('cari-barang');
            const hasil = document.getElementById('hasil-barang');
            const pagination = document.getElementById('pagination-barang');
            const info = document.getElementById('info-barang');

            let timer;

            async function muatBarang(url) {
                url.searchParams.set('cari', input.value);

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) return;

                    const html = await response.text();
                    const dokumen = new DOMParser().parseFromString(html, 'text/html');
                    const hasilBaru = dokumen.querySelector('#hasil-barang');
                    const paginationBaru = dokumen.querySelector('#pagination-barang');
                    const infoBaru = dokumen.querySelector('#info-barang');

                    if (hasilBaru && paginationBaru) {
                        hasil.innerHTML = hasilBaru.innerHTML;
                        pagination.innerHTML = paginationBaru.innerHTML;

                        if (infoBaru) {
                            info.innerHTML = infoBaru.innerHTML;
                        }

                        window.history.replaceState({}, '', url);
                    }
                } catch (error) {
                    console.error('Gagal memuat data barang:', error);
                }
            }

            function cariBarang() {
                const url = new URL(form.action, window.location.origin);
                muatBarang(url);
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(cariBarang, 300);
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                clearTimeout(timer);
                cariBarang();
            });

            pagination.addEventListener('click', function (event) {
                const link = event.target.closest('a');

                if (!link) return;

                event.preventDefault();
                muatBarang(new URL(link.href));
            });
        });
    </script>
</body>
</html>