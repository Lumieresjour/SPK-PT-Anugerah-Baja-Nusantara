<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penunjang Keputusan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap">
    <style>
        :root { --primary: #3f8f3b; --primary-strong: #2f7230; --ink: #1c2a1d; --muted: #66756a; --line: #e3e8e1; }
        body {
            margin: 0;
            min-height: 100dvh;
            display: grid;
            place-items: center;
            padding: 24px 16px;
            font-family: 'Outfit', system-ui, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(60rem 40rem at 10% -10%, #dcebd6 0%, transparent 60%),
                radial-gradient(40rem 30rem at 110% 110%, #e8efd2 0%, transparent 60%),
                #f4f6f2;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 18px;
            padding: 36px 32px 32px;
            box-shadow: 0 1px 2px rgba(28, 52, 30, .06), 0 24px 48px -24px rgba(28, 52, 30, .3);
        }
        .login-header { margin-bottom: 28px; }
        .login-header h1 { margin: 0 0 6px; font-size: 30px; font-weight: 700; letter-spacing: -.03em; }
        .login-header h1 span { color: var(--primary); }
        .login-header p { margin: 0; color: var(--muted); font-size: 14px; line-height: 1.5; }
        .form-group { margin-bottom: 18px; }
        .form-label { font-weight: 500; font-size: 14px; margin-bottom: 6px; }
        .form-control { border: 1px solid #d5dcd3; border-radius: 10px; padding: 11px 14px; font-size: 15px; transition: border-color .2s, box-shadow .2s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(63, 143, 59, .18); }
        .btn-login {
            width: 100%;
            margin-top: 8px;
            padding: 12px;
            border: 0;
            border-radius: 10px;
            background: var(--primary);
            color: #fff;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: background-color .2s, box-shadow .2s, transform .1s;
        }
        .btn-login:hover { background: var(--primary-strong); box-shadow: 0 8px 20px -10px rgba(47, 114, 48, .7); }
        .btn-login:active { transform: translateY(1px); }
        .btn-login:focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; }
        .alert { border-radius: 10px; font-size: 14px; padding: 10px 14px; }
        .error-text { color: #c8443a; font-size: 13px; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Web<span>SPK</span></h1>
            <p>Sistem Penunjang Keputusan Supplier<br>PT Karunia Baja Persada</p>
        </div>

        @if ($errors->has('login'))
            <div class="alert alert-danger">{{ $errors->first('login') }}</div>
        @elseif ($errors->any())
            <div class="alert alert-danger">Username dan password wajib diisi.</div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input 
                    type="text" 
                    class="form-control @error('username') is-invalid @enderror" 
                    name="username" id="username" 
                    placeholder="Masukkan username"
                    autocomplete="username" autofocus
                    value="{{ old('username') }}"
                >
                @error('username')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" id="password" 
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                >
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
