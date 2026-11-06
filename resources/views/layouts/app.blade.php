<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SPK SAW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap">
    <style>
        :root {
            --primary: #3f8f3b;
            --primary-strong: #2f7230;
            --primary-soft: #eaf3e6;
            --ink: #1c2a1d;
            --muted: #66756a;
            --line: #e3e8e1;
            --surface: #ffffff;
            --bg: #f4f6f2;
            --danger: #c8443a;
            --shadow: 0 1px 2px rgba(28, 52, 30, .06), 0 8px 24px -12px rgba(28, 52, 30, .18);
            --radius: 14px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: 'Outfit', system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        :focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; }

        .skip-link { position: absolute; left: -999px; top: 8px; z-index: 10; background: var(--ink); color: #fff; padding: 8px 14px; border-radius: 8px; }
        .skip-link:focus { left: 8px; }

        /* Sidebar */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 248px;
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
            background: var(--surface);
            border-right: 1px solid var(--line);
            overflow-y: auto;
        }

        .sidebar-header { padding: 4px 12px 24px; margin-bottom: 16px; border-bottom: 1px solid var(--line); }
        .sidebar-header h3 { margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -.02em; color: var(--ink); }
        .sidebar-header h3 span { color: var(--primary); }
        .sidebar-header p { margin: 4px 0 0; font-size: 13px; color: var(--muted); line-height: 1.4; }

        .nav-menu { list-style: none; margin: 0; padding: 0; display: grid; gap: 4px; }

        .nav-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--muted);
            font-weight: 500;
            text-decoration: none;
            transition: background-color .2s, color .2s;
        }
        .nav-menu a:hover { background: var(--bg); color: var(--ink); }
        .nav-menu a.active { background: var(--primary-soft); color: var(--primary-strong); font-weight: 600; }
        .nav-menu i { width: 18px; text-align: center; }

        .logout-form { margin-top: auto; padding-top: 16px; }
        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: transparent;
            color: var(--muted);
            font: inherit;
            font-weight: 500;
            cursor: pointer;
            transition: background-color .2s, color .2s, border-color .2s;
        }
        .logout-btn:hover { background: #fbeceb; border-color: #f1c9c5; color: var(--danger); }

        /* Main Content */
        .main-content { margin-left: 248px; padding: 32px 40px 48px; max-width: 1440px; }

        .content-header { display: flex; justify-content: space-between; align-items: flex-end; gap: 16px; margin-bottom: 24px; }
        .content-header h2 { margin: 0; font-size: 28px; font-weight: 700; letter-spacing: -.025em; text-wrap: balance; }
        .content-header .user-info { display: flex; align-items: center; gap: 10px; font-size: 14px; color: var(--muted); }
        .content-header .user-info .avatar {
            width: 34px; height: 34px; border-radius: 10px;
            display: grid; place-items: center;
            background: var(--primary-soft); color: var(--primary-strong); font-weight: 700;
        }
        .content-header .user-info strong { color: var(--ink); font-weight: 600; }

        .content-body { background: var(--surface); padding: 28px; border-radius: var(--radius); box-shadow: var(--shadow); }

        /* Buttons */
        .btn { font-weight: 500; border-radius: 10px; padding: 9px 16px; transition: background-color .2s, box-shadow .2s, transform .1s; }
        .btn-sm { padding: 5px 10px; border-radius: 8px; font-size: 13px; }
        .btn:active { transform: translateY(1px); }
        .btn i { margin-right: 4px; }

        .btn-primary-custom { background: var(--primary); color: #fff; border: 1px solid var(--primary); }
        .btn-primary-custom:hover { background: var(--primary-strong); border-color: var(--primary-strong); color: #fff; box-shadow: 0 6px 16px -8px rgba(47, 114, 48, .6); }

        .btn-danger-custom, .btn-pdf { background: transparent; color: var(--danger); border: 1px solid #f1c9c5; }
        .btn-danger-custom:hover, .btn-pdf:hover { background: var(--danger); border-color: var(--danger); color: #fff; }

        .btn-warning-custom { background: transparent; color: #8a6312; border: 1px solid #efd9a8; }
        .btn-warning-custom:hover { background: #fdf3dc; color: #6e4f0e; border-color: #efd9a8; }

        .btn-secondary { background: transparent; color: var(--muted); border: 1px solid var(--line); }
        .btn-secondary:hover { background: var(--bg); color: var(--ink); border-color: var(--line); }

        .form-actions { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--line); }

        /* Badges */
        .badge { font-weight: 600; border-radius: 6px; padding: 5px 8px; font-variant-numeric: tabular-nums; }
        .badge-brand { background: var(--primary-soft); color: var(--primary-strong); }

        /* Table */
        .table-container { overflow-x: auto; border: 1px solid var(--line); border-radius: 12px; }
        .table { margin: 0; font-size: 14px; font-variant-numeric: tabular-nums; --bs-table-hover-bg: #f7f9f5; }
        .table thead th {
            background: #f8faf6;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            border-bottom: 1px solid var(--line);
            padding: 12px 16px;
            white-space: nowrap;
        }
        .table thead th .th-sub { text-transform: none; letter-spacing: 0; }
        .table td { padding: 12px 16px; color: var(--ink); vertical-align: middle; border-color: var(--line); }
        .table tbody tr:last-child td { border-bottom: 0; }
        .table td form { display: inline; }

        /* Forms */
        .form-group { margin-bottom: 20px; max-width: 640px; }
        .form-label { font-weight: 500; font-size: 14px; color: var(--ink); margin-bottom: 6px; }
        .form-control, .form-select { border: 1px solid #d5dcd3; border-radius: 10px; padding: 10px 14px; font-size: 14px; transition: border-color .2s, box-shadow .2s; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(63, 143, 59, .18); }
        .form-control[readonly] { background: var(--bg); color: var(--muted); }

        /* Alerts */
        .alert-custom { display: flex; gap: 10px; align-items: center; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; border: 1px solid; font-size: 14px; }
        .alert-success { background: #eef7ec; border-color: #cfe6c9; color: #24561f; }
        .alert-danger  { background: #fcefee; border-color: #f1c9c5; color: #8a2a22; }
        .alert-warning { background: #fdf6e6; border-color: #f0dcae; color: #74540f; }
        .alert-info    { background: #f3f6f1; border-color: var(--line); color: var(--ink); }

        .note { margin-top: 20px; padding: 16px 18px; background: #f8faf6; border: 1px solid var(--line); border-radius: 12px; font-size: 13px; color: var(--muted); }
        .note strong { color: var(--ink); }
        .note ul { margin: 8px 0 0; padding-left: 18px; }

        /* Empty State */
        .empty-state { text-align: center; padding: 56px 20px; color: var(--muted); border: 1px dashed #d5dcd3; border-radius: 12px; }
        .empty-state i { font-size: 40px; margin-bottom: 16px; color: #b7c4b3; }
        .empty-state p { font-size: 16px; margin: 0 auto 8px; max-width: 48ch; text-wrap: pretty; }

        @media (max-width: 768px) {
            .sidebar { position: static; width: auto; border-right: 0; border-bottom: 1px solid var(--line); padding: 16px; }
            .nav-menu { grid-template-columns: repeat(3, 1fr); }
            .nav-menu a { flex-direction: column; gap: 4px; font-size: 12px; padding: 8px 4px; }
            .logout-form { padding-top: 12px; }
            .main-content { margin-left: 0; padding: 20px 16px 32px; }
            .content-header { flex-direction: column; align-items: flex-start; }
            .content-header h2 { font-size: 24px; }
            .content-body { padding: 18px; }
        }

        @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
    </style>
    @yield('styles')
</head>
<body>
    <a href="#main" class="skip-link">Lewati ke konten</a>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h3>Web<span>SPK</span></h3>
            <p>Sistem Penunjang Keputusan Supplier<br>PT Anugerah Baja Nusantara</p>
        </div>

        <nav aria-label="Menu utama">
        <ul class="nav-menu">
            <li>
                <a href="{{ route('home') }}" class="@if (request()->routeIs('home')) active @endif">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('perusahaan.index') }}" class="@if (request()->routeIs('perusahaan.*')) active @endif">
                    <i class="fas fa-building"></i>
                    <span>Perusahaan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kriteria.index') }}" class="@if (request()->routeIs('kriteria.*')) active @endif">
                    <i class="fas fa-bars"></i>
                    <span>Kriteria</span>
                </a>
            </li>
            <li>
                <a href="{{ route('klasifikasi.index') }}" class="@if (request()->routeIs('klasifikasi.*')) active @endif">
                    <i class="fas fa-list"></i>
                    <span>Klasifikasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('evaluasi.index') }}" class="@if (request()->routeIs('evaluasi.*')) active @endif">
                    <i class="fas fa-chart-bar"></i>
                    <span>Evaluasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kalkulasi.index') }}" class="@if (request()->routeIs('kalkulasi.*')) active @endif">
                    <i class="fas fa-calculator"></i>
                    <span>Kalkulasi</span>
                </a>
            </li>
        </ul>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="logout-form"
            onsubmit="return confirm('Yakin mau logout?')">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <main class="main-content" id="main">
        <header class="content-header">
            <h2>@yield('title')</h2>
            <div class="user-info">
                <span class="avatar" aria-hidden="true">{{ strtoupper(substr(session('admin_name') ?? 'A', 0, 1)) }}</span>
                <strong>{{ session('admin_name') ?? 'Admin' }}</strong>
            </div>
        </header>

        <div class="content-body">
            @if (session('success'))
                <div class="alert-custom alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-custom alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
