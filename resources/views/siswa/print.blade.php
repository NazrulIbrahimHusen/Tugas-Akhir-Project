<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Print Daftar Pendaftar — SMK Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family:'Segoe UI',sans-serif; padding:28px; }
        .header-print { text-align:center; border-bottom:3px solid #1e3a5f; padding-bottom:14px; margin-bottom:18px; }
        .header-print h3 { color:#0a1628; font-weight:800; margin:0; }
        table thead th { background:#1e3a5f!important; color:#fff!important; -webkit-print-color-adjust:exact; font-size:.82rem; padding:9px 11px; }
        table tbody td { font-size:.82rem; padding:8px 11px; }
        .stat-row { display:flex; gap:20px; justify-content:center; margin-bottom:18px; }
        .stat-box { text-align:center; padding:8px 20px; border:2px solid #0a1628; border-radius:10px; }
        .stat-box .num { font-size:1.4rem; font-weight:800; color:#1e3a5f; }
        .foto-print { width:36px; height:36px; border-radius:50%; object-fit:cover; }
        @media print { .no-print { display:none!important; } }
    </style>
</head>
<body>

<div class="text-end mb-3 no-print">
    <button onclick="window.print()" class="btn btn-primary btn-sm" style="border-radius:8px">
        🖨️ Print / Save PDF
    </button>
    <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary btn-sm ms-2" style="border-radius:8px">← Kembali</a>
</div>

<div class="header-print">
    <h3>SMK CODING</h3>
    <p class="text-muted mb-0 small">Daftar Calon Siswa Baru — Tahun Ajaran 2025/2026</p>
    <small class="text-muted">Dicetak pada {{ now()->format('d F Y, H:i') }} WIB</small>
</div>

<div class="stat-row">
    <div class="stat-box"><div class="num">{{ $total }}</div><div class="small">Total</div></div>
    <div class="stat-box"><div class="num" style="color:#4facfe">{{ $lakiLaki }}</div><div class="small">Laki-laki</div></div>
    <div class="stat-box"><div class="num" style="color:#f5576c">{{ $perempuan }}</div><div class="small">Perempuan</div></div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>No. Pendaftaran</th>
            <th>Nama Lengkap</th>
            <th>JK</th>
            <th>Agama</th>
            <th>Sekolah Asal</th>
            <th>Tgl Daftar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($siswa as $i => $s)
        <tr>
            <td>{{ $i+1 }}</td>
            <td><img src="{{ $s->foto_url }}" class="foto-print" alt="{{ $s->nama }}"></td>
            <td><strong>{{ $s->no_pendaftaran }}</strong></td>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->jenis_kelamin }}</td>
            <td>{{ $s->agama }}</td>
            <td>{{ $s->sekolah_asal }}</td>
            <td>{{ $s->created_at->format('d/m/Y') }}</td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted">Belum ada data.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="text-end text-muted small mt-2">&copy; {{ date('Y') }} SMK Coding</div>

</body>
</html>
