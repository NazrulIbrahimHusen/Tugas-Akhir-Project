<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard') — SMK Coding Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --navy:      #0a1628;
            --navy-mid:  #1e3a5f;
            --accent:    #2563eb;
            --grad:      linear-gradient(135deg,#0a1628,#1e3a5f);
            --sidebar-w: 250px;
        }
        * { box-sizing: border-box; }
        body { background:#f0f4f8; font-family:'Segoe UI',sans-serif; min-height:100vh; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--grad);
            position: fixed; top:0; left:0; z-index:200;
            display: flex; flex-direction: column;
            box-shadow: 4px 0 24px rgba(0,0,0,.25);
            transition: transform .3s ease;
        }
        .sidebar-brand { padding:20px 18px 16px; border-bottom:1px solid rgba(255,255,255,.1); }
        .sidebar-brand h5 { color:#fff; font-weight:800; margin:0; font-size:1rem; }
        .sidebar-brand p  { color:rgba(255,255,255,.5); font-size:.7rem; margin:0; }
        .sidebar-nav { padding:12px 8px; flex:1; overflow-y:auto; }
        .nav-label { color:rgba(255,255,255,.35); font-size:.65rem; font-weight:700; text-transform:uppercase; letter-spacing:1.2px; padding:10px 12px 4px; }
        .sidebar-link { display:flex; align-items:center; gap:10px; color:rgba(255,255,255,.75); text-decoration:none; padding:9px 12px; border-radius:10px; margin-bottom:2px; font-weight:500; font-size:.88rem; transition:all .2s; }
        .sidebar-link:hover,.sidebar-link.active { background:rgba(255,255,255,.15); color:#fff; }
        .sidebar-link i { font-size:1rem; width:18px; text-align:center; flex-shrink:0; }
        .sidebar-footer { padding:14px 18px; border-top:1px solid rgba(255,255,255,.1); }

        /* ===== OVERLAY (mobile) ===== */
        .sidebar-overlay {
            display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
            z-index:199; backdrop-filter:blur(2px);
        }
        .sidebar-overlay.show { display:block; }

        /* ===== MAIN ===== */
        .main-content { margin-left:var(--sidebar-w); padding:20px; min-height:100vh; transition:margin .3s ease; }

        /* ===== TOPBAR ===== */
        .topbar { background:#fff; border-radius:14px; padding:12px 20px; margin-bottom:20px; box-shadow:0 2px 16px rgba(10,22,40,.08); display:flex; align-items:center; justify-content:space-between; border-left:4px solid var(--navy); }
        .topbar-title { font-weight:700; color:#0a1628; font-size:1rem; }
        .btn-toggle-sidebar { display:none; background:none; border:none; color:var(--navy); font-size:1.4rem; padding:0; cursor:pointer; }

        /* ===== STAT CARDS ===== */
        .stat-card { border-radius:16px; border:none; box-shadow:0 4px 20px rgba(10,22,40,.1); transition:transform .2s; overflow:hidden; }
        .stat-card:hover { transform:translateY(-3px); }
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; color:#fff; flex-shrink:0; }

        /* ===== TABLE ===== */
        .card-table { border-radius:16px; border:none; box-shadow:0 4px 20px rgba(10,22,40,.1); overflow:hidden; }
        .table thead th { background:var(--navy); color:#fff; font-weight:600; border:none; padding:12px 14px; font-size:.85rem; white-space:nowrap; }
        .table tbody tr:hover { background:#e8f0fb; }
        .table tbody td { vertical-align:middle; padding:10px 14px; border-color:#f0f0f0; font-size:.88rem; }

        /* ===== BADGES ===== */
        .badge-lk    { background:linear-gradient(135deg,#2563eb,#1d4ed8); color:#fff; }
        .badge-pr    { background:linear-gradient(135deg,#dc2626,#b91c1c); color:#fff; }
        .badge-agama { background:linear-gradient(135deg,#0369a1,#0284c7); color:#fff; }
        .badge-gen   { border-radius:20px; padding:3px 10px; font-size:.75rem; font-weight:600; white-space:nowrap; }
        .badge-no    { background:var(--grad); color:#fff; border-radius:8px; padding:3px 10px; font-size:.75rem; font-weight:700; white-space:nowrap; }

        /* ===== BUTTONS ===== */
        .btn-grad  { background:var(--grad); border:none; color:#fff; border-radius:10px; font-weight:600; transition:opacity .2s; }
        .btn-grad:hover { opacity:.85; color:#fff; }
        .btn-edit  { background:linear-gradient(135deg,#d97706,#b45309); border:none; color:#fff; border-radius:7px; font-weight:600; padding:5px 10px; font-size:.8rem; }
        .btn-hapus { background:linear-gradient(135deg,#dc2626,#b91c1c); border:none; color:#fff; border-radius:7px; font-weight:600; padding:5px 10px; font-size:.8rem; }

        /* ===== FORMS ===== */
        .form-control,.form-select { border-radius:10px; border:1.5px solid #d0dae8; padding:10px 14px; }
        .form-control:focus,.form-select:focus { border-color:var(--navy-mid); box-shadow:0 0 0 3px rgba(30,58,95,.15); }
        .form-label { font-weight:600; color:#2d3748; font-size:.9rem; }
        .card-form { border-radius:16px; border:none; box-shadow:0 4px 20px rgba(10,22,40,.1); }
        .card-form .card-header { background:var(--grad); color:#fff; border-radius:16px 16px 0 0!important; padding:18px 24px; }
        .card-form .card-body { padding:24px; }
        .radio-card { border:2px solid #d0dae8; border-radius:10px; padding:10px 14px; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:8px; font-size:.9rem; }
        .radio-card:has(input:checked) { border-color:var(--navy-mid); background:#e8f0fb; }

        /* ===== ALERTS ===== */
        .alert-sukses { background:linear-gradient(135deg,#16a34a,#15803d); color:#fff; border:none; border-radius:12px; }
        .no-data { text-align:center; padding:40px; color:#aaa; }
        .no-data i { font-size:2.5rem; display:block; margin-bottom:10px; }
        .foto-thumb { width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #d0dae8; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 14px; }
            .btn-toggle-sidebar { display: block; }
            .topbar { border-radius: 10px; padding: 10px 14px; }
        }
        @media (max-width: 576px) {
            .main-content { padding: 10px; }
            .stat-card .card-body { padding: 14px!important; }
            .stat-icon { width: 40px; height: 40px; font-size: 1rem; }
            .card-form .card-body { padding: 16px; }
            .topbar-title { font-size: .9rem; }
            .table thead th { font-size: .78rem; padding: 10px 10px; }
            .table tbody td { font-size: .82rem; padding: 8px 10px; }
        }

        /* Print */
        @media print {
            .sidebar,.topbar,.btn-toggle-sidebar,.sidebar-overlay { display:none!important; }
            .main-content { margin-left:0!important; padding:0!important; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Overlay mobile -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-2 mb-1">
            <div style="width:30px;height:30px;background:rgba(255,255,255,.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-mortarboard-fill text-white" style="font-size:.85rem"></i>
            </div>
            <h5 class="mb-0">SMK Coding</h5>
        </div>
        <p>Panel Admin</p>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <div class="nav-label mt-2">Data Siswa</div>
        <a href="{{ route('siswa.index') }}" class="sidebar-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
            <i class="bi bi-table"></i> Daftar Pendaftar
        </a>
        <a href="{{ route('siswa.create') }}" class="sidebar-link {{ request()->routeIs('siswa.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
        <a href="{{ route('siswa.print') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-printer"></i> Print / PDF
        </a>
        <a href="{{ route('siswa.export') }}" class="sidebar-link">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
        <div class="nav-label mt-2">Akun</div>
        <a href="{{ route('ganti.password') }}" class="sidebar-link {{ request()->routeIs('ganti.password') ? 'active' : '' }}">
            <i class="bi bi-key"></i> Ganti Password
        </a>
        <div class="nav-label mt-2">Publik</div>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-globe"></i> Lihat Halaman Publik
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-person-fill text-white" style="font-size:.8rem"></i>
            </div>
            <div>
                <div style="color:#fff;font-weight:700;font-size:.8rem">{{ Auth::user()->name }}</div>
                <div style="color:rgba(255,255,255,.4);font-size:.68rem">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100" style="background:rgba(255,255,255,.12);color:#fff;border-radius:8px;font-weight:600;font-size:.8rem;border:1px solid rgba(255,255,255,.15);">
                <i class="bi bi-box-arrow-left me-1"></i>Logout
            </button>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content" id="mainContent">

    <!-- Topbar -->
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn-toggle-sidebar" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <span class="topbar-title">
                <i class="bi bi-mortarboard me-1" style="color:#1e3a5f"></i>@yield('title','Dashboard')
            </span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill d-none d-sm-inline" style="background:#0a1628;font-size:.7rem">
                <i class="bi bi-circle-fill me-1" style="font-size:.4rem;color:#4ade80"></i>Online
            </span>
            <span class="text-muted small d-none d-md-inline">{{ date('d M Y') }}</span>
        </div>
    </div>

    @if(session('sukses'))
    <div class="alert alert-sukses alert-dismissible fade show mb-3">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('sukses') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-3 rounded-3">
        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('show');
}
// Tutup sidebar saat klik menu (mobile)
document.querySelectorAll('.sidebar-link').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth < 992) closeSidebar();
    });
});
</script>
@stack('scripts')
</body>
</html>
