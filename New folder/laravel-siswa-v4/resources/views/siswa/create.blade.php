@extends('layouts.app')
@section('title','Tambah Pendaftar')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-form">
            <div class="card-header">
                <h5 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Data Pendaftar</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('siswa._form')
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary flex-fill" style="border-radius:10px;padding:12px">
                            <i class="bi bi-arrow-left me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-grad flex-fill" style="padding:12px">
                            <i class="bi bi-send-fill me-2"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
