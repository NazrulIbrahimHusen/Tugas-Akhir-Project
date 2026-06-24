@extends('layouts.app')
@section('title','Ganti Password')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-form">
            <div class="card-header">
                <h5 class="fw-bold mb-0"><i class="bi bi-key me-2"></i>Ganti Password</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('ganti.password.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <div class="input-group">
                            <input type="password" name="password_lama" id="pw1" class="form-control @error('password_lama') is-invalid @enderror" placeholder="••••••••" required>
                            <button type="button" class="btn btn-outline-secondary" style="border-radius:0 10px 10px 0"
                                    onclick="let i=document.getElementById('pw1');i.type=i.type==='password'?'text':'password'">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password_lama')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password_baru" id="pw2" class="form-control @error('password_baru') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                            <button type="button" class="btn btn-outline-secondary" style="border-radius:0 10px 10px 0"
                                    onclick="let i=document.getElementById('pw2');i.type=i.type==='password'?'text':'password'">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password_baru')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation" class="form-control" placeholder="Ulangi password baru" required>
                    </div>
                    <button type="submit" class="btn btn-grad w-100" style="padding:12px">
                        <i class="bi bi-key me-2"></i>Simpan Password Baru
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
