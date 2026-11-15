<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampRent - Persewaan Alat Camping</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f2f6f1;
            --white: #ffffff;
            --forest: #244b38;
            --forest-dark: #193a2b;
            --forest-deep: #122b20;
            --forest-soft: #e9f0e8;
            --sage: #d5dfc8;
            --text: #26392e;
            --muted: #6f7f74;
            --border: #e0e7de;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-padding-top: 90px;
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--white);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        ul { list-style: none; }
        button, input, select { font: inherit; }

        :focus-visible {
            outline: 2px solid var(--forest);
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            * { transition: none !important; }
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
            border-bottom: 1px solid transparent;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(14px);
            transition: box-shadow .25s, border-color .25s;
        }

        .navbar.scrolled {
            border-color: var(--border);
            box-shadow: 0 6px 24px rgba(38, 57, 46, .07);
        }

        .navbar-inner {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 26px;
            width: 100%;
            margin: 0;
            padding: 13px 3%;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-shrink: 0;
            color: var(--forest);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .brand-icon { font-size: 29px; }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .nav-link {
            padding: 9px 16px;
            color: #5d6f63;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            transition: color .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--forest);
        }

        .nav-mobile-only,
        .nav-tiny-only,
        .nav-mobile-account {
            display: none;
        }

        .nav-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            border: 0;
            background: transparent;
            color: #eb533f;
            font-family: inherit;
            cursor: pointer;
        }

        .nav-logout:hover { color: #c93a27; }

        .nav-mobile-account .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-mobile-account svg {
            width: 19px;
            height: 19px;
            flex-shrink: 0;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .nav-login {
            padding: 10px 16px;
            border: 1px solid var(--border);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            transition: background .2s, border-color .2s;
        }

        .nav-login:hover {
            border-color: #c9cfc2;
            background: var(--forest-soft);
        }

        .nav-name {
            max-width: 110px;
            overflow: hidden;
            font-size: 13px;
            font-weight: 600;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .nav-toggle {
            display: none;
            place-items: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--white);
            color: var(--forest);
            cursor: pointer;
        }

        .nav-toggle svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
        }

        .nav-toggle .icon-close { display: none; }
        .navbar.open .nav-toggle .icon-open { display: none; }
        .navbar.open .nav-toggle .icon-close { display: block; }

        .account-dropdown-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .account-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 8px 5px 5px;
            border: 1px solid transparent;
            border-radius: 30px;
            background: transparent;
            cursor: pointer;
            transition: background .2s;
        }

        .account-dropdown-toggle:hover,
        .account-dropdown-wrapper.show .account-dropdown-toggle {
            background: var(--forest-soft);
        }

        .nav-account {
            display: grid;
            place-items: center;
            flex-shrink: 0;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e7eee4;
            color: var(--forest);
            font-size: 15px;
            font-weight: 800;
        }

        .dropdown-arrow {
            width: 15px;
            height: 15px;
            color: var(--muted);
            transition: transform .2s;
        }

        .account-dropdown-wrapper.show .dropdown-arrow {
            transform: rotate(180deg);
        }

        .account-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            z-index: 101;
            width: 220px;
            padding: 7px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--white);
            box-shadow: 0 10px 30px rgba(38, 57, 46, .12);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: opacity .2s ease, transform .2s ease, visibility .2s;
        }

        .account-dropdown-wrapper.show .account-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 12px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: var(--text);
            font-size: 12px;
            font-weight: 600;
            text-align: left;
            cursor: pointer;
            transition: background .2s;
        }

        .dropdown-item:hover { background: #eef3ec; }

        .dropdown-item svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            color: var(--muted);
        }

        .dropdown-divider {
            height: 1px;
            margin: 5px 4px;
            background: var(--border);
        }

        .nav-form { margin: 0; }

        .dropdown-logout {
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            color: #eb533f;
            font-size: 13px;
        }

        .dropdown-logout:hover { background: #f8eeeb; }

        .dropdown-logout svg {
            display: block;
            width: 20px;
            height: 20px;
            color: #eb533f;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .nav-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 17px;
            border-radius: 9px;
            background: var(--forest);
            color: white;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            transition: background .2s;
        }

        .nav-cta:hover { background: var(--forest-dark); }

        .hero {
            position: relative;
            padding: 110px 6% 150px;
            background:
                linear-gradient(95deg, rgba(18, 43, 32, .95) 0%, rgba(25, 58, 43, .8) 55%, rgba(25, 58, 43, .45) 100%),
                url('https://images.unsplash.com/photo-1631635589499-afd87d52bf64?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D') center 55% / cover;
            color: white;
        }

        .hero-content { max-width: 700px; }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
            padding: 8px 14px;
            border: 1px solid rgba(255, 255, 255, .28);
            border-radius: 30px;
            background: rgba(255, 255, 255, .06);
            color: #e2eadf;
            font-size: 12px;
            font-weight: 600;
        }

        .hero-label::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #9fd3a8;
        }

        .hero h1 {
            margin-bottom: 22px;
            font-size: clamp(36px, 5.6vw, 64px);
            line-height: 1.1;
            letter-spacing: -2.2px;
        }

        .hero h1 span {
            display: block;
            color: var(--sage);
        }

        .hero p {
            max-width: 540px;
            margin-bottom: 34px;
            color: #e3e9df;
            font-size: 16px;
            line-height: 1.85;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 13px;
        }

        .hero-primary,
        .hero-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            transition: transform .2s, background .2s;
        }

        .hero-primary {
            padding: 15px 24px;
            background: var(--white);
            color: var(--forest);
        }

        .hero-primary:hover { transform: translateY(-2px); }

        .hero-secondary {
            padding: 14px 23px;
            border: 1px solid rgba(255, 255, 255, .4);
            color: white;
            font-weight: 600;
        }

        .hero-secondary:hover { background: rgba(255, 255, 255, .1); }

        .benefits-wrap {
            position: relative;
            z-index: 2;
            padding: 0 6%;
            margin-top: -76px;
        }

        .benefits {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            max-width: 1240px;
            margin: 0 auto;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: var(--white);
            box-shadow: 0 18px 44px rgba(18, 43, 32, .14);
        }

        .benefit {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 28px 26px;
        }

        .benefit + .benefit { border-left: 1px solid var(--border); }

        .benefit-icon {
            display: grid;
            place-items: center;
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            border-radius: 13px;
            background: var(--forest-soft);
            color: var(--forest);
        }

        .benefit-icon svg,
        .step-icon svg,
        .contact-list svg {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .benefit h3 { margin-bottom: 6px; font-size: 15px; }
        .benefit p { color: var(--muted); font-size: 13px; line-height: 1.7; }

        .section {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 90px 28px 0;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 32px;
        }

        .section-header.center {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .section-header h2 {
            margin-bottom: 10px;
            font-size: clamp(26px, 3.2vw, 36px);
            letter-spacing: -1.2px;
        }

        .section-header p {
            max-width: 520px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .product-count {
            flex-shrink: 0;
            padding: 9px 13px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--muted);
            font-size: 12px;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            counter-reset: step;
        }

        .step {
            position: relative;
            padding: 26px 22px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--cream);
        }

        .step-icon {
            display: grid;
            place-items: center;
            width: 46px;
            height: 46px;
            margin-bottom: 18px;
            border-radius: 12px;
            background: var(--forest);
            color: white;
        }

        .step::after {
            counter-increment: step;
            content: counter(step);
            position: absolute;
            top: 20px;
            right: 22px;
            color: #cbd9c8;
            font-size: 34px;
            font-weight: 800;
            line-height: 1;
        }

        .step h3 { margin-bottom: 8px; font-size: 15px; }
        .step p { color: var(--muted); font-size: 13px; line-height: 1.75; }

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .toolbar-title { font-size: 13px; font-weight: 600; }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            width: min(100%, 650px);
        }

        .search-form {
            display: flex;
            flex: 1 1 280px;
            min-width: 0;
        }

        .search-form input,
        .filter-form select {
            height: 42px;
            padding: 0 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--white);
            color: var(--text);
            font-size: 13px;
        }

        .search-form input { width: 100%; min-width: 0; }

        .filter-form select {
            flex: 0 1 180px;
            min-width: 150px;
            cursor: pointer;
        }

        .search-form input:focus,
        .filter-form select:focus {
            border-color: #9bb39a;
            box-shadow: 0 0 0 3px rgba(36, 75, 56, .07);
        }

        .btn-reset {
            min-height: 42px;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--white);
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-reset:hover {
            background: #eff4ee;
            color: var(--forest);
        }

        .empty-state {
            padding: 52px 20px;
            border: 1px dashed #cbd2c5;
            border-radius: 16px;
            background: var(--cream);
            text-align: center;
        }

        .empty-icon { margin-bottom: 14px; font-size: 34px; }
        .empty-state h3 { margin-bottom: 8px; font-size: 18px; }
        .empty-state p { color: var(--muted); font-size: 13px; line-height: 1.8; }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            transition: transform .2s, box-shadow .2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(38, 57, 46, .08);
        }

        .product-illustration {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 210px;
            margin: 15px 18px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fff;
        }

        .product-illustration img {
            width: 100%;
            height: 100%;
            padding: 8px;
            object-fit: contain;
        }

        .no-image { color: var(--muted); font-size: 12px; text-align: center; }

        .product-info {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding: 0 18px 18px;
        }

        .product-info h3 {
            margin-bottom: 9px;
            font-size: 16px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .stock { margin-bottom: 17px; color: var(--muted); font-size: 12px; }
        .stock.available { color: var(--forest); }
        .stock.empty { color: #a52f2f; }

        .product-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .price-label { margin-bottom: 6px; color: var(--muted); font-size: 10px; }

        .price {
            color: var(--forest);
            font-size: 17px;
            font-weight: 800;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .price span { font-size: 10px; font-weight: 500; }

        .rent-btn {
            display: inline-flex;
            align-items: center;
            flex-shrink: 0;
            padding: 10px 13px;
            border-radius: 8px;
            background: var(--forest);
            color: white;
            font-size: 11px;
            font-weight: 700;
        }

        .rent-btn:hover { background: var(--forest-dark); }

        .cta-wrap { padding: 90px 28px 90px; }

        .cta {
            position: relative;
            overflow: hidden;
            max-width: 1240px;
            margin: 0 auto;
            padding: 64px 6%;
            border-radius: 24px;
            color: white;
            text-align: center;
            background:
                linear-gradient(rgba(25, 58, 43, .92), rgba(18, 43, 32, .95)),
                url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=1600&q=80') center / cover;
        }

        .cta h2 {
            max-width: 620px;
            margin: 0 auto 14px;
            font-size: clamp(26px, 3.6vw, 40px);
            line-height: 1.2;
            letter-spacing: -1.2px;
        }

        .cta p {
            max-width: 500px;
            margin: 0 auto 28px;
            color: #dbe3d6;
            font-size: 15px;
            line-height: 1.8;
        }

        .cta .hero-actions { justify-content: center; }

        .footer { background: var(--forest-deep); color: #c9d3c5; }

        .footer-inner {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1.3fr;
            gap: 48px;
            max-width: 1240px;
            margin: 0 auto;
            padding: 68px 28px 48px;
        }

        .footer .brand { margin-bottom: 18px; color: white; }
        .footer-about { max-width: 320px; font-size: 13px; line-height: 1.85; }
        .footer h4 { margin-bottom: 18px; color: white; font-size: 14px; }
        .footer-links { display: grid; gap: 12px; font-size: 13px; }

        .footer-links a { transition: color .2s, padding .2s; }

        .footer-links a:hover {
            padding-left: 4px;
            color: white;
        }

        .contact-list {
            display: grid;
            gap: 14px;
            font-size: 13px;
            line-height: 1.6;
        }

        .contact-list li { display: flex; align-items: flex-start; gap: 11px; }
        .contact-list a { transition: color .2s; }

        .contact-list a:hover {
            color: white;
            text-decoration: underline;
        }

        .contact-list svg {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            color: var(--sage);
        }

        .footer-bottom { border-top: 1px solid rgba(255, 255, 255, .1); }

        .footer-bottom-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            max-width: 1240px;
            margin: 0 auto;
            padding: 22px 28px;
            color: #93a28f;
            font-size: 12px;
        }

        @media (max-width: 1000px) {
            .steps { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .footer-inner { grid-template-columns: 1fr 1fr; gap: 40px; }
        }

        @media (max-width: 900px) {
            .navbar-inner {
                display: flex;
                justify-content: space-between;
                gap: 14px;
                padding: 12px 20px;
            }

            .nav-toggle { display: grid; }

            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                display: none;
                flex-direction: column;
                align-items: stretch;
                gap: 2px;
                margin: 0;
                padding: 10px 20px 18px;
                border-bottom: 1px solid var(--border);
                background: var(--white);
                box-shadow: 0 16px 30px rgba(38, 57, 46, .1);
            }

            .navbar.open .nav-links { display: flex; }

            .nav-mobile-account {
                display: flex;
                flex-direction: column;
                gap: 2px;
                margin-top: 8px;
                padding-top: 8px;
                border-top: 1px solid var(--border);
            }

            .account-dropdown-wrapper { display: none; }

            .nav-link {
                padding: 13px 4px;
                text-align: left;
            }

            .nav-logout { justify-content: flex-start; }
            .hero { padding: 80px 5% 130px; }
            .benefits-wrap { padding: 0 5%; }
            .benefits { grid-template-columns: 1fr; }

            .benefit + .benefit {
                border-top: 1px solid var(--border);
                border-left: 0;
            }

            .product-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .filter-form { width: 100%; max-width: none; }
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
            .hero { padding: 64px 6% 120px; }
            .hero h1 { font-size: 38px; letter-spacing: -1.5px; }
            .section { padding: 64px 20px 0; }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .section-header.center { align-items: center; }

            .steps, .product-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 15px;
            }

            .filter-form { align-items: stretch; }

            .filter-form select,
            .search-form {
                flex: 1 1 100%;
                width: 100%;
            }

            .cta-wrap { padding: 64px 20px; }
            .cta { padding: 48px 6%; border-radius: 18px; }
            .footer-inner { grid-template-columns: 1fr; gap: 34px; padding: 52px 20px 36px; }
            .footer-bottom-inner { padding: 20px; }
        }
    </style>
</head>

<body>

    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-icon">⌁</span>
                CampRent
            </a>

            <div class="nav-links" id="nav-links">
                <a href="#beranda" class="nav-link active" id="nav-home">Beranda</a>
                <a href="#cara-sewa" class="nav-link">Cara Sewa</a>
                <a href="#daftar-barang" class="nav-link">Perlengkapan</a>
                <a href="#kontak" class="nav-link">Kontak</a>

                @guest
                    <a href="{{ route('login') }}" class="nav-link nav-mobile-only">Login</a>
                    <a href="{{ route('register') }}" class="nav-link nav-tiny-only">Daftar</a>
                @endguest

                @auth
                    <div class="nav-mobile-account">
                        <a href="{{ route('akun.index') }}" class="nav-link">
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

    @if (session('success'))
        <div id="toast" style="position:fixed;top:84px;right:24px;z-index:200;max-width:380px;padding:14px 18px;border:1px solid #c8dccb;border-radius:12px;background:#f1f8f2;color:#244b38;font-size:13px;font-weight:600;box-shadow:0 10px 30px rgba(38,57,46,.15);">
            ✓ {{ session('success') }}
        </div>
        <script>
            setTimeout(() => document.getElementById('toast')?.remove(), 5000);
        </script>
    @endif

    <section class="hero" id="beranda">
        <div class="hero-content">
            <div class="hero-label">Persewaan Alat Camping Online</div>

            <h1>
                Petualangan seru dimulai dari
                <span>perlengkapan yang tepat.</span>
            </h1>

            <p>
                Sewa tenda, carrier, kompor, dan perlengkapan camping lainnya tanpa harus membeli.
                Lihat stok dan harga langsung, lalu pilih yang kamu butuhkan.
            </p>

            <div class="hero-actions">
                <a href="#daftar-barang" class="hero-primary">Lihat perlengkapan → </a>

                @guest
                    <a href="{{ route('register') }}" class="hero-secondary">Buat akun</a>
                @endguest
            </div>
        </div>
    </section>

    <div class="benefits-wrap">
        <section class="benefits">
            <div class="benefit">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 20 12 4l9 16H3Z" /><path d="M12 20v-6" /></svg>
                </div>
                <div>
                    <h3>Perlengkapan lengkap</h3>
                    <p>Dari tenda sampai alat masak, semua ada untuk menemani perjalananmu.</p>
                </div>
            </div>

            <div class="benefit">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2v20" /><path d="M17 6.5c-.8-1.4-2.6-2-5-2-2.8 0-4.5 1.1-4.5 3s1.7 2.6 4.5 3 4.5 1.1 4.5 3-1.7 3-4.5 3c-2.4 0-4.2-.6-5-2" /></svg>
                </div>
                <div>
                    <h3>Harga jelas per hari</h3>
                    <p>Tarif sewa dan stok terlihat langsung, tanpa perlu bertanya satu per satu.</p>
                </div>
            </div>

            <div class="benefit">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 5 5L20 7" /></svg>
                </div>
                <div>
                    <h3>Proses praktis</h3>
                    <p>Pilih barang, cek detail, dan siapkan perjalananmu dalam beberapa langkah.</p>
                </div>
            </div>
        </section>
    </div>

    <section class="section" id="cara-sewa">
        <div class="section-header center">
            <div>
                <h2>Menyewa itu mudah</h2>
                <p>Empat langkah singkat dari memilih alat sampai siap berangkat.</p>
            </div>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7" /><path d="m20 20-3.5-3.5" /></svg></div>
                <h3>Cari perlengkapan</h3>
                <p>Telusuri daftar alat atau saring berdasarkan kategori.</p>
            </div>
            <div class="step">
                <div class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="3" width="16" height="18" rx="2" /><path d="M8 8h8M8 12h8M8 16h5" /></svg></div>
                <h3>Cek detail barang</h3>
                <p>Lihat foto, stok, dan harga sewa per hari.</p>
            </div>
            <div class="step">
                <div class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M16 3v4M8 3v4M3 10h18" /></svg></div>
                <h3>Ajukan sewa</h3>
                <p>Masuk ke akunmu, pilih tanggal, lalu kirim pesanan.</p>
            </div>
            <div class="step">
                <div class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 20 12 4l9 16H3Z" /><path d="M12 20v-6" /></svg></div>
                <h3>Berangkat camping</h3>
                <p>Ambil perlengkapanmu dan nikmati alam.</p>
            </div>
        </div>
    </section>

    <main class="section" id="daftar-barang" style="flex:1;">

        <div class="section-header">
            <div>
                <h2>Daftar Alat Camping</h2>
                <p>Temukan perlengkapan yang kamu butuhkan untuk petualangan berikutnya.</p>
            </div>

            <div class="product-count" id="jumlah-barang">
                {{ $barang->count() }} barang terdaftar
            </div>
        </div>

        <div class="toolbar">
            <div class="toolbar-title"></div>

            <form action="{{ url('/') }}" method="GET" id="form-pencarian" class="filter-form">
                <select name="kategori" id="filter-kategori" aria-label="Pilih kategori">
                    <option value="">Semua Kategori</option>

                    @foreach ($kategori as $itemKategori)
                        <option value="{{ $itemKategori->id_kategori }}"
                            @selected((string) ($kategoriDipilih ?? '') === (string) $itemKategori->id_kategori)>
                            {{ $itemKategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                <div class="search-form">
                    <input type="text" name="cari" id="cari-barang" placeholder="Cari nama barang..."
                        value="{{ $cari ?? request('cari') }}" autocomplete="off">
                </div>

                <button type="button" class="btn-reset" id="btn-reset">Reset</button>
            </form>
        </div>

        <div id="hasil-barang">
            @if ($barang->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">⌂</div>
                    <h3>Barang tidak ditemukan</h3>
                    <p>Coba gunakan kata kunci atau kategori yang berbeda.</p>
                </div>
            @else
                <div class="product-grid">
                    @foreach ($barang as $item)
                        <article class="product-card">
                            <div class="product-illustration">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama_barang }}" loading="lazy">
                                @else
                                    <span class="no-image">Foto belum tersedia</span>
                                @endif
                            </div>

                            <div class="product-info">
                                <h3>{{ $item->nama_barang }}</h3>

                                @if ($item->stok > 0)
                                    <p class="stock available">✓ Stok tersedia: {{ $item->stok }}</p>
                                @else
                                    <p class="stock empty">Stok sedang habis</p>
                                @endif

                                <div class="product-bottom">
                                    <div>
                                        <p class="price-label">Harga sewa</p>
                                        <p class="price">
                                            Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                                            <span>/ hari</span>
                                        </p>
                                    </div>

                                    <a href="{{ route('barang.detail', $item->id_barang) }}" class="rent-btn">Lihat Detail</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <!-- CTA -->
    <div class="cta-wrap">
        <section class="cta">
            <h2>Siap naik gunung akhir pekan ini?</h2>
            <p>Pilih perlengkapanmu sekarang, biar kamu bisa fokus menikmati perjalanan.</p>

            <div class="hero-actions">
                <a href="#daftar-barang" class="hero-primary">Pilih perlengkapan</a>

                @guest
                    <a href="{{ route('register') }}" class="hero-secondary">Daftar</a>
                @endguest
            </div>
        </section>
    </div>

    <footer class="footer" id="kontak">
        <div class="footer-inner">
            <div>
                <a href="{{ url('/') }}" class="brand"><span class="brand-icon">⌁</span>CampRent</a>
                <p class="footer-about">
                    Sistem informasi persewaan alat camping. Siapkan perlengkapanmu, nikmati petualanganmu.
                </p>
            </div>

            <div>
                <h4>Jelajahi</h4>
                <ul class="footer-links">
                    <li><a href="#cara-sewa">Cara menyewa</a></li>
                    <li><a href="#daftar-barang">Daftar perlengkapan</a></li>
                </ul>
            </div>

            <div>
                <h4>Akun</h4>
                <ul class="footer-links">
                    @auth
                        <li><a href="{{ route('akun.index') }}">Informasi akun</a></li>
                        @if (Auth::user()->role === 'pelanggan')
                            <li><a href="{{ route('penyewaan.riwayat') }}">Riwayat penyewaan</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>

            <div>
                <h4>Hubungi kami</h4>
                <ul class="contact-list">
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z" /><circle cx="12" cy="10" r="2.5" /></svg>
                        <span>Surakarta, Indonesia</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="m3 7 9 6 9-6" /></svg>
                        <span>sewa@camprent.id</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 21l1.7-5A8.5 8.5 0 1 1 8 19.3L3 21Z" /><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5l1.2-1.4-2-1-.8.8c-.9-.4-1.7-1.2-2.1-2.1l.8-.8-1-2L9 9.5Z" /></svg>
                        <a href="https://wa.me/6281567906262?text=Halo%20CampRent%2C%20saya%20ingin%20menyewa%20perlengkapan%20camping"
                            target="_blank" rel="noopener">WhatsApp: 0815-6790-6262</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" /></svg>
                        <span>Setiap hari, 08.00 – 20.00</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <span>© {{ date('Y') }} CampRent. Hak cipta dilindungi.</span>
            </div>
        </div>
    </footer>

    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }

        if (window.location.hash === '#daftar-barang') {
            setTimeout(function () {
                history.replaceState(null, null, window.location.pathname + window.location.search);
            }, 100);
        } else {
            window.scrollTo(0, 0);
        }

        document.addEventListener('DOMContentLoaded', function () {

            const dropdown = document.getElementById('accountDropdown');
            const toggle = document.getElementById('account-toggle');

            if (dropdown && toggle) {
                toggle.addEventListener('click', function (event) {
                    event.stopPropagation();

                    const isOpen = dropdown.classList.toggle('show');
                    toggle.setAttribute('aria-expanded', isOpen);
                });

                document.addEventListener('click', function (event) {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        dropdown.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                        toggle.focus();
                    }
                });
            }

            const navbar = document.getElementById('navbar');
            const navToggle = document.getElementById('nav-toggle');

            const navHome = document.getElementById('nav-home');

            const navLinks = document.querySelectorAll(
                '#nav-links > .nav-link[href^="#"]:not(#nav-home)'
            );

            const allMainNavLinks = document.querySelectorAll(
                '#nav-links > .nav-link[href^="#"]'
            );

            function setActiveLink(id) {
                allMainNavLinks.forEach(function (link) {
                    link.classList.toggle(
                        'active',
                        link.getAttribute('href') === '#' + id
                    );
                });
            }

            const onScroll = function () {
                navbar.classList.toggle('scrolled', window.scrollY > 8);

                if (window.scrollY < 100) {
                    setActiveLink('beranda');
                }
            };

            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });

            if (navToggle) {
                navToggle.addEventListener('click', function () {
                    const isOpen = navbar.classList.toggle('open');
                    navToggle.setAttribute('aria-expanded', isOpen);
                });
            }

            document.addEventListener('click', function (event) {
                if (!navbar.contains(event.target)) {
                    navbar.classList.remove('open');

                    if (navToggle) {
                        navToggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && navbar.classList.contains('open')) {
                    navbar.classList.remove('open');

                    if (navToggle) {
                        navToggle.setAttribute('aria-expanded', 'false');
                        navToggle.focus();
                    }
                }
            });

            if (navHome) {
                navHome.addEventListener('click', function (event) {
                    event.preventDefault();

                    setActiveLink('beranda');

                    navbar.classList.remove('open');

                    if (navToggle) {
                        navToggle.setAttribute('aria-expanded', 'false');
                    }

                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    navbar.classList.remove('open');

                    if (navToggle) {
                        navToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            });

            if ('IntersectionObserver' in window) {
                const spy = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (!entry.isIntersecting) return;

                        if (window.scrollY < 100) {
                            setActiveLink('beranda');
                            return;
                        }

                        setActiveLink(entry.target.id);
                    });
                }, {
                    rootMargin: '-40% 0px -55% 0px'
                });

                ['cara-sewa', 'daftar-barang', 'kontak'].forEach(function (id) {
                    const el = document.getElementById(id);

                    if (el) {
                        spy.observe(el);
                    }
                });
            }

            const form = document.getElementById('form-pencarian');
            const input = document.getElementById('cari-barang');
            const filterKategori = document.getElementById('filter-kategori');
            const tombolReset = document.getElementById('btn-reset');
            const hasil = document.getElementById('hasil-barang');
            const jumlahBarang = document.getElementById('jumlah-barang');

            if (form && input && filterKategori && tombolReset && hasil && jumlahBarang) {
                const hasilAwal = hasil.innerHTML;
                const jumlahAwal = jumlahBarang.innerHTML;

                let timer = null;
                let controller = null;

                async function cariBarang() {
                    if (controller) controller.abort();

                    controller = new AbortController();

                    const url = new URL(form.action, window.location.origin);

                    if (input.value.trim() !== '') {
                        url.searchParams.set('cari', input.value.trim());
                    }

                    if (filterKategori.value !== '') {
                        url.searchParams.set('kategori', filterKategori.value);
                    }

                    try {
                        const response = await fetch(url.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html'
                            },
                            signal: controller.signal
                        });

                        if (!response.ok) {
                            throw new Error('Gagal memuat');
                        }

                        const html = await response.text();
                        const dokumen = new DOMParser().parseFromString(html, 'text/html');

                        const hasilBaru = dokumen.querySelector('#hasil-barang');
                        const jumlahBaru = dokumen.querySelector('#jumlah-barang');

                        if (!hasilBaru || !jumlahBaru) {
                            throw new Error('Struktur hasil pencarian tidak ditemukan');
                        }

                        hasil.innerHTML = hasilBaru.innerHTML;
                        jumlahBarang.innerHTML = jumlahBaru.innerHTML;

                        window.history.replaceState({}, '', url.toString());

                    } catch (error) {
                        if (error.name !== 'AbortError') {
                            console.error(error);
                        }
                    }
                }

                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    clearTimeout(timer);
                    cariBarang();
                });

                input.addEventListener('input', function () {
                    clearTimeout(timer);
                    timer = setTimeout(cariBarang, 300);
                });

                filterKategori.addEventListener('change', function () {
                    clearTimeout(timer);
                    cariBarang();
                });

                tombolReset.addEventListener('click', function () {
                    clearTimeout(timer);

                    if (controller) {
                        controller.abort();
                    }

                    input.value = '';
                    filterKategori.value = '';

                    hasil.innerHTML = hasilAwal;
                    jumlahBarang.innerHTML = jumlahAwal;

                    window.history.replaceState({}, '', form.action);
                });
            }
        });
    </script>

</body>
</html>