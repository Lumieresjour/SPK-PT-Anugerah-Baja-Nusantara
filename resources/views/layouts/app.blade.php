<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SPK SAW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #44A340;
            --secondary: #D6E685;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, var(--primary) 100%, var(--secondary) 0%);
            min-height: 100vh;
            padding: 20px;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            overflow-y: auto;
            color: white;
        }

        .sidebar-header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
        }

        .sidebar-header h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-menu li {
            margin-bottom: 10px;
        }

        .nav-menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            opacity: 0.9;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background-color: rgba(255, 255, 255, 0.2);
            opacity: 1;
        }

        .nav-menu i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            width: calc(100% - 40px);
            padding: 12px;
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: left;
        }

        .logout-btn:hover {
            background-color: rgba(255, 0, 0, 0.70);
        }

        .logout-btn i {
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .content-header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-header h2 {
            color: #333;
            font-weight: bold;
            margin: 0;
        }

        .content-header .user-info {
            text-align: right;
            color: #666;
            font-size: 14px;
        }

        .content-body {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Buttons */
        .btn-custom {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 100%, var(--secondary) 0%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-danger-custom {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger-custom:hover {
            background-color: #c82333;
        }

        .btn-warning-custom {
            background-color: #ffc107;
            color: #333;
        }

        .btn-warning-custom:hover {
            background-color: #ffb800;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            font-size: 14px;
        }

        thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        th {
            font-weight: 600;
            color: #333;
            padding: 15px;
        }

        td {
            padding: 15px;
            color: #666;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        /* Alerts */
        .alert-custom {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 60px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .content-header .user-info {
                text-align: left;
                margin-top: 15px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>SPK SAW</h3>
            <p>Sistem Penunjang Keputusan Supplier</p>
            <h7>PT Karunia Baja Persada</h7>
        </div>

        <ul class="nav-menu">
            <li>
                <a href="{{ route('home') }}" class="@if (Route::current()->getName() === 'home') active @endif">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('perusahaan.index') }}" class="@if (Route::current()->getName() === 'perusahaan.index') active @endif">
                    <i class="fas fa-building"></i>
                    <span>Perusahaan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kriteria.index') }}" class="@if (Route::current()->getName() === 'kriteria.index') active @endif">
                    <i class="fas fa-bars"></i>
                    <span>Kriteria</span>
                </a>
            </li>
            <li>
                <a href="{{ route('klasifikasi.index') }}" class="@if (Route::current()->getName() === 'klasifikasi.index') active @endif">
                    <i class="fas fa-list"></i>
                    <span>Klasifikasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('evaluasi.index') }}" class="@if (Route::current()->getName() === 'evaluasi.index') active @endif">
                    <i class="fas fa-chart-bar"></i>
                    <span>Evaluasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kalkulasi.index') }}" class="@if (Route::current()->getName() === 'kalkulasi.index') active @endif">
                    <i class="fas fa-calculator"></i>
                    <span>Kalkulasi</span>
                </a>
            </li>
        </ul>

        <form method="POST" action="{{ route('logout') }}" style="position: absolute; bottom: 20px; width: calc(100% - 40px);"
            onsubmit="return confirm('Yakin mau logout?')">
            @csrf
            <button type="submit" class="logout-btn w-100">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-header">
            <h2>@yield('title')</h2>
            <div class="user-info">
                <strong>{{ session('admin_name') ?? 'Admin' }}</strong>
            </div>
        </div>

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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
