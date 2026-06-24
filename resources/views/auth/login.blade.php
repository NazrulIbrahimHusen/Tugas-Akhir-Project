<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — SMK Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { min-height:100vh; background:linear-gradient(135deg,#0a1628,#1e3a5f); display:flex; align-items:center; justify-content:center; font-family:'Segoe UI',sans-serif; }
        .login-card { background:#fff; border-radius:24px; box-shadow:0 24px 60px rgba(0,0,0,.35); padding:44px 38px; width:100%; max-width:410px; border-top:5px solid #0a1628; }
        .logo-wrap { width:68px; height:68px; border-radius:50%; background:linear-gradient(135deg,#0a1628,#1e3a5f); display:flex; align-items:center; justify-content:center; margin:0 auto 18px; font-size:1.6rem; color:#fff; }
        .form-control { border-radius:10px; border:1.5px solid #d0dae8; padding:11px 14px; }
        .form-control:focus { border-color:#1e3a5f; box-shadow:0 0 0 3px rgba(30,58,95,.15); }
        .btn-login { background:linear-gradient(135deg,#0a1628,#1e3a5f); border:none; color:#fff; border-radius:12px; padding:12px; font-weight:700; width:100%; transition:opacity .2s; }
        .btn-login:hover { opacity:.85; color:#fff; }
    </style>
</head>
<body>
<div>
    <div class="text-center mb-3">
        <a href="{{ route('home') }}" class="text-white text-decoration-none opacity-75 small">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Halaman Publik
        </a>
    </div>
    <div class="login-card">
        <div class="logo-wrap"><i class="bi bi-shield-lock-fill"></i></div>
        <h4 class="text-center fw-bold mb-1" style="color:#0a1628">Login Admin</h4>
        <p class="text-center text-muted small mb-4">Masuk untuk mengelola data pendaftaran</p>

        @if(session('sukses'))
        <div class="alert alert-success rounded-3 small"><i class="bi bi-check-circle me-1"></i>{{ session('sukses') }}</div>
        @endif
        @if($errors->has('email'))
        <div class="alert alert-danger rounded-3 small"><i class="bi bi-exclamation-triangle me-1"></i>{{ $errors->first('email') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:#0a1628">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@smkcoding.sch.id" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:#0a1628">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="pw" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="btn btn-outline-secondary" style="border-radius:0 10px 10px 0"
                            onclick="let i=document.getElementById('pw');i.type=i.type==='password'?'text':'password'">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4 d-flex align-items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label text-muted small">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-login"><i class="bi bi-box-arrow-in-right me-2"></i>Masuk</button>
        </form>
        <hr class="my-3">
        <div class="text-center text-muted small">
            <i class="bi bi-info-circle me-1"></i>Default: <strong>admin@smkcoding.sch.id</strong> / <strong>admin123</strong>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
