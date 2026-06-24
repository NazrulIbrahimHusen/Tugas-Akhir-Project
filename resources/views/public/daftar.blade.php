<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran — SMK Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:linear-gradient(135deg,#0a1628,#1e3a5f); min-height:100vh; padding:36px 0; font-family:'Segoe UI',sans-serif; }
        .card { border-radius:20px; border:none; box-shadow:0 16px 50px rgba(0,0,0,.3); }
        .card-header-pub { background:linear-gradient(135deg,#0a1628,#1e3a5f); border-radius:20px 20px 0 0; padding:24px 30px; color:#fff; }
        .card-body { padding:30px; }
        .form-control,.form-select { border-radius:10px; border:1.5px solid #d0dae8; padding:10px 14px; }
        .form-control:focus,.form-select:focus { border-color:#1e3a5f; box-shadow:0 0 0 3px rgba(30,58,95,.15); }
        .form-label { font-weight:600; color:#2d3748; font-size:.9rem; }
        .btn-submit { background:linear-gradient(135deg,#0a1628,#1e3a5f); border:none; color:#fff; border-radius:12px; padding:13px; font-weight:700; transition:opacity .2s; }
        .btn-submit:hover { opacity:.85; color:#fff; }
        .radio-card { border:2px solid #d0dae8; border-radius:10px; padding:10px 14px; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:8px; font-size:.9rem; }
        .radio-card:has(input:checked) { border-color:#1e3a5f; background:#e8f0fb; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('home') }}" class="text-white text-decoration-none opacity-75 small"><i class="bi bi-arrow-left me-1"></i>Beranda</a>
                <a href="{{ route('public.list') }}" class="text-white text-decoration-none opacity-75 small"><i class="bi bi-list-ul me-1"></i>Lihat Pendaftar</a>
            </div>
            <div class="card">
                <div class="card-header-pub">
                    <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Formulir Pendaftaran</h4>
                    <p class="mb-0 opacity-75 small">Lengkapi semua data dengan benar dan jujur.</p>
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 alert-dismissible fade show small">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    <form action="{{ route('public.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person me-1" style="color:#1e3a5f"></i>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama lengkap sesuai ijazah" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-geo-alt me-1" style="color:#1e3a5f"></i>Alamat Rumah</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-gender-ambiguous me-1" style="color:#1e3a5f"></i>Jenis Kelamin</label>
                            <div class="d-flex gap-3">
                                <label class="radio-card flex-fill">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'checked' : '' }} required>
                                    <i class="bi bi-gender-male text-primary"></i> Laki-laki
                                </label>
                                <label class="radio-card flex-fill">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'checked' : '' }}>
                                    <i class="bi bi-gender-female text-danger"></i> Perempuan
                                </label>
                            </div>
                            @error('jenis_kelamin')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-book me-1" style="color:#1e3a5f"></i>Agama</label>
                            <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Agama --</option>
                                @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $agama)
                                <option value="{{ $agama }}" {{ old('agama')==$agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                            @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-building me-1" style="color:#1e3a5f"></i>Sekolah Asal</label>
                            <input type="text" name="sekolah_asal" class="form-control @error('sekolah_asal') is-invalid @enderror" value="{{ old('sekolah_asal') }}" placeholder="Nama SMP / MTs asal" required>
                            @error('sekolah_asal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-image me-1" style="color:#1e3a5f"></i>Foto (opsional)</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/jpg,image/jpeg,image/png" onchange="previewFoto(this)">
                            <div class="text-muted small mt-1">Format: JPG, PNG. Maks: 2MB</div>
                            <img id="preview" src="" style="display:none;width:80px;height:80px;border-radius:12px;object-fit:cover;margin-top:8px;border:2px solid #1e3a5f;">
                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary flex-fill" style="border-radius:10px;padding:12px">Batal</a>
                            <button type="submit" class="btn btn-submit flex-fill"><i class="bi bi-send-fill me-2"></i>Kirim Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewFoto(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
