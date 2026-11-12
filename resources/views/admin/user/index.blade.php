<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - CampRent</title>

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

        #user-content {
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

        .notif {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
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
        }

        .notif-error .notif-icon {
            background: #f0d8d3;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 8px;
            width: min(100%, 420px);
            margin-bottom: 20px;
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

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 38px;
            padding: 9px 13px;
            border: 1px solid transparent;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .btn-search {
            min-height: 40px;
            background: #eaf0e8;
            color: var(--forest);
        }

        .btn-search:hover,
        .btn-detail:hover {
            background: #dce8d9;
        }

        .btn-detail {
            background: #eaf0e8;
            color: var(--forest);
        }

        .btn-active {
            background: #f8eeeb;
            color: #984c43;
        }

        .btn-active:hover {
            background: #f2dfda;
        }

        .btn-inactive {
            background: #eaf3e6;
            color: #397348;
        }

        .btn-inactive:hover {
            background: #dcebd6;
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

        .user-name {
            color: var(--forest);
            font-weight: 700;
        }

        .email {
            color: var(--muted);
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

        .status.inactive {
            background: #f8eeeb;
            color: #984c43;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .status-form {
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
    </style>
</head>

<body>
    @include('admin.sidebar')

    <main class="main" id="user-content">
        <header class="topbar">
            <div>
                <h1 class="page-title">Kelola User</h1>
                <p class="page-subtitle">
                    Lihat dan kelola seluruh akun yang terdaftar di CampRent.
                </p>
            </div>
        </header>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Daftar Akun</h2>
                </div>
            </div>

            @if (session('success'))
                <div class="notif notif-success" role="status">
                    <span class="notif-icon">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="notif notif-error" role="alert">
                    <span class="notif-icon">!</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form
                action="{{ route('admin.user.index') }}"
                method="GET"
                id="form-pencarian"
                class="search-form"
            >
                <input
                    type="text"
                    name="cari"
                    id="cari-user"
                    placeholder="Cari nama, email, atau nomor HP..."
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
                            <th>NAMA USER</th>
                            <th>EMAIL</th>
                            <th>NO. HP</th>
                            <th>TANGGAL DAFTAR</th>
                            <th>STATUS AKUN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody id="hasil-user">
                        @forelse ($users as $user)
                            <tr>
                                <td class="number">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td class="user-name">
                                    {{ $user->nama }}
                                </td>

                                <td class="email">
                                    {{ $user->email }}
                                </td>

                                <td>
                                    {{ $user->no_hp ?: '-' }}
                                </td>

                                <td>
                                    {{ $user->created_at
                                        ? $user->created_at->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="status {{ $user->status === 'nonaktif' ? 'inactive' : '' }}">
                                        {{ ucfirst($user->status ?? 'aktif') }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route('admin.user.show', $user->id_user) }}"
                                            class="btn btn-detail"
                                        >
                                            Detail
                                        </a>

                                        <form
                                            action="{{ route('admin.user.updateStatus', $user->id_user) }}"
                                            method="POST"
                                            class="status-form"
                                            onsubmit="return confirm('Yakin ingin {{ $user->status === 'aktif' ? 'menonaktifkan' : 'mengaktifkan' }} akun ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="{{ $user->status === 'aktif' ? 'nonaktif' : 'aktif' }}"
                                            >

                                            @if ($user->status === 'aktif')
                                                <button type="submit" class="btn btn-active">
                                                    Nonaktifkan
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-inactive">
                                                    Aktifkan
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    Data tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">
                <div class="pagination-info" id="info-user">
                    Menampilkan
                    {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}
                    dari {{ $users->total() }} data
                </div>

                <div class="pagination" id="pagination-user">
                    {{ $users->appends(request()->query())->links() }}
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
            const input = document.getElementById('cari-user');
            const hasil = document.getElementById('hasil-user');
            const pagination = document.getElementById('pagination-user');
            const info = document.getElementById('info-user');

            let timer;
            let controller;

            async function muatUser(url) {
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

                    const hasilBaru = dokumen.querySelector('#hasil-user');
                    const paginationBaru = dokumen.querySelector('#pagination-user');
                    const infoBaru = dokumen.querySelector('#info-user');

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
                        console.error('Gagal memuat data user:', error);
                    }
                }
            }

            function cariUser() {
                const url = new URL(form.action, window.location.origin);
                muatUser(url);
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(cariUser, 300);
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                clearTimeout(timer);
                cariUser();
            });

            pagination.addEventListener('click', function (event) {
                const link = event.target.closest('a');

                if (!link) {
                    return;
                }

                event.preventDefault();

                const url = new URL(link.href);
                url.searchParams.set('cari', input.value);

                muatUser(url);
            });
        });
    </script>
</body>
</html>