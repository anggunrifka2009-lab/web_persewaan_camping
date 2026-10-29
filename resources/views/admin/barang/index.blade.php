
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

        .main {
            min-height: 100vh;
            margin-left: 250px;
            padding: 32px 38px 28px;
        }

        #barang-content {
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
            #barang-content {
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

        /* NOTIFIKASI */
        .notif {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
            animation: notifEnter .25s ease-out;
        }

        .notif-success {
            border: 1px solid #cfe0cc;
            background: #edf5e9;
            color: #315b3d;
        }

        .notif-error {
            border: 1px solid #ead0cb;
            background: #f8eeeb;
            color: #984c43;
        }

        .notif-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 800;
        }

        .notif-success .notif-icon {
            background: #d6e9d1;
            color: #315b3d;
        }

        .notif-error .notif-icon {
            background: #f0d8d3;
            color: #984c43;
        }

        @keyframes notifEnter {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    @include('admin.sidebar')

    <main class="main" id="barang-content">
        <header class="topbar">
            <div>
                <h1 class="page-title">Data Barang</h1>
                <p class="page-subtitle">
                    Kelola daftar alat camping yang tersedia untuk disewa.
                </p>
            </div>
        </header>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Daftar Barang</h2>
                    <p>Data perlengkapan camping yang tersedia untuk disewakan.</p>
                </div>

                <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
                    <span>+</span> Tambah Barang
                </a>
            </div>

            {{-- NOTIFIKASI BERHASIL --}}
            @if (session('success'))
                <div class="notif notif-success" role="status">
                    <span class="notif-icon">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- NOTIFIKASI GAGAL --}}
            @if (session('error'))
                <div class="notif notif-error" role="alert">
                    <span class="notif-icon">!</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form
                action="{{ route('admin.barang.index') }}"
                method="GET"
                id="form-pencarian"
                class="search-form"
                style="margin-bottom:20px;"
            >
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
                                        <a
                                            href="{{ route('admin.barang.edit', $item->id_barang) }}"
                                            class="btn btn-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.barang.destroy', $item->id_barang) }}"
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
            let controller;

            async function muatBarang(url) {
                url.searchParams.set('cari', input.value);

                if (controller) {
                    controller.abort();
                }

                controller = new AbortController();

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        signal: controller.signal
                    });

                    if (!response.ok) {
                        window.location.href = url.toString();
                        return;
                    }

                    const html = await response.text();
                    const dokumen = new DOMParser().parseFromString(
                        html,
                        'text/html'
                    );

                    const hasilBaru = dokumen.querySelector('#hasil-barang');
                    const paginationBaru = dokumen.querySelector('#pagination-barang');
                    const infoBaru = dokumen.querySelector('#info-barang');

                    if (!hasilBaru || !paginationBaru) {
                        window.location.href = url.toString();
                        return;
                    }

                    hasil.innerHTML = hasilBaru.innerHTML;
                    pagination.innerHTML = paginationBaru.innerHTML;

                    if (infoBaru) {
                        info.innerHTML = infoBaru.innerHTML;
                    }

                    window.history.replaceState({}, '', url.toString());
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('Gagal memuat data barang:', error);
                    }
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

                if (!link) {
                    return;
                }

                event.preventDefault();

                const url = new URL(link.href);
                url.searchParams.set('cari', input.value);

                muatBarang(url);
            });
        });
    </script>
</body>
</html>