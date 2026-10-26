<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - CampRent</title>

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
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
            background: var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        .container {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            width: 100%;
            max-width: 1000px;
            min-width: 0;
            overflow: hidden;
            background: var(--white);
            border: 1px solid rgba(36, 75, 56, 0.08);
            border-radius: 22px;
            box-shadow: 0 18px 50px rgba(38, 57, 46, 0.10);
        }

        .visual {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-width: 0;
            min-height: 590px;
            padding: 38px;
            color: white;
            background:
                linear-gradient(180deg, rgba(17, 45, 34, 0.35), rgba(12, 34, 23, 0.85)),
                url('https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=1200&q=85') center / cover;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .brand-icon {
            font-size: 32px;
        }

        .tagline {
            margin-top: 8px;
            color: #e4e9df;
            font-size: 12px;
            letter-spacing: 2px;
        }

        .visual-bottom h2 {
            max-width: 310px;
            margin-bottom: 14px;
            font-size: 30px;
            line-height: 1.3;
        }

        .visual-bottom p {
            max-width: 310px;
            color: #e5e9e1;
            font-size: 14px;
            line-height: 1.8;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 28px;
            font-size: 12px;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
            padding: 55px 60px;
        }

        .mobile-brand {
            display: none;
        }

        .form-panel h1 {
            margin-bottom: 10px;
            font-size: 29px;
            letter-spacing: -1px;
            line-height: 1.35;
        }

        .subtitle {
            margin-bottom: 32px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .error {
            margin-bottom: 20px;
            padding: 12px 14px;
            border: 1px solid #f0caca;
            border-radius: 9px;
            background: #fff0f0;
            color: #a52f2f;
            font-size: 13px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: 600;
        }

        .field input {
            display: block;
            width: 100%;
            min-width: 0;
            min-height: 48px;
            padding: 13px 15px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--white);
            color: var(--text);
            font: inherit;
            font-size: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input::placeholder {
            color: #a0a39c;
        }

        .field input:focus {
            border-color: var(--forest);
            box-shadow: 0 0 0 3px rgba(36, 75, 56, 0.10);
        }

        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            padding: 0;
            border: none;
            border-radius: 6px;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
            transform: translateY(-50%);
        }

        .toggle-password:hover {
            color: var(--forest);
        }

        .toggle-password:focus-visible {
            outline: 2px solid var(--forest);
            outline-offset: 2px;
        }

        .toggle-password svg {
            display: block;
            width: 20px;
            height: 20px;
        }

        .password-options {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 2px 0 27px;
            font-size: 13px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--forest);
        }

        a {
            color: var(--forest);
            font-weight: 600;
            text-decoration: none;
        }

        a:hover {
            color: var(--forest-dark);
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            min-height: 48px;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: var(--forest);
            color: white;
            font: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .submit-btn:hover {
            background: var(--forest-dark);
            transform: translateY(-1px);
        }

        .register-link {
            margin-top: 27px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            text-align: center;
            font-size: 13px;
            line-height: 1.8;
        }

        @media (max-width: 1000px) {
            body {
                padding: 24px;
            }

            .container {
                max-width: 850px;
                grid-template-columns: 0.85fr 1.15fr;
            }

            .visual {
                padding: 30px;
            }

            .form-panel {
                padding: 42px 35px;
            }

            .visual-bottom h2 {
                font-size: 27px;
            }
        }

        @media (max-width: 760px) {
            body {
                align-items: flex-start;
                padding: 20px 16px;
            }

            .container {
                display: grid;
                grid-template-columns: minmax(0, 1fr);
                width: 100%;
                max-width: 480px;
                min-height: 0;
                margin: auto;
                border-radius: 18px;
            }

            .visual {
                display: none;
            }

            .form-panel {
                width: 100%;
                padding: 34px 26px;
            }

            .mobile-brand {
                display: block;
                margin-bottom: 30px;
                color: var(--forest);
                text-align: center;
            }

            .mobile-brand .brand {
                justify-content: center;
                font-size: 26px;
            }

            .mobile-brand .tagline {
                color: var(--muted);
                font-size: 10px;
                letter-spacing: 1.5px;
            }

            .form-panel h1 {
                font-size: 25px;
            }

            .subtitle {
                margin-bottom: 25px;
                font-size: 13px;
            }

            .field {
                margin-bottom: 18px;
            }
        }

        @media (max-width: 380px) {
            body {
                padding: 12px;
            }

            .container {
                border-radius: 14px;
            }

            .form-panel {
                padding: 28px 18px;
            }

            .mobile-brand {
                margin-bottom: 25px;
            }

            .form-panel h1 {
                font-size: 23px;
            }

            .password-options {
                flex-wrap: wrap;
            }

            .register-link {
                font-size: 12px;
            }
        }

        @media (min-width: 761px) and (max-height: 700px) {
            body {
                align-items: flex-start;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .container {
                min-height: 0;
            }

            .visual {
                min-height: 540px;
            }

            .form-panel {
                padding-top: 30px;
                padding-bottom: 30px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <aside class="visual">
        <div>
            <div class="brand">
                <span class="brand-icon">⌁</span>
                CampRent
            </div>
            <p class="tagline">EXPLORE MORE, RENT BETTER</p>
        </div>

        <div class="visual-bottom">
            <h2>Petualanganmu dimulai dari sini.</h2>
            <p>
                Temukan perlengkapan camping yang kamu butuhkan
                dan nikmati perjalanan bersama alam.
            </p>

            <div class="features">
                <span>△ Mudah</span>
                <span>♧ Aman</span>
                <span>✓ Terpercaya</span>
            </div>
        </div>
    </aside>

    <main class="form-panel">

        <div class="mobile-brand">
            <div class="brand">
                <span class="brand-icon">⌁</span>
                CampRent
            </div>
            <p class="tagline">EXPLORE MORE, RENT BETTER</p>
        </div>

        <h1>Selamat datang kembali!</h1>
        <p class="subtitle">
            Masuk ke akun kamu untuk melanjutkan
            petualangan dan menyewa alat camping.
        </p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email kamu"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="field">
                <label for="password">Password</label>

                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                    >
                        <svg
                            id="eyeIcon"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="password-options">
                <label class="remember">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="submit-btn">
                Masuk
            </button>
        </form>

        <div class="register-link">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

    </main>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';

        togglePassword.setAttribute(
            'aria-label',
            isHidden ? 'Sembunyikan password' : 'Tampilkan password'
        );

        togglePassword.setAttribute('aria-pressed', String(isHidden));

        eyeIcon.innerHTML = isHidden
            ? `
                <path d="M3 3l18 18"/>
                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                <path d="M9.9 5.2A11 11 0 0 1 12 5c6.4 0 10 7 10 7a15.5 15.5 0 0 1-4 4.7"/>
                <path d="M6.6 6.6C3.7 8.5 2 12 2 12s3.6 7 10 7a10.7 10.7 0 0 0 3.4-.6"/>
            `
            : `
                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
            `;
    });
</script>

</body>
</html>