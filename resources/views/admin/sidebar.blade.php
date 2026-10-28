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

    .nav-icon img {
        display: block;
        width: 20px;
        height: 20px;
        object-fit: contain;
        filter: brightness(0) saturate(100%)
                invert(24%) sepia(17%) saturate(1050%)
                hue-rotate(93deg) brightness(88%) contrast(90%);
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

    .logout-btn .nav-icon {
        color: #8a5149;
        font-size: 18px;
    }

    @media (max-width: 900px) {
        .sidebar {
            width: 215px;
            padding-right: 13px;
            padding-left: 13px;
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
        .brand { padding: 0 4px 15px; font-size: 21px; }
        .sidebar-label { margin: 0 4px 8px; }
        .nav-menu { display: flex; gap: 7px; overflow-x: auto; padding-bottom: 3px; }
        .nav-link { flex: 0 0 auto; min-height: 40px; gap: 8px; padding: 10px 12px; font-size: 12px; white-space: nowrap; }
        .sidebar-bottom { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 13px; padding-top: 11px; }
        .admin-info { min-width: 0; padding: 0 4px; }
        .logout-btn { width: auto; padding: 10px; white-space: nowrap; }
    }
</style>

<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="brand">
        <span class="brand-icon">⌁</span>
        <span>CampRent</span>
    </a>

    <p class="sidebar-label">MENU UTAMA</p>

    <nav class="nav-menu" aria-label="Navigasi admin">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><img src="{{ asset('images/dashboard.png') }}" alt=""></span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <span class="nav-icon"><img src="{{ asset('images/category.png') }}" alt=""></span>
            <span>Kategori</span>
        </a>

        <a href="{{ route('barang.index') }}" class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}">
            <span class="nav-icon"><img src="{{ asset('images/product.png') }}" alt=""></span>
            <span>Barang</span>
        </a>

        <a href="{{ route('admin.penyewaan.index') }}" class="nav-link {{ request()->routeIs('admin.penyewaan.*') ? 'active' : '' }}">
            <span class="nav-icon"><img src="{{ asset('images/rental.png') }}" alt=""></span>
            <span>Penyewaan</span>
        </a>

        <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <span class="nav-icon"><img src="{{ asset('images/report.png') }}" alt=""></span>
            <span>Laporan</span>
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