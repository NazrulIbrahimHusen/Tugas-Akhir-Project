<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pendaftar — SMK Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f0f4f8; font-family:'Segoe UI',sans-serif; padding:28px 0; }
        .topbar-pub { background:linear-gradient(135deg,#0a1628,#1e3a5f); border-radius:20px; color:#fff; padding:24px 28px; margin-bottom:20px; }
        .card-table { border-radius:16px; border:none; box-shadow:0 4px 24px rgba(10,22,40,.12); overflow:hidden; }
        .table thead th { background:#0a1628; color:#fff; font-weight:600; border:none; padding:12px 14px; font-size:.86rem; }
        .table tbody tr:hover { background:#e8f0fb; }
        .table tbody td { vertical-align:middle; padding:11px 14px; border-color:#f0f0f0; font-size:.88rem; }
        .badge-lk    { background:linear-gradient(135deg,#2563eb,#1d4ed8); color:#fff; }
        .badge-pr    { background:linear-gradient(135deg,#dc2626,#b91c1c); color:#fff; }
        .badge-agama { background:linear-gradient(135deg,#0369a1,#0284c7); color:#fff; }
        .badge-gen   { border-radius:20px; padding:3px 10px; font-size:.75rem; font-weight:600; }
        .badge-no    { background:linear-gradient(135deg,#0a1628,#1e3a5f); color:#fff; border-radius:7px; padding:3px 9px; font-size:.75rem; font-weight:700; }
        .search-box  { border-radius:10px; border:1.5px solid #d0dae8; padding:9px 14px; }
        .search-box:focus { border-color:#1e3a5f; box-shadow:0 0 0 3px rgba(30,58,95,.15); outline:none; }
        .btn-navy    { background:linear-gradient(135deg,#0a1628,#1e3a5f); border:none; color:#fff; border-radius:10px; padding:9px 18px; font-weight:600; font-size:.88rem; }
        .no-data     { text-align:center; padding:40px; color:#aaa; }
        .no-data i   { font-size:2.5rem; display:block; margin-bottom:10px; }
        .foto-thumb  { width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid #d0dae8; }
        .readonly-badge { background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.2); color:#fff; border-radius:20px; padding:3px 12px; font-size:.75rem; font-weight:600; }
        .stat-box { background:rgba(255,255,255,.12); border-radius:10px; padding:10px 18px; text-align:center; min-width:90px; }
        .stat-box .num { font-size:1.5rem; font-weight:700; }
        .stat-box .lbl { font-size:.7rem; opacity:.75; }
    </style>
</head>
<body>
<div class="container-lg">
    <div class="topbar-pub">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <a href="{{ route('home') }}" class="text-white opacity-75 text-decoration-none small"><i class="bi bi-arrow-left me-1"></i>Beranda</a>
                    <span class="readonly-badge ms-1"><i class="bi bi-eye me-1"></i>Mode Lihat Saja</span>
                </div>
                <h4 class="fw-bold mb-0"><i class="bi bi-table me-2"></i>Daftar Pendaftar</h4>
                <p class="mb-0 small" style="color:rgba(255,255,255,.6)">SMK Coding — Tahun Ajaran 2025/2026</p>
            </div>
            <div class="d-flex gap-3 flex-wrap align-items-center">
                <div class="stat-box"><div class="num">{{ $total }}</div><div class="lbl">Total</div></div>
                <a href="{{ route('public.daftar') }}" class="btn" style="background:#fff;color:#0a1628;border-radius:12px;font-weight:700;padding:10px 18px;font-size:.88rem;">
                    <i class="bi bi-pencil-square me-1"></i>Daftar Sekarang
                </a>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <form method="GET" action="{{ route('public.list') }}" class="d-flex gap-2">
            <input type="text" name="cari" class="search-box" style="width:250px;" placeholder="🔍 Cari nama atau no. pendaftaran..." value="{{ $cari }}">
            <button type="submit" class="btn btn-navy">Cari</button>
            @if($cari)<a href="{{ route('public.list') }}" class="btn btn-outline-secondary" style="border-radius:10px;font-size:.88rem;">Reset</a>@endif
        </form>
        <span class="text-muted small"><i class="bi bi-info-circle me-1"></i>Untuk mengubah data, hubungi admin.</span>
    </div>

    <div class="card card-table">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr><th>Foto</th><th>No. Daftar</th><th>Nama</th><th>JK</th><th>Agama</th><th>Sekolah Asal</th><th>Tgl Daftar</th></tr>
                </thead>
                <tbody>
                    @forelse($siswa as $s)
                    <tr>
                        <td><img src="{{ $s->foto_url }}" class="foto-thumb" alt="{{ $s->nama }}"></td>
                        <td><span class="badge-no">{{ $s->no_pendaftaran }}</span></td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td><span class="badge badge-gen {{ $s->jenis_kelamin==='Laki-laki' ? 'badge-lk' : 'badge-pr' }}">{{ $s->jenis_kelamin }}</span></td>
                        <td><span class="badge badge-gen badge-agama">{{ $s->agama }}</span></td>
                        <td>{{ $s->sekolah_asal }}</td>
                        <td class="text-muted small">{{ $s->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7"><div class="no-data"><i class="bi bi-inbox"></i>{{ $cari ? 'Tidak ada hasil.' : 'Belum ada pendaftar.' }}</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="text-muted small">Menampilkan {{ $siswa->firstItem() ?? 0 }}–{{ $siswa->lastItem() ?? 0 }} dari {{ $siswa->total() }}</span>
            {{ $siswa->links() }}
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
