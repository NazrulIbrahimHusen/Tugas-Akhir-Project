@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="row g-4 mb-4">
    @foreach([['Total Pendaftar','people-fill',$total,'#1e3a5f','#0a1628'],['Laki-laki','gender-male',$lakiLaki,'#4facfe','#00f2fe'],['Perempuan','gender-female',$perempuan,'#f093fb','#f5576c']] as [$lbl,$icon,$val,$c1,$c2])
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="stat-icon" style="background:linear-gradient(135deg,{{$c1}},{{$c2}})"><i class="bi bi-{{$icon}}"></i></div>
                <div>
                    <div style="font-size:1.9rem;font-weight:800;color:#1e3a5f">{{$val}}</div>
                    <div class="text-muted fw-semibold small">{{$lbl}}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card card-table h-100">
            <div class="card-header" style="background:linear-gradient(135deg,#0a1628,#1e3a5f);color:#fff;padding:14px 22px;">
                <h6 class="fw-bold mb-0"><i class="bi bi-bar-chart-fill me-2"></i>Statistik Agama</h6>
            </div>
            <div class="card-body p-4">
                @forelse($agamas as $a)
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fw-semibold small">{{ $a->agama }}</span>
                        <span class="text-muted small">{{ $a->jumlah }} orang</span>
                    </div>
                    <div class="progress" style="height:7px;border-radius:10px;">
                        <div class="progress-bar" style="width:{{ $total > 0 ? ($a->jumlah/$total*100) : 0 }}%;background:linear-gradient(135deg,#0a1628,#1e3a5f);border-radius:10px;"></div>
                    </div>
                </div>
                @empty<p class="text-muted text-center py-3 small">Belum ada data</p>@endforelse
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-table h-100">
            <div class="card-header" style="background:linear-gradient(135deg,#d97706,#b45309);color:#fff;padding:14px 22px;">
                <h6 class="fw-bold mb-0"><i class="bi bi-building me-2"></i>Top 5 Sekolah Asal</h6>
            </div>
            <div class="card-body p-4">
                @forelse($sekolah as $i => $s)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,#d97706,#b45309);display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:.78rem;">{{ $i+1 }}</div>
                    <div class="flex-fill">
                        <div class="fw-semibold small">{{ $s->sekolah_asal }}</div>
                        <div class="text-muted" style="font-size:.75rem">{{ $s->jumlah }} pendaftar</div>
                    </div>
                </div>
                @empty<p class="text-muted text-center py-3 small">Belum ada data</p>@endforelse
            </div>
        </div>
    </div>
</div>

<div class="card card-table">
    <div class="card-header" style="background:linear-gradient(135deg,#0369a1,#0284c7);color:#fff;padding:14px 22px;">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Pendaftar Terbaru</h6>
            <a href="{{ route('siswa.index') }}" class="btn btn-sm" style="background:rgba(0,0,0,.1);color:#fff;border-radius:8px;font-weight:600;font-size:.8rem;">Lihat Semua</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Foto</th><th>No. Daftar</th><th>Nama</th><th>JK</th><th>Agama</th><th>Waktu</th></tr></thead>
            <tbody>
                @forelse($terbaru as $s)
                <tr>
                    <td><img src="{{ $s->foto_url }}" class="foto-thumb" alt="{{ $s->nama }}"></td>
                    <td><span class="badge-no">{{ $s->no_pendaftaran }}</span></td>
                    <td><strong>{{ $s->nama }}</strong></td>
                    <td><span class="badge badge-gen {{ $s->jenis_kelamin==='Laki-laki' ? 'badge-lk' : 'badge-pr' }}">{{ $s->jenis_kelamin }}</span></td>
                    <td><span class="badge badge-gen badge-agama">{{ $s->agama }}</span></td>
                    <td class="text-muted small">{{ $s->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="6"><div class="no-data"><i class="bi bi-inbox"></i>Belum ada pendaftar.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
