<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kristech Solusindo Energi</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: #1a2e4a;
            color: #fff;
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-logo {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo h2 {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
        }

        .sidebar-logo span { color: #1a6fd4; }

        .sidebar-menu { padding: 16px 0; flex: 1; }

        .menu-label {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 20px;
            margin-top: 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border-left-color: #1a6fd4;
        }

        .sidebar-menu a .badge {
            margin-left: auto;
            background: #e74c3c;
            color: #fff;
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-footer a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-footer a:hover { color: #fff; }

        /* MAIN CONTENT */
        .main { margin-left: 260px; flex: 1; }

        .topbar {
            background: #fff;
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .topbar h1 { font-size: 18px; color: #1a2e4a; font-weight: 600; }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #555;
        }

        .content { padding: 30px; }

        /* ALERTS */
        .alert {
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* CARDS */
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            padding: 24px;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title { font-size: 16px; font-weight: 600; color: #1a2e4a; }

        /* BUTTONS */
        .btn {
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            border: none;
            transition: all 0.2s;
        }
        .btn-primary { background: #1a6fd4; color: #fff; }
        .btn-primary:hover { background: #1558b0; }
        .btn-success { background: #28a745; color: #fff; }
        .btn-success:hover { background: #218838; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-danger:hover { background: #c82333; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-sm { padding: 5px 12px; font-size: 12px; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 12px 14px; text-align: left; font-size: 13px; color: #555; font-weight: 600; border-bottom: 2px solid #e9ecef; }
        td { padding: 12px 14px; border-bottom: 1px solid #f0f0f0; font-size: 14px; color: #333; vertical-align: middle; }
        tr:hover td { background: #fafbfc; }

        /* FORM */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Segoe UI', sans-serif;
            transition: border-color 0.2s;
        }
        .form-control:focus { outline: none; border-color: #1a6fd4; }
        textarea.form-control { min-height: 120px; resize: vertical; }
        .form-check { display: flex; align-items: center; gap: 8px; }
        .form-check input { width: 16px; height: 16px; }
        .error-text { color: #dc3545; font-size: 12px; margin-top: 4px; }

        /* IMAGE PREVIEW */
        .img-preview { width: 80px; height: 60px; object-fit: cover; border-radius: 6px; }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 10px; padding: 20px 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border-left: 4px solid #1a6fd4; }
        .stat-card h3 { font-size: 28px; font-weight: 700; color: #1a2e4a; }
        .stat-card p { font-size: 13px; color: #888; margin-top: 4px; }

        .badge-aktif { background: #d4edda; color: #155724; padding: 3px 8px; border-radius: 12px; font-size: 12px; }
        .badge-nonaktif { background: #f8d7da; color: #721c24; padding: 3px 8px; border-radius: 12px; font-size: 12px; }
        .badge-baru { background: #fff3cd; color: #856404; padding: 3px 8px; border-radius: 12px; font-size: 12px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <h2>Kristech <span>Admin</span><br>Panel</h2>
    </div>

    <nav class="sidebar-menu">
        <div class="menu-label">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            📊 Dashboard
        </a>
        <a href="{{ route('admin.beranda.edit') }}" class="{{ request()->routeIs('admin.beranda.*') ? 'active' : '' }}">
            🏠 Konten Beranda
        </a>

        <div class="menu-label">Kelola Konten</div>
        <a href="{{ route('admin.layanan.index') }}" class="{{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
            ⚡ Layanan
        </a>
        <a href="{{ route('admin.proyek.index') }}" class="{{ request()->routeIs('admin.proyek.*') ? 'active' : '' }}">
            🏗️ Proyek
        </a>
        <a href="{{ route('admin.portofolio.index') }}" class="{{ request()->routeIs('admin.portofolio.*') ? 'active' : '' }}">
            🖼️ Portofolio
        </a>

        <div class="menu-label">Komunikasi</div>
        <a href="{{ route('admin.pesan.index') }}" class="{{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">
            ✉️ Pesan Masuk
            @php $belumDibaca = \App\Models\Pesan::where('sudah_dibaca', false)->count(); @endphp
            @if($belumDibaca > 0)
                <span class="badge">{{ $belumDibaca }}</span>
            @endif
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" target="_blank">🌐 Lihat Website</a>
        <br><br>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.6);font-size:13px;display:flex;align-items:center;gap:8px;">
                🚪 Logout
            </button>
        </form>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <h1>@yield('page-title', 'Dashboard')</h1>
        <div class="topbar-user">
            👤 {{ auth()->user()->name }}
        </div>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                ❌ Ada kesalahan input. Silakan periksa kembali.
            </div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>
