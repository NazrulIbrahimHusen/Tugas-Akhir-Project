@extends('layouts.app')
@section('title','Edit Data Siswa')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-form">
            <div class="card-header" style="background:linear-gradient(135deg,#d97706,#b45309)!important;color:#fff!important">
                <h5 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Data — {{ $siswa->nama }}</h5>
                <small class="opacity-75">No. Pendaftaran: {{ $siswa->no_pendaftaran }}</small>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('siswa._form')
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary flex-fill" style="border-radius:10px;padding:12px">
                            <i class="bi bi-arrow-left me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn flex-fill"
                                style="background:linear-gradient(135deg,#d97706,#b45309);border:none;color:#fff;border-radius:10px;padding:12px;font-weight:700;">
                            <i class="bi bi-floppy-fill me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
