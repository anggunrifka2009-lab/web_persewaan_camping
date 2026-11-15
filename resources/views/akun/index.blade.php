<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun - CampRent</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f2f6f1;
            --white: #ffffff;
            --forest: #244b38;
            --forest-dark: #193a2b;
            --forest-soft: #e9f0e8;
            --text: #26392e;
            --muted: #6f7f74;
            --border: #e0e7de;
            --danger: #a52f2f;
            --danger-soft: #fff1f1;
            --radius-lg: 16px;
            --radius-md: 10px;
            --space: 24px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-padding-top: 90px; }

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

        a { color: inherit; text-decoration: none; }
        input, textarea, button { font: inherit; }
        :focus-visible { outline: 2px solid var(--forest); outline-offset: 2px; }

        .navbar {
            position: sticky; top: 0; z-index: 100; width: 100%;
            border-bottom: 1px solid transparent;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(14px);
            transition: box-shadow .25s, border-color .25s;
        }
        .navbar.scrolled { border-color: var(--border); box-shadow: 0 6px 24px rgba(38, 57, 46, .07); }
        .navbar-inner {
            display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 26px;
            width: 100%; margin: 0; padding: 13px 3%;
        }
        .brand {
            display: flex; align-items: center; gap: 9px; flex-shrink: 0;
            color: var(--forest); font-size: 23px; font-weight: 800; letter-spacing: -.8px;
        }
        .brand-icon { font-size: 29px; }
        .nav-links { display: flex; align-items: center; justify-content: center; gap: 6px; }
        .nav-link {
            padding: 9px 16px; color: #5d6f63; font-size: 14px; font-weight: 600;
            white-space: nowrap; transition: color .2s;
        }
        .nav-link:hover, .nav-link.active { color: var(--forest); }
        .nav-mobile-only, .nav-tiny-only, .nav-mobile-account { display: none; }

        .nav-logout {
            display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%;
            border: 0; background: transparent; color: #eb533f; font-family: inherit; cursor: pointer;
        }
        .nav-logout:hover { color: #c93a27; }
        .nav-mobile-account .nav-link { display: flex; align-items: center; gap: 12px; }
        .nav-mobile-account svg {
            width: 19px; height: 19px; flex-shrink: 0; fill: none; stroke: currentColor;
            stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
        }

        .nav-menu { display: flex; align-items: center; justify-content: flex-end; gap: 10px; }
        .nav-login {
            padding: 10px 16px; border: 1px solid var(--border); border-radius: 9px;
            font-size: 13px; font-weight: 600; transition: background .2s, border-color .2s;
        }
        .nav-login:hover { border-color: #c9d6c6; background: var(--forest-soft); }
        .nav-name {
            max-width: 110px; overflow: hidden; font-size: 13px; font-weight: 600;
            text-overflow: ellipsis; white-space: nowrap;
        }
        .nav-toggle {
            display: none; place-items: center; width: 42px; height: 42px; flex-shrink: 0;
            border: 1px solid var(--border); border-radius: 10px; background: var(--white);
            color: var(--forest); cursor: pointer;
        }
        .nav-toggle svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; }
        .nav-toggle .icon-close { display: none; }
        .navbar.open .nav-toggle .icon-open { display: none; }
        .navbar.open .nav-toggle .icon-close { display: block; }

        .account-dropdown-wrapper { position: relative; flex-shrink: 0; }
        .account-dropdown-toggle {
            display: flex; align-items: center; gap: 8px; padding: 5px 8px 5px 5px;
            border: 1px solid transparent; border-radius: 30px; background: transparent;
            cursor: pointer; transition: background .2s;
        }
        .account-dropdown-toggle:hover, .account-dropdown-wrapper.show .account-dropdown-toggle { background: var(--forest-soft); }
        .nav-account {
            display: grid; place-items: center; flex-shrink: 0; width: 38px; height: 38px;
            border-radius: 50%; background: #e7eee4; color: var(--forest); font-size: 15px; font-weight: 800;
        }
        .dropdown-arrow { width: 15px; height: 15px; color: var(--muted); transition: transform .2s; }
        .account-dropdown-wrapper.show .dropdown-arrow { transform: rotate(180deg); }
        .account-dropdown {
            position: absolute; top: calc(100% + 12px); right: 0; z-index: 101; width: 220px; padding: 7px;
            border: 1px solid var(--border); border-radius: 12px; background: var(--white);
            box-shadow: 0 10px 30px rgba(38, 57, 46, .12);
            opacity: 0; visibility: hidden; transform: translateY(8px);
            transition: opacity .2s ease, transform .2s ease, visibility .2s;
        }
        .account-dropdown-wrapper.show .account-dropdown { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item {
            display: flex; align-items: center; gap: 10px; width: 100%; padding: 11px 12px;
            border: none; border-radius: 8px; background: transparent; color: var(--text);
            font-size: 12px; font-weight: 600; text-align: left; cursor: pointer; transition: background .2s;
        }
        .dropdown-item:hover { background: #eef3ec; }
        .dropdown-item svg { width: 17px; height: 17px; flex-shrink: 0; color: var(--muted); }
        .dropdown-divider { height: 1px; margin: 5px 4px; background: var(--border); }
        .nav-form { margin: 0; }
        .dropdown-logout { gap: 12px; padding: 12px 14px; border-radius: 10px; color: #eb533f; font-size: 13px; }
        .dropdown-logout:hover { background: #f8eeeb; }
        .dropdown-logout svg {
            display: block; width: 20px; height: 20px; color: #eb533f; fill: none;
            stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
        }
        .nav-cta {
            display: inline-flex; align-items: center; justify-content: center; padding: 11px 17px;
            border-radius: 9px; background: var(--forest); color: white; font-size: 13px; font-weight: 600;
            white-space: nowrap; transition: background .2s;
        }
        .nav-cta:hover { background: var(--forest-dark); }

        .container { flex: 1; width: 100%; max-width: 1040px; margin: 0 auto; padding: 48px 28px 70px; }
        .page-head { margin-bottom: 28px; }
        .page-heading { display: flex; align-items: center; gap: 12px; margin-bottom: 6px; }
        .btn-back {
            display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
            width: 38px; height: 38px; border: 1px solid var(--border); border-radius: 9px;
            background: var(--white); color: var(--forest); transition: background .2s;
        }
        .btn-back:hover { background: var(--forest-soft); }
        .btn-back svg { display: block; width: 20px; height: 20px; }
        .page-head h1 { font-size: clamp(24px, 3vw, 32px); font-weight: 800; line-height: 1.25; letter-spacing: -1px; }
        .page-head p { color: var(--muted); font-size: 13px; line-height: 1.8; }

        .alert-success {
            margin-bottom: 24px; padding: 14px 16px; border: 1px solid #cfdcc6;
            border-radius: var(--radius-md); background: var(--forest-soft); color: var(--forest); font-weight: 600;
        }

        .alert-success {
            max-height: 100px;
            overflow: hidden;
            transition: opacity .4s ease, transform .4s ease, margin .4s ease, padding .4s ease, max-height .4s ease;
        }

        .alert-success.is-hiding {
            opacity: 0;
            transform: translateY(-5px);
            max-height: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        .layout { display: grid; grid-template-columns: 290px minmax(0, 1fr); gap: var(--space); align-items: start; }
        .card { border: 1px solid var(--border); border-radius: var(--radius-lg); background: var(--white); }

        .profile-card { position: sticky; top: 100px; padding: 32px 24px 24px; text-align: center; }
        .avatar {
            display: flex; align-items: center; justify-content: center; width: 88px; height: 88px;
            margin: 0 auto 16px; border: 4px solid var(--forest-soft); border-radius: 50%;
            background: var(--forest); color: #fff; font-size: 34px; font-weight: 800;
        }
        .profile-card h2 { margin-bottom: 4px; font-size: 19px; line-height: 1.35; overflow-wrap: anywhere; }
        .profile-email { margin-bottom: 14px; color: var(--muted); font-size: 13px; overflow-wrap: anywhere; }
        .role-pill {
            display: inline-block; padding: 5px 12px; border-radius: 999px;
            background: var(--forest-soft); color: var(--forest); font-size: 12px; font-weight: 600;
        }
        .profile-meta { margin-top: 22px; padding-top: 16px; border-top: 1px solid var(--border); }
        .profile-meta div { display: flex; justify-content: space-between; gap: 12px; padding: 6px 0; font-size: 13px; }
        .profile-meta span:first-child { color: var(--muted); }
        .profile-meta span:last-child { font-weight: 600; text-align: right; overflow-wrap: anywhere; }

        .stack { display: flex; flex-direction: column; gap: var(--space); }
        .panel { padding: 28px; }
        .panel-title { margin-bottom: 4px; font-size: 17px; font-weight: 700; }
        .panel-sub {
            margin-bottom: 22px; padding-bottom: 18px; border-bottom: 1px solid var(--border);
            color: var(--muted); font-size: 13px;
        }

        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; min-width: 0; }
        .form-group.wide { grid-column: 1 / -1; }
        .form-group label { font-size: 13px; font-weight: 600; }

        .form-control {
            width: 100%; height: 42px; padding: 0 13px; border: 1px solid var(--border);
            border-radius: var(--radius-md); background: var(--white); color: var(--text);
            font-size: 13px; transition: border-color .15s, box-shadow .15s;
        }
        .form-control:hover { border-color: #c9d6c6; }
        .form-control:focus { border-color: #9bb39a; outline: none; box-shadow: 0 0 0 3px rgba(36, 75, 56, .07); }
        .form-control.is-invalid { border-color: var(--danger); background: var(--danger-soft); }
        textarea.form-control { height: auto; padding: 11px 13px; min-height: 96px; resize: vertical; line-height: 1.6; }

        .password-wrapper { position: relative; width: 100%; }
        .password-wrapper .form-control { padding-right: 44px; }
        .toggle-password {
            position: absolute; top: 50%; right: 8px; display: flex; align-items: center; justify-content: center;
            width: 30px; height: 30px; padding: 0; border: none; border-radius: 6px; background: transparent;
            color: var(--muted); cursor: pointer; transform: translateY(-50%); transition: color .15s;
        }
        .toggle-password:hover { color: var(--forest); }
        .toggle-password svg { display: block; width: 19px; height: 19px; }

        .field-error { color: var(--danger); font-size: 12px; }

        .form-footer { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-top: 22px; }
        .password-note { flex: 1 1 240px; color: var(--muted); font-size: 12px; }
        .submit-button {
            display: inline-flex; align-items: center; justify-content: center; padding: 12px 20px;
            border: none; border-radius: var(--radius-md); background: var(--forest); color: #fff;
            font-size: 13px; font-weight: 700; cursor: pointer; transition: background .15s;
        }
        .submit-button:hover { background: var(--forest-dark); }


        @media (max-width: 900px) {
            .navbar-inner { display: flex; justify-content: space-between; gap: 14px; padding: 12px 20px; }
            .nav-toggle { display: grid; }
            .nav-links {
                position: absolute; top: 100%; left: 0; right: 0; display: none;
                flex-direction: column; align-items: stretch; gap: 2px; margin: 0;
                padding: 10px 20px 18px; border-bottom: 1px solid var(--border);
                background: var(--white); box-shadow: 0 16px 30px rgba(38, 57, 46, .1);
            }
            .navbar.open .nav-links { display: flex; }
            .nav-mobile-account {
                display: flex; flex-direction: column; gap: 2px; margin-top: 8px; padding-top: 8px;
                border-top: 1px solid var(--border);
            }
            .account-dropdown-wrapper { display: none; }
            .nav-link { padding: 13px 4px; text-align: left; }
            .nav-logout { justify-content: flex-start; }

            .layout { grid-template-columns: 1fr; }
            .profile-card { position: static; }
        }

        @media (max-width: 650px) {
            .brand { font-size: 21px; }
            .brand-icon { font-size: 26px; }
            .nav-menu { gap: 8px; flex-shrink: 0; }
            .nav-name, .nav-login { display: none; }
            .nav-mobile-only { display: block; }
            .nav-menu .nav-cta { display: none; }
            .nav-tiny-only { display: block; }
            .navbar-inner { padding: 11px 16px; }

            .container { padding: 24px 16px 48px; }
            .page-head h1 { font-size: 24px; }
            .panel { padding: 20px 16px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.wide { grid-column: auto; }
            .submit-button { width: 100%; }
        }
    </style>
</head>

<body>

    @php
        $kembaliUrl = $user->role === 'admin'
            ? route('admin.dashboard')
            : route('home');

        $kembaliLabel = $user->role === 'admin'
            ? 'Kembali ke Dashboard'
            : 'Kembali ke Beranda';
    @endphp

    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-icon">⌁</span>
                CampRent
            </a>

            <div class="nav-links" id="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                <a href="{{ url('/') }}#cara-sewa" class="nav-link">Cara Sewa</a>
                <a href="{{ url('/') }}#daftar-barang" class="nav-link">Perlengkapan</a>
                <a href="{{ url('/') }}#kontak" class="nav-link">Kontak</a>

                @guest
                    <a href="{{ route('login') }}" class="nav-link nav-mobile-only">Login</a>
                    <a href="{{ route('register') }}" class="nav-link nav-tiny-only">Daftar</a>
                @endguest

                @auth
                    <div class="nav-mobile-account">
                        <a href="{{ route('akun.index') }}" class="nav-link active">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4" /><path d="M5 21v-2a7 7 0 0 1 14 0v2" /></svg>
                            <span>Informasi Akun</span>
                        </a>

                        @if (Auth::user()->role === 'pelanggan')
                            <a href="{{ route('penyewaan.riwayat') }}" class="nav-link">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3v5h5" /><path d="M3.5 13a9 9 0 1 0 2.1-6.2L3 8" /><path d="M12 7v5l3 2" /></svg>
                                <span>Riwayat Penyewaan</span>
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="nav-form">
                            @csrf
                            <button type="submit" class="nav-link nav-logout">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" /></svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>

            <div class="nav-menu">
                @auth
                    <div class="account-dropdown-wrapper" id="accountDropdown">
                        <button type="button" class="account-dropdown-toggle" id="account-toggle"
                            aria-label="Menu akun" aria-expanded="false" aria-controls="account-menu">
                            <span class="nav-account">{{ strtoupper(mb_substr(Auth::user()->nama, 0, 1)) }}</span>
                            <span class="nav-name">{{ \Illuminate\Support\Str::limit(Auth::user()->nama, 14) }}</span>
                            <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <div class="account-dropdown" id="account-menu">
                            <a href="{{ route('akun.index') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M5 21v-2a7 7 0 0 1 14 0v2" />
                                </svg>
                                <span>Informasi Akun</span>
                            </a>

                            @if (Auth::user()->role === 'pelanggan')
                                <a href="{{ route('penyewaan.riwayat') }}" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 3v5h5" />
                                        <path d="M3.5 13a9 9 0 1 0 2.1-6.2L3 8" />
                                        <path d="M12 7v5l3 2" />
                                    </svg>
                                    <span>Riwayat Penyewaan</span>
                                </a>
                            @endif

                            <div class="dropdown-divider"></div>

                            <form action="{{ route('logout') }}" method="POST" class="nav-form">
                                @csrf
                                <button type="submit" class="dropdown-item dropdown-logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-login">Login</a>
                    <a href="{{ route('register') }}" class="nav-cta">Daftar</a>
                @endauth

                <button type="button" class="nav-toggle" id="nav-toggle" aria-label="Buka menu"
                    aria-expanded="false" aria-controls="nav-links">
                    <svg class="icon-open" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" /></svg>
                    <svg class="icon-close" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" /></svg>
                </button>
            </div>
        </div>
    </nav>

    <main class="container">

        <div class="page-head">
            <div class="page-heading">
                <a href="{{ $kembaliUrl }}" class="btn-back" aria-label="{{ $kembaliLabel }}" title="{{ $kembaliLabel }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a>

                <h1>Informasi Akun</h1>
            </div>

            <p>Lihat informasi akun dan kelola data pribadimu.</p>
        </div>

        @if (session('success'))
            <div class="alert-success" role="status">
                {{ session('success') }}
            </div>
        @endif

        <div class="layout">

            <aside class="card profile-card">

                <div class="avatar" aria-hidden="true">
                    {{ strtoupper(mb_substr($user->nama, 0, 1)) }}
                </div>

                <h2>{{ $user->nama }}</h2>

                <p class="profile-email">{{ $user->email }}</p>

                <span class="role-pill">{{ ucfirst($user->role) }}</span>

                <div class="profile-meta">
                    <div>
                        <span>Nomor HP</span>
                        <span>{{ $user->no_hp ?: '-' }}</span>
                    </div>

                    <div>
                        <span>Status akun</span>
                        <span>Aktif</span>
                    </div>
                </div>

            </aside>

            <div class="stack">

                <section class="card panel">

                    <h2 class="panel-title">Edit Profil</h2>
                    <p class="panel-sub">Perbarui informasi pribadi akunmu.</p>

                    <form action="{{ route('akun.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-grid">

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input class="form-control @error('nama') is-invalid @enderror" id="nama" type="text"
                                    name="nama" value="{{ old('nama', $user->nama) }}" required>
                                @error('nama')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email"
                                    name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group wide">
                                <label for="no_hp">Nomor HP</label>
                                <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" type="text"
                                    name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                                @error('no_hp')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group wide">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat">{{ old('alamat', $user->alamat) }}</textarea>
                                @error('alamat')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-footer">
                            <button type="submit" class="submit-button">Simpan Perubahan</button>
                        </div>
                    </form>

                </section>

                <section class="card panel">

                    <h2 class="panel-title">Keamanan Akun</h2>
                    <p class="panel-sub">Ganti password secara berkala untuk menjaga keamanan akun.</p>

                    <form action="{{ route('akun.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-grid">

                            <div class="form-group wide">
                                <label for="password_lama">Password Lama</label>

                                <div class="password-wrapper">
                                    <input class="form-control @error('password_lama') is-invalid @enderror" type="password"
                                        id="password_lama" name="password_lama" autocomplete="current-password" required>

                                    <button type="button" class="toggle-password" data-target="password_lama"
                                        aria-label="Tampilkan password" aria-pressed="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round" aria-hidden="true">
                                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>

                                @error('password_lama')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>

                                <div class="password-wrapper">
                                    <input class="form-control @error('password_baru') is-invalid @enderror" type="password"
                                        id="password_baru" name="password_baru" autocomplete="new-password" required>

                                    <button type="button" class="toggle-password" data-target="password_baru"
                                        aria-label="Tampilkan password" aria-pressed="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round" aria-hidden="true">
                                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>

                                @error('password_baru')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_baru_confirmation">Konfirmasi Password Baru</label>

                                <div class="password-wrapper">
                                    <input class="form-control" type="password" id="password_baru_confirmation"
                                        name="password_baru_confirmation" autocomplete="new-password" required>

                                    <button type="button" class="toggle-password" data-target="password_baru_confirmation"
                                        aria-label="Tampilkan password" aria-pressed="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round" aria-hidden="true">
                                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="form-footer">
                            <p class="password-note">
                                Password baru minimal 8 karakter dan harus sama dengan konfirmasi password.
                            </p>

                            <button type="submit" class="submit-button">Simpan Password</button>
                        </div>
                    </form>

                </section>

            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('navbar');
            const navToggle = document.getElementById('nav-toggle');
            const navLinks = document.getElementById('nav-links');

            const dropdown = document.getElementById('accountDropdown');
            const toggle = document.getElementById('account-toggle');

            function tutupDropdown() {
                if (dropdown && toggle) {
                    dropdown.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            }

            function tutupMenu() {
                navbar.classList.remove('open');

                if (navToggle) {
                    navToggle.setAttribute('aria-expanded', 'false');
                }
            }

            function onScroll() {
                navbar.classList.toggle('scrolled', window.scrollY > 8);
            }

            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });

            if (toggle && dropdown) {
                toggle.addEventListener('click', function (event) {
                    event.stopPropagation();

                    const isOpen = dropdown.classList.toggle('show');
                    toggle.setAttribute('aria-expanded', isOpen);
                });
            }

            if (navToggle) {
                navToggle.addEventListener('click', function () {
                    const isOpen = navbar.classList.toggle('open');
                    navToggle.setAttribute('aria-expanded', isOpen);
                });
            }

            document.addEventListener('click', function (event) {
                if (dropdown && !dropdown.contains(event.target)) {
                    tutupDropdown();
                }

                if (!navbar.contains(event.target)) {
                    tutupMenu();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    tutupDropdown();

                    if (navbar.classList.contains('open')) {
                        tutupMenu();
                        navToggle?.focus();
                    }
                }
            });

            if (navLinks) {
                navLinks.querySelectorAll('a, button').forEach(function (element) {
                    element.addEventListener('click', tutupMenu);
                });
            }

            const iconTampil = `
                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
            `;

            const iconSembunyi = `
                <path d="M3 3l18 18"/>
                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                <path d="M9.9 5.2A11 11 0 0 1 12 5c6.4 0 10 7 10 7a15.5 15.5 0 0 1-4 4.7"/>
                <path d="M6.6 6.6C3.7 8.5 2 12 2 12s3.6 7 10 7a10.7 10.7 0 0 0 3.4-.6"/>
            `;

            document.querySelectorAll('.toggle-password').forEach(function (button) {
                button.addEventListener('click', function () {
                    const input = document.getElementById(button.dataset.target);

                    if (!input) return;

                    const isHidden = input.type === 'password';

                    input.type = isHidden ? 'text' : 'password';

                    button.setAttribute(
                        'aria-label',
                        isHidden ? 'Sembunyikan password' : 'Tampilkan password'
                    );

                    button.setAttribute('aria-pressed', String(isHidden));

                    button.querySelector('svg').innerHTML =
                        isHidden ? iconSembunyi : iconTampil;
                });
            });
        });

        const alertSuccess = document.querySelector('.alert-success');
        if (alertSuccess) {
            setTimeout(function () {
                alertSuccess.classList.add('is-hiding');
                setTimeout(function () { alertSuccess.remove(); }, 400);
            }, 3000);
        }
    </script>

</body>
</html>