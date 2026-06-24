<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Coding — Pendaftaran Siswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family:'Segoe UI',sans-serif; }
        .hero { background:linear-gradient(135deg,#0a1628 0%,#1e3a5f 60%,#162844 100%); min-height:100vh; display:flex; align-items:center; position:relative; overflow:hidden; }
        .hero::before { content:''; position:absolute; top:-40%; right:-15%; width:500px; height:500px; border-radius:50%; background:rgba(255,255,255,.03); }
        .hero::after  { content:''; position:absolute; bottom:-30%; left:-10%; width:400px; height:400px; border-radius:50%; background:rgba(37,99,235,.08); }
        .hero-content { position:relative; z-index:1; }
        .logo-wrap { width:80px; height:80px; border-radius:50%; background:rgba(255,255,255,.1); display:flex; align-items:center; justify-content:center; font-size:2rem; color:#fff; margin-bottom:18px; border:3px solid rgba(255,255,255,.2); }
        .stat-pill { background:rgba(37,99,235,.3); border:1px solid rgba(37,99,235,.4); border-radius:50px; padding:8px 20px; display:inline-flex; align-items:center; gap:8px; color:#93c5fd; font-weight:600; font-size:.9rem; }
        .btn-daftar { background:#fff; color:#0a1628; border-radius:14px; padding:14px 28px; font-weight:700; border:none; box-shadow:0 8px 30px rgba(0,0,0,.25); transition:transform .2s; }
        .btn-daftar:hover { transform:translateY(-2px); color:#1e3a5f; }
        .btn-list { background:rgba(255,255,255,.1); color:#fff; border:2px solid rgba(255,255,255,.2); border-radius:14px; padding:14px 28px; font-weight:700; transition:all .2s; }
        .btn-list:hover { background:rgba(255,255,255,.18); color:#fff; }
        .info-card { background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1); border-radius:14px; padding:18px; color:#fff; text-align:center; }
        .info-card i { font-size:1.6rem; margin-bottom:6px; display:block; color:#93c5fd; }
        .admin-link { position:fixed; bottom:20px; right:20px; background:rgba(10,22,40,.8); color:rgba(255,255,255,.6); border-radius:10px; padding:7px 14px; text-decoration:none; font-size:.78rem; border:1px solid rgba(255,255,255,.15); transition:all .2s; }
        .admin-link:hover { background:#0a1628; color:#fff; }
    </style>
</head>
<body>
<div class="hero">
    <div class="container hero-content">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="logo-wrap"><i class="bi bi-mortarboard-fill"></i></div>
                <div class="stat-pill mb-3"><i class="bi bi-people-fill"></i>{{ $total }} orang sudah mendaftar</div>
                <h1 class="text-white fw-black" style="font-size:2.8rem">SMK Coding</h1>
                <p class="mb-4" style="color:rgba(255,255,255,.7);font-size:1rem">Sistem Pendaftaran Siswa Baru<br>Tahun Ajaran 2025/2026</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('public.daftar') }}" class="btn btn-daftar"><i class="bi bi-pencil-square me-2"></i>Daftar Sekarang</a>
                    <a href="{{ route('public.list') }}" class="btn btn-list"><i class="bi bi-list-ul me-2"></i>Lihat Pendaftar</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    @foreach([['clock-fill','Pendaftaran Dibuka','Jan – Des 2025'],['geo-alt-fill','Lokasi','Jl. Coding No. 1'],['telephone-fill','Hubungi Kami','0812-3456-7890'],['envelope-fill','Email','info@smkcoding.sch.id']] as [$icon,$title,$sub])
                    <div class="col-6">
                        <div class="info-card">
                            <i class="bi bi-{{ $icon }}"></i>
                            <div class="fw-bold small">{{ $title }}</div>
                            <small style="color:rgba(255,255,255,.55)">{{ $sub }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
