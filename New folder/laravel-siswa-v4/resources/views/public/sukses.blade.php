<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil — SMK Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:linear-gradient(135deg,#0a1628,#1e3a5f); min-height:100vh; display:flex; align-items:center; justify-content:center; font-family:'Segoe UI',sans-serif; padding:30px 0; }
        .card { border-radius:24px; border:none; box-shadow:0 20px 60px rgba(0,0,0,.35); max-width:480px; width:100%; border-top:5px solid #2563eb; }
        .card-body { padding:40px; text-align:center; }
        .check-icon { width:76px; height:76px; border-radius:50%; background:linear-gradient(135deg,#16a34a,#15803d); display:flex; align-items:center; justify-content:center; margin:0 auto 18px; font-size:2rem; color:#fff; box-shadow:0 4px 20px rgba(22,163,74,.4); }
        .no-daftar { background:linear-gradient(135deg,#0a1628,#1e3a5f); color:#fff; border-radius:14px; padding:16px 24px; display:inline-block; font-size:1.4rem; font-weight:800; letter-spacing:2px; margin:14px 0; }
        .info-row { background:#f8fafc; border-radius:12px; padding:13px 18px; margin-bottom:8px; display:flex; justify-content:space-between; align-items:center; }
        .info-row .label { color:#64748b; font-size:.85rem; }
        .info-row .val { font-weight:700; color:#0a1628; font-size:.9rem; }
        .foto-siswa { width:88px; height:88px; border-radius:50%; object-fit:cover; border:4px solid #e2e8f0; box-shadow:0 4px 16px rgba(0,0,0,.12); margin-bottom:10px; }
        .btn-home { background:linear-gradient(135deg,#0a1628,#1e3a5f); border:none; color:#fff; border-radius:12px; padding:12px 28px; font-weight:700; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <img src="{{ $siswa->foto_url }}" class="foto-siswa" alt="{{ $siswa->nama }}">
                    <div class="check-icon"><i class="bi bi-check-lg"></i></div>
                    <h4 class="fw-bold mb-1" style="color:#0a1628">Pendaftaran Berhasil! 🎉</h4>
                    <p class="text-muted small mb-2">Simpan nomor pendaftaran kamu!</p>
                    <div class="no-daftar">{{ $siswa->no_pendaftaran }}</div>
                    <p class="text-muted small mb-3">Nomor Pendaftaran</p>
                    <div class="text-start">
                        <div class="info-row"><span class="label"><i class="bi bi-person me-1"></i>Nama</span><span class="val">{{ $siswa->nama }}</span></div>
                        <div class="info-row"><span class="label"><i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin</span><span class="val">{{ $siswa->jenis_kelamin }}</span></div>
                        <div class="info-row"><span class="label"><i class="bi bi-book me-1"></i>Agama</span><span class="val">{{ $siswa->agama }}</span></div>
                        <div class="info-row"><span class="label"><i class="bi bi-building me-1"></i>Sekolah Asal</span><span class="val">{{ $siswa->sekolah_asal }}</span></div>
                        <div class="info-row"><span class="label"><i class="bi bi-calendar me-1"></i>Tanggal Daftar</span><span class="val">{{ $siswa->created_at->format('d M Y') }}</span></div>
                    </div>
                    <div class="alert alert-warning rounded-3 text-start small mt-3 mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Catat nomor pendaftaran kamu!</strong> Nomor ini digunakan untuk keperluan administrasi.
                    </div>
                    <div class="d-flex gap-3">
                        <a href="{{ route('public.daftar') }}" class="btn btn-outline-secondary flex-fill" style="border-radius:10px">Daftar Lagi</a>
                        <a href="{{ route('home') }}" class="btn btn-home flex-fill">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
