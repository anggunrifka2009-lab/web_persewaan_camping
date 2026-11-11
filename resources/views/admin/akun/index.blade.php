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
            --cream: #f5f1e8;
            --white: #fffefa;
            --forest: #244b38;
            --forest-dark: #193a2b;
            --forest-soft: #edf1e8;
            --text: #26392e;
            --muted: #7b817a;
            --border: #e4e2d9;
            --danger: #a52f2f;
            --danger-soft: #fff1f1;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input, textarea { font: inherit; }

        .main {
            min-height: 100vh;
            margin-left: 250px;
            padding: 32px 38px 28px;
            animation: contentEnter .3s ease-out;
        }

        @keyframes contentEnter {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (prefers-reduced-motion: reduce) {
            .main { animation: none; }
        }

        .topbar { margin-bottom: 30px; }
        .page-title { font-size: 23px; font-weight: 800; letter-spacing: -.6px; }
        .page-subtitle { margin-top: 7px; color: var(--muted); font-size: 12px; line-height: 1.7; }

        .notif {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 18px; padding: 12px 15px;
            border-radius: 10px; font-size: 12px; line-height: 1.7;
            animation: notifEnter .25s ease-out;
        }
        .notif-success { border: 1px solid #cfe0cc; background: #edf5e9; color: #315b3d; }
        .notif-icon {
            display: inline-flex; align-items: center; justify-content: center;
            flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%;
            background: #d6e9d1; color: #315b3d; font-size: 12px; font-weight: 800;
        }
        @keyframes notifEnter {
            from { opacity: 0; transform: translateY(-5px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .akun-layout {
            display: grid;
            grid-template-columns: 290px minmax(0, 1fr);
            gap: 24px;
            align-items: start;
        }

        .akun-card {
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
        }

        .akun-profile {
            position: sticky;
            top: 24px;
            padding: 32px 24px 24px;
            text-align: center;
        }

        .akun-avatar {
            display: flex; align-items: center; justify-content: center;
            width: 88px; height: 88px; margin: 0 auto 16px;
            border: 4px solid var(--forest-soft); border-radius: 50%;
            background: var(--forest); color: #fff;
            font-size: 34px; font-weight: 800;
        }

        .akun-profile h2 { margin-bottom: 4px; font-size: 19px; line-height: 1.35; overflow-wrap: anywhere; }
        .akun-email { margin-bottom: 14px; color: var(--muted); font-size: 13px; overflow-wrap: anywhere; }

        .akun-role {
            display: inline-block; padding: 5px 12px; border-radius: 999px;
            background: var(--forest-soft); color: var(--forest);
            font-size: 12px; font-weight: 600;
        }

        .akun-meta { margin-top: 22px; padding-top: 16px; border-top: 1px solid var(--border); }
        .akun-meta div { display: flex; justify-content: space-between; gap: 12px; padding: 6px 0; font-size: 13px; }
        .akun-meta span:first-child { color: var(--muted); }
        .akun-meta span:last-child { font-weight: 600; text-align: right; overflow-wrap: anywhere; }

        .akun-stack { display: flex; flex-direction: column; gap: 24px; }
        .akun-panel { padding: 28px; }
        .akun-panel-title { margin-bottom: 4px; font-size: 17px; font-weight: 700; letter-spacing: -.3px; }
        .akun-panel-sub {
            margin-bottom: 22px; padding-bottom: 18px;
            border-bottom: 1px solid var(--border);
            color: var(--muted); font-size: 12px;
        }

        .akun-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
        .akun-group { display: flex; flex-direction: column; gap: 6px; min-width: 0; }
        .akun-group.wide { grid-column: 1 / -1; }
        .akun-group label { font-size: 13px; font-weight: 600; }

        .akun-control {
            width: 100%; height: 42px; padding: 0 13px;
            border: 1px solid var(--border); border-radius: 10px;
            background: var(--white); color: var(--text); font-size: 13px;
            transition: border-color .15s, box-shadow .15s;
        }
        .akun-control:hover { border-color: #cfccc0; }
        .akun-control:focus { border-color: #9bb39a; outline: none; box-shadow: 0 0 0 3px rgba(36,75,56,.07); }
        .akun-control.is-invalid { border-color: var(--danger); background: var(--danger-soft); }
        textarea.akun-control { height: auto; min-height: 96px; padding: 11px 13px; resize: vertical; line-height: 1.6; }

        .akun-pw { position: relative; width: 100%; }
        .akun-pw .akun-control { padding-right: 44px; }
        .akun-pw button {
            position: absolute; top: 50%; right: 8px; transform: translateY(-50%);
            display: flex; align-items: center; justify-content: center;
            width: 30px; height: 30px; padding: 0;
            border: 0; border-radius: 6px; background: transparent;
            color: var(--muted); cursor: pointer; transition: color .15s;
        }
        .akun-pw button:hover { color: var(--forest); }
        .akun-pw svg { display: block; width: 19px; height: 19px; }

        .akun-error { color: var(--danger); font-size: 12px; }

        .akun-footer {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 14px; margin-top: 22px;
        }
        .akun-note { flex: 1 1 240px; color: var(--muted); font-size: 12px; }

        .akun-submit {
            display: inline-flex; align-items: center; justify-content: center;
            min-height: 40px; padding: 10px 18px;
            border: 0; border-radius: 10px;
            background: var(--forest); color: #fff;
            font-size: 12px; font-weight: 700; cursor: pointer; transition: .2s;
        }
        .akun-submit:hover { background: var(--forest-dark); }

        .footer {
            margin-top: 35px; padding-top: 18px;
            border-top: 1px solid #e0ddd3;
            color: var(--muted); font-size: 11px; line-height: 1.7;
        }

        @media (max-width: 1000px) {
            .akun-layout { grid-template-columns: 1fr; }
            .akun-profile { position: static; }
        }

        @media (max-width: 900px) {
            .main { margin-left: 215px; padding: 28px 24px; }
        }

        @media (max-width: 620px) {
            .main { margin-left: 0; padding: 24px 17px; }
            .page-title { font-size: 21px; }
            .akun-panel { padding: 20px 16px; }
            .akun-grid { grid-template-columns: 1fr; }
            .akun-group.wide { grid-column: auto; }
            .akun-submit { width: 100%; }
        }
    </style>
</head>

<body>
    @include('admin.sidebar')

    <main class="main">
        <header class="topbar">
            <h1 class="page-title">Informasi Akun</h1>
            <p class="page-subtitle">Lihat informasi akun dan kelola data pribadimu.</p>
        </header>

        @if (session('success'))
            <div class="notif notif-success" role="status">
                <span class="notif-icon">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="akun-layout">

            {{-- KARTU PROFIL --}}
            <aside class="akun-card akun-profile">
                <div class="akun-avatar" aria-hidden="true">
                    {{ strtoupper(mb_substr($user->nama, 0, 1)) }}
                </div>

                <h2>{{ $user->nama }}</h2>
                <p class="akun-email">{{ $user->email }}</p>
                <span class="akun-role">{{ ucfirst($user->role) }}</span>

                <div class="akun-meta">
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

            <div class="akun-stack">

                {{-- EDIT PROFIL --}}
                <section class="akun-card akun-panel">
                    <h2 class="akun-panel-title">Edit Profil</h2>
                    <p class="akun-panel-sub">Perbarui informasi pribadi akunmu.</p>

                    <form action="{{ route('akun.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="akun-grid">
                            <div class="akun-group">
                                <label for="nama">Nama</label>
                                <input class="akun-control @error('nama') is-invalid @enderror"
                                       id="nama" type="text" name="nama"
                                       value="{{ old('nama', $user->nama) }}" required>
                                @error('nama') <span class="akun-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="akun-group">
                                <label for="email">Email</label>
                                <input class="akun-control @error('email') is-invalid @enderror"
                                       id="email" type="email" name="email"
                                       value="{{ old('email', $user->email) }}" required>
                                @error('email') <span class="akun-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="akun-group wide">
                                <label for="no_hp">Nomor HP</label>
                                <input class="akun-control @error('no_hp') is-invalid @enderror"
                                       id="no_hp" type="text" name="no_hp"
                                       value="{{ old('no_hp', $user->no_hp) }}">
                                @error('no_hp') <span class="akun-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="akun-group wide">
                                <label for="alamat">Alamat</label>
                                <textarea class="akun-control @error('alamat') is-invalid @enderror"
                                          id="alamat" name="alamat">{{ old('alamat', $user->alamat) }}</textarea>
                                @error('alamat') <span class="akun-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="akun-footer">
                            <button type="submit" class="akun-submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </section>

                {{-- KEAMANAN AKUN --}}
                <section class="akun-card akun-panel">
                    <h2 class="akun-panel-title">Keamanan Akun</h2>
                    <p class="akun-panel-sub">Ganti password secara berkala untuk menjaga keamanan akun.</p>

                    <form action="{{ route('akun.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="akun-grid">
                            @foreach ([
                                ['password_lama', 'Password Lama', 'current-password', true],
                                ['password_baru', 'Password Baru', 'new-password', false],
                                ['password_baru_confirmation', 'Konfirmasi Password Baru', 'new-password', false],
                            ] as [$name, $label, $auto, $wide])
                                <div class="akun-group {{ $wide ? 'wide' : '' }}">
                                    <label for="{{ $name }}">{{ $label }}</label>

                                    <div class="akun-pw">
                                        <input class="akun-control @error($name) is-invalid @enderror"
                                               type="password" id="{{ $name }}" name="{{ $name }}"
                                               autocomplete="{{ $auto }}" required>

                                        <button type="button" class="akun-toggle-pw"
                                                data-target="{{ $name }}"
                                                aria-label="Tampilkan password">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="1.8" stroke-linecap="round"
                                                 stroke-linejoin="round" aria-hidden="true">
                                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </button>
                                    </div>

                                    @error($name) <span class="akun-error">{{ $message }}</span> @enderror
                                </div>
                            @endforeach
                        </div>

                        <div class="akun-footer">
                            <p class="akun-note">
                                Password baru minimal 8 karakter dan harus sama dengan konfirmasi password.
                            </p>
                            <button type="submit" class="akun-submit">Simpan Password</button>
                        </div>
                    </form>
                </section>

            </div>
        </div>

        <footer class="footer">
            CampRent — Sistem Informasi Persewaan Alat Camping
        </footer>
    </main>

    <script>
        const iconTampil = '<path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>';
        const iconSembunyi = '<path d="M3 3l18 18"/><path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/><path d="M9.9 5.2A11 11 0 0 1 12 5c6.4 0 10 7 10 7a15.5 15.5 0 0 1-4 4.7"/><path d="M6.6 6.6C3.7 8.5 2 12 2 12s3.6 7 10 7a10.7 10.7 0 0 0 3.4-.6"/>';

        document.querySelectorAll('.akun-toggle-pw').forEach(button => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.target);
                if (!input) return;

                const hidden = input.type === 'password';
                input.type = hidden ? 'text' : 'password';

                button.setAttribute('aria-label', hidden ? 'Sembunyikan password' : 'Tampilkan password');
                button.querySelector('svg').innerHTML = hidden ? iconSembunyi : iconTampil;
            });
        });
    </script>
</body>
</html>