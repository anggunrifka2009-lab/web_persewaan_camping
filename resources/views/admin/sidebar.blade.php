<style>
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
        flex: 0 0 22px;
        width: 22px;
        height: 22px;
    }

    .nav-icon svg {
        display: block;
        width: 20px;
        height: 20px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
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
        margin-bottom: 6px;
        padding: 10px 9px;
        border-radius: 11px;
        transition: .2s;
    }

    .admin-info:hover,
    .admin-info.active {
        background: #eaf0e8;
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
        color: #eb533f;
        font-size: 13px;
        font-weight: 600;
        text-align: left;
        cursor: pointer;
    }

    .logout-btn:hover {
        background: #f8eeeb;
    }

    .sidebar-toggle,
    .sidebar-overlay {
        display: none;
    }

    @media (max-width: 900px) {
        .sidebar {
            width: 215px;
            padding-right: 13px;
            padding-left: 13px;
        }
    }

    @media (max-width: 620px) {
        body {
            padding-left: 64px;
        }

        body.no-scroll {
            overflow: hidden;
        }

        .sidebar-overlay {
            display: block;
            position: fixed;
            inset: 0;
            z-index: 9;
            background: rgba(25, 58, 43, .4);
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, visibility .25s;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .sidebar {
            width: 64px;
            height: 100vh;
            height: 100dvh;
            padding: 14px 10px;
            overflow-x: hidden;
            overflow-y: auto;
            transition: width .25s ease, box-shadow .25s ease;
        }

        .sidebar.expanded {
            width: 250px;
            max-width: 82vw;
            padding: 14px 14px 16px;
            box-shadow: 10px 0 40px rgba(25, 58, 43, .2);
        }

        .sidebar-toggle {
            display: grid;
            place-items: center;
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            margin-bottom: 14px;
            border: 0;
            border-radius: 11px;
            background: transparent;
            color: var(--forest);
            cursor: pointer;
        }

        .sidebar-toggle:hover {
            background: #eaf0e8;
        }

        .sidebar-toggle svg {
            width: 22px;
            height: 22px;
        }

        .brand,
        .sidebar-label {
            display: none;
        }

        .nav-menu {
            justify-items: center;
        }

        .nav-link,
        .admin-info,
        .logout-btn {
            justify-content: center;
            width: 44px;
            height: 44px;
            min-height: 44px;
            padding: 0;
            gap: 0;
        }

        .nav-link > span:last-child,
        .admin-info > span:last-child,
        .logout-btn > span:last-child {
            display: none;
        }

        .sidebar-bottom {
            display: grid;
            justify-items: center;
            gap: 6px;
        }

        .admin-info {
            margin-bottom: 0;
        }

        .sidebar.expanded .brand {
            display: flex;
            padding-bottom: 22px;
        }

        .sidebar.expanded .sidebar-label {
            display: block;
        }

        .sidebar.expanded .nav-menu,
        .sidebar.expanded .sidebar-bottom {
            justify-items: stretch;
        }

        .sidebar.expanded .nav-link,
        .sidebar.expanded .admin-info,
        .sidebar.expanded .logout-btn {
            justify-content: flex-start;
            width: 100%;
            height: auto;
            padding: 12px 14px;
            gap: 13px;
        }

        .sidebar.expanded .admin-info {
            padding: 10px 9px;
            gap: 11px;
        }

        .sidebar.expanded .nav-link > span:last-child,
        .sidebar.expanded .admin-info > span:last-child,
        .sidebar.expanded .logout-btn > span:last-child {
            display: block;
        }
    }
</style>

<div class="sidebar-overlay" data-sidebar-close></div>

<aside class="sidebar" id="sidebar">
    <button type="button"
            class="sidebar-toggle"
            data-sidebar-toggle
            aria-label="Buka atau tutup menu"
            aria-controls="sidebar"
            aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3" y="4" width="18" height="16" rx="3"/>
            <path d="M9 4v16"/>
        </svg>
    </button>

    <a href="{{ route('admin.dashboard') }}"
       data-turbo-frame="konten-admin"
       class="brand">
        <span class="brand-icon">⌁</span>
        <span>CampRent</span>
    </a>

    <p class="sidebar-label">MENU UTAMA</p>

    <nav class="nav-menu" aria-label="Navigasi admin">

        <a href="{{ route('admin.dashboard') }}"
           data-turbo-frame="konten-admin"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="3" y="3" width="7" height="9" rx="1"/>
                    <rect x="14" y="3" width="7" height="5" rx="1"/>
                    <rect x="14" y="12" width="7" height="9" rx="1"/>
                    <rect x="3" y="16" width="7" height="5" rx="1"/>
                </svg>
            </span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.kategori.index') }}"
           data-turbo-frame="konten-admin"
           class="nav-link {{ request()->routeIs('admin.kategori.*', 'kategori.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/>
                </svg>
            </span>
            <span>Kategori</span>
        </a>

        <a href="{{ route('admin.barang.index') }}"
           data-turbo-frame="konten-admin"
           class="nav-link {{ request()->routeIs('admin.barang.*', 'barang.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M21 8 12 3 3 8v8l9 5 9-5z"/>
                    <path d="m3 8 9 5 9-5M12 13v8"/>
                </svg>
            </span>
            <span>Barang</span>
        </a>

        <a href="{{ route('admin.penyewaan.index') }}"
           data-turbo-frame="konten-admin"
           class="nav-link {{ request()->routeIs('admin.penyewaan.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="5" y="3" width="14" height="18" rx="2"/>
                    <path d="M9 8h6M9 12h6M9 16h4"/>
                </svg>
            </span>
            <span>Penyewaan</span>
        </a>

        <a href="{{ route('admin.user.index') }}"
           data-turbo-frame="konten-admin"
           class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="10" cy="7" r="4"/>
                    <path d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </span>
            <span>User</span>
        </a>

        <a href="{{ route('admin.laporan.index') }}"
           data-turbo-frame="konten-admin"
           class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>
                </svg>
            </span>
            <span>Laporan</span>
        </a>

    </nav>

    <div class="sidebar-bottom">
        <a href="{{ route('akun.index') }}"
           data-turbo-frame="konten-admin"
           class="admin-info {{ request()->routeIs('akun.*') ? 'active' : '' }}">
            <span class="avatar">
                {{ strtoupper(mb_substr(Auth::user()->nama, 0, 1)) }}
            </span>

            <span style="min-width:0">
                <span class="admin-name" style="display:block">
                    {{ Auth::user()->nama }}
                </span>
                <span class="admin-role" style="display:block">
                    Administrator
                </span>
            </span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf

            <button type="submit" class="logout-btn">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                    </svg>
                </span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    if (!window.__sidebarReady) {
        window.__sidebarReady = true;

        const setSidebar = (open) => {
            document.getElementById('sidebar')?.classList.toggle('expanded', open);
            document.querySelector('.sidebar-overlay')?.classList.toggle('show', open);
            document.body.classList.toggle('no-scroll', open);
            document.querySelector('[data-sidebar-toggle]')?.setAttribute('aria-expanded', open);
        };

        document.addEventListener('click', (e) => {
            if (e.target.closest('[data-sidebar-toggle]')) {
                setSidebar(!document.getElementById('sidebar').classList.contains('expanded'));
            } else if (
                e.target.closest('[data-sidebar-close]') ||
                e.target.closest('.sidebar .nav-link, .sidebar .admin-info')
            ) {
                setSidebar(false);
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') setSidebar(false);
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 620) setSidebar(false);
        });
    }
</script>