<div class="mb-3">
    <label class="form-label"><i class="bi bi-person me-1 text-primary"></i>Nama Lengkap</label>
    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $siswa->nama ?? '') }}" placeholder="Nama lengkap sesuai ijazah" required>
    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label"><i class="bi bi-geo-alt me-1 text-primary"></i>Alamat Rumah</label>
    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
              rows="3" placeholder="Alamat lengkap" required>{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label"><i class="bi bi-gender-ambiguous me-1 text-primary"></i>Jenis Kelamin</label>
    <div class="d-flex gap-3">
        <label class="radio-card flex-fill">
            <input type="radio" name="jenis_kelamin" value="Laki-laki"
                {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Laki-laki' ? 'checked' : '' }} required>
            <i class="bi bi-gender-male text-primary"></i> Laki-laki
        </label>
        <label class="radio-card flex-fill">
            <input type="radio" name="jenis_kelamin" value="Perempuan"
                {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}>
            <i class="bi bi-gender-female text-danger"></i> Perempuan
        </label>
    </div>
    @error('jenis_kelamin')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label"><i class="bi bi-book me-1 text-primary"></i>Agama</label>
    <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
        <option value="" disabled {{ old('agama', $siswa->agama ?? '') == '' ? 'selected' : '' }}>-- Pilih Agama --</option>
        @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $agama)
        <option value="{{ $agama }}" {{ old('agama', $siswa->agama ?? '') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
        @endforeach
    </select>
    @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label"><i class="bi bi-building me-1 text-primary"></i>Sekolah Asal</label>
    <input type="text" name="sekolah_asal" class="form-control @error('sekolah_asal') is-invalid @enderror"
           value="{{ old('sekolah_asal', $siswa->sekolah_asal ?? '') }}" placeholder="Nama SMP / MTs asal" required>
    @error('sekolah_asal')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label"><i class="bi bi-image me-1 text-primary"></i>Foto (opsional)</label>
    @isset($siswa)
    @if($siswa->foto)
    <div class="mb-2">
        <img src="{{ $siswa->foto_url }}" style="width:80px;height:80px;border-radius:12px;object-fit:cover;border:2px solid #e0e0e0;" alt="Foto saat ini">
        <div class="text-muted small mt-1">Foto saat ini. Upload baru untuk mengganti.</div>
    </div>
    @endif
    @endisset
    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
           accept="image/jpg,image/jpeg,image/png" onchange="previewFoto(this)">
    <div class="text-muted small mt-1">Format: JPG, PNG. Maks: 2MB</div>
    <img id="preview" src="" style="display:none;width:80px;height:80px;border-radius:12px;object-fit:cover;margin-top:8px;border:2px solid #1e3a5f;">
    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

@push('scripts')
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
@endpush
