<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - CampRent</title>

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
            min-height: 650px;
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
            padding: 40px 55px;
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
            margin-bottom: 27px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .error {
            display: grid;
            gap: 6px;
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #f0caca;
            border-radius: 9px;
            background: #fff0f0;
            color: #a52f2f;
            font-size: 12px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .field input {
            display: block;
            width: 100%;
            min-width: 0;
            min-height: 46px;
            padding: 12px 14px;
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

        .submit-btn {
            width: 100%;
            min-height: 48px;
            margin-top: 5px;
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

        .link {
            margin-top: 23px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            text-align: center;
            font-size: 13px;
            line-height: 1.8;
        }

        .link a {
            color: var(--forest);
            font-weight: 600;
            text-decoration: none;
        }

        .link a:hover {
            color: var(--forest-dark);
            text-decoration: underline;
        }

        /* Laptop dan tablet */
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
                padding: 35px;
            }

            .visual-bottom h2 {
                font-size: 27px;
            }
        }

        /* HP dan tablet portrait */
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
                padding: 32px 26px;
            }

            .mobile-brand {
                display: block;
                margin-bottom: 28px;
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
                margin-bottom: 24px;
                font-size: 13px;
            }

            .field {
                margin-bottom: 16px;
            }
        }

        /* HP kecil */
        @media (max-width: 380px) {
            body {
                padding: 12px;
            }

            .container {
                border-radius: 14px;
            }

            .form-panel {
                padding: 26px 18px;
            }

            .mobile-brand {
                margin-bottom: 24px;
            }

            .form-panel h1 {
                font-size: 23px;
            }

            .link {
                font-size: 12px;
            }
        }

        /* Desktop dengan layar pendek */
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
                min-height: 560px;
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
            <h2>Siapkan perlengkapan, mulai petualanganmu.</h2>
            <p>
                Buat akun CampRent dan temukan perlengkapan
                camping untuk menemani perjalananmu.
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

        <h1>Buat akun baru</h1>
        <p class="subtitle">
            Daftar sekarang untuk mulai menyewa
            alat camping dengan mudah.
        </p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <div class="field">
                <label for="nama">Nama lengkap</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    required
                >
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="field">
                <label for="no_hp">Nomor HP</label>
                <input
                    type="tel"
                    id="no_hp"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="Contoh: 081234567890"
                    pattern="[0-9]*"
                    inputmode="numeric"
                    autocomplete="tel"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required
                >
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Buat password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="field">
                <label for="password_confirmation">Konfirmasi password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="submit-btn">
                Daftar
            </button>
        </form>

        <div class="link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </div>

    </main>
</div>

</body>
</html>