
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User - CampRent</title>

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
            --danger: #984c43;
            --soft-green: #eaf0e8;
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

        button {
            font: inherit;
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
            margin-bottom: 26px;
        }

        .topbar-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 7px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--white);
            color: var(--forest);
            border: 1px solid var(--border);
            transition: .2s;
        }

        .btn-back:hover {
            background: var(--soft-green);
        }

        .btn-back svg {
            display: block;
            width: 20px;
            height: 20px;
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

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 270px;
            align-items: start;
            gap: 22px;
        }

        .panel {
            min-width: 0;
            padding: 27px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            box-shadow: 0 5px 18px rgba(36, 75, 56, .035);
        }

        .panel-heading {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
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

        .profile-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 27px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #faf9f4;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 58px;
            height: 58px;
            border-radius: 13px;
            background: var(--soft-green);
            color: var(--forest);
            font-size: 23px;
            font-weight: 800;
        }

        .profile-name {
            font-size: 16px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .profile-role {
            margin-top: 6px;
            color: var(--muted);
            font-size: 11px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 20px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 9px;
            min-width: 0;
        }

        .detail-item.full {
            grid-column: 1 / -1;
        }

        .detail-label {
            font-size: 12px;
            font-weight: 700;
        }

        .detail-value {
            min-height: 43px;
            display: flex;
            align-items: center;
            padding: 11px 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #faf9f5;
            color: var(--text);
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            width: fit-content;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status.aktif {
            background: #eaf3e9;
            color: #287342;
        }

        .status.nonaktif {
            background: #f8eeeb;
            color: var(--danger);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 41px;
            padding: 10px 16px;
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

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #7e3e37;
        }

        .btn-secondary {
            border-color: var(--border);
            background: var(--white);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: #f5f3ec;
        }

        .side-column {
            display: grid;
            gap: 18px;
        }

        .side-card {
            padding: 21px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            box-shadow: 0 5px 18px rgba(36, 75, 56, .035);
        }

        .side-card h3 {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 800;
        }

        .side-card p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
        }

        .status-box {
            margin: 17px 0 12px;
            padding: 17px;
            border-radius: 12px;
            background: #f5f7f1;
            text-align: center;
        }

        .status-box strong {
            display: block;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .side-info {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
        }

        .side-info:last-child {
            border-bottom: none;
        }

        .side-info span {
            color: var(--muted);
        }

        .side-info strong {
            text-align: right;
            overflow-wrap: anywhere;
        }

        .alert-success {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 1px solid #cddfce;
            border-radius: 10px;
            background: #eaf3e9;
            color: #287342;
            font-size: 12px;
            line-height: 1.8;
        }

        .alert-error {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 1px solid #ead0cb;
            border-radius: 10px;
            background: #f8eeeb;
            color: var(--danger);
            font-size: 12px;
            line-height: 1.8;
        }

        .footer {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid #e0ddd3;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: minmax(0, 1fr) 235px;
                gap: 16px;
            }

            .panel {
                padding: 22px;
            }

            .side-card {
                padding: 17px;
            }
        }

        @media (max-width: 1000px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .side-column {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 215px;
                padding: 28px 20px;
            }

            .side-column {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 620px) {
            .main {
                margin-left: 0;
                padding: 24px 17px;
            }

            .topbar {
                margin-bottom: 22px;
            }

            .page-title {
                font-size: 21px;
            }

            .panel {
                padding: 19px 15px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .detail-item.full {
                grid-column: auto;
            }

            .side-column {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    @include('admin.sidebar')

    <main class="main">

        <header class="topbar">
            <div>
                <div class="topbar-heading">
                    <a href="{{ route('admin.user.index') }}"
                       class="btn-back"
                       aria-label="Kembali ke daftar user">
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

                    <h1 class="page-title">Detail User</h1>
                </div>

                <p class="page-subtitle">
                    Lihat informasi lengkap dan kelola status akun pelanggan CampRent.
                </p>
            </div>
        </header>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="content-grid">

            <section class="panel">

                <div class="panel-heading">
                    <h2>Informasi Pelanggan</h2>
                    <p>
                        Berikut adalah informasi akun pelanggan yang terdaftar
                        di sistem persewaan alat camping.
                    </p>
                </div>

                <div class="profile-header">
                    <div class="avatar">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>

                    <div>
                        <div class="profile-name">{{ $user->nama }}</div>
                        <div class="profile-role">Pelanggan CampRent</div>
                    </div>
                </div>

                <div class="detail-grid">

                    <div class="detail-item">
                        <label class="detail-label">ID User</label>
                        <div class="detail-value">#{{ $user->id_user }}</div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Nama Lengkap</label>
                        <div class="detail-value">{{ $user->nama }}</div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Email</label>
                        <div class="detail-value">{{ $user->email }}</div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Nomor HP</label>
                        <div class="detail-value">{{ $user->no_hp ?: '-' }}</div>
                    </div>

                    <div class="detail-item full">
                        <label class="detail-label">Alamat</label>
                        <div class="detail-value">{{ $user->alamat ?: '-' }}</div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Tanggal Daftar</label>
                        <div class="detail-value">
                            {{ $user->created_at ? $user->created_at->format('d-m-Y') : '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <label class="detail-label">Status Akun</label>
                        <div>
                            <span class="status {{ ($user->status ?? 'aktif') === 'aktif' ? 'aktif' : 'nonaktif' }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($user->status ?? 'aktif') }}
                            </span>
                        </div>
                    </div>

                </div>

                <div class="form-actions">

                    <a href="{{ route('admin.user.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <form action="{{ route('admin.user.updateStatus', $user->id_user) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin mengubah status akun pelanggan ini?')">

                        @csrf
                        @method('PATCH')

                        @if (($user->status ?? 'aktif') === 'aktif')
                            <input type="hidden" name="status" value="nonaktif">

                            <button type="submit" class="btn btn-danger">
                                Nonaktifkan Akun
                            </button>
                        @else
                            <input type="hidden" name="status" value="aktif">

                            <button type="submit" class="btn btn-primary">
                                Aktifkan Akun
                            </button>
                        @endif

                    </form>

                </div>

            </section>

            <aside class="side-column">

                <section class="side-card">
                    <h3>Status Akun</h3>
                    <p>
                        Status ini menentukan apakah pelanggan dapat menggunakan
                        akunnya untuk melakukan penyewaan.
                    </p>

                    <div class="status-box">
                        <strong>Status saat ini</strong>

                        <span class="status {{ ($user->status ?? 'aktif') === 'aktif' ? 'aktif' : 'nonaktif' }}">
                            <span class="status-dot"></span>
                            {{ ucfirst($user->status ?? 'aktif') }}
                        </span>
                    </div>

                    @if (($user->status ?? 'aktif') === 'aktif')
                        <p>
                            Akun pelanggan sedang aktif dan dapat digunakan
                            untuk melakukan penyewaan.
                        </p>
                    @else
                        <p>
                            Akun pelanggan sedang nonaktif sehingga tidak dapat
                            melakukan penyewaan.
                        </p>
                    @endif
                </section>

                <section class="side-card">
                    <h3>Ringkasan Akun</h3>
                    <p>Informasi singkat pelanggan yang sedang dilihat.</p>

                    <div style="margin-top: 14px;">
                        <div class="side-info">
                            <span>ID User</span>
                            <strong>#{{ $user->id_user }}</strong>
                        </div>

                        <div class="side-info">
                            <span>Role</span>
                            <strong>Pelanggan</strong>
                        </div>

                        <div class="side-info">
                            <span>Tanggal Daftar</span>
                            <strong>
                                {{ $user->created_at ? $user->created_at->format('d-m-Y') : '-' }}
                            </strong>
                        </div>
                    </div>
                </section>

            </aside>

        </div>

        <footer class="footer">
            CampRent — Sistem Informasi Persewaan Alat Camping
        </footer>

    </main>

</body>
</html>
