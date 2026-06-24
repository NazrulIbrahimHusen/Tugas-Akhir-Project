@extends('layouts.app')
@section('title','Daftar Pendaftar')
@section('content')

<div class="row g-3 mb-4">
    @foreach([['Total','people-fill',$total,'#1e3a5f','#0a1628'],['Laki-laki','gender-male',$lakiLaki,'#4facfe','#00f2fe'],['Perempuan','gender-female',$perempuan,'#f093fb','#f5576c']] as [$lbl,$icon,$val,$c1,$c2])
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3 p-3">
                <div class="stat-icon" style="background:linear-gradient(135deg,{{$c1}},{{$c2}})"><i class="bi bi-{{$icon}}"></i></div>
                <div>
                    <div style="font-size:1.5rem;font-weight:800;color:#1e3a5f">{{$val}}</div>
                    <div class="text-muted fw-semibold small">{{$lbl}}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <form method="GET" action="{{ route('siswa.index') }}" class="d-flex gap-2">
        <input type="text" name="cari" class="form-control" style="width:250px;"
               placeholder="🔍 Cari nama, no. daftar, sekolah..." value="{{ $cari }}">
        <button type="submit" class="btn btn-grad px-3">Cari</button>
        @if($cari)<a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;">Reset</a>@endif
    </form>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('siswa.print') }}" target="_blank" class="btn btn-outline-secondary" style="border-radius:10px;font-size:.85rem;">
            <i class="bi bi-printer me-1"></i>Print PDF
        </a>
        <a href="{{ route('siswa.export') }}" class="btn btn-outline-success" style="border-radius:10px;font-size:.85rem;">
            <i class="bi bi-file-earmark-excel me-1"></i>Export Excel
        </a>
        <a href="{{ route('siswa.create') }}" class="btn btn-grad px-3">
            <i class="bi bi-plus-lg me-1"></i>Tambah
        </a>
    </div>
</div>

<div class="card card-table">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Foto</th><th>No. Daftar</th><th>Nama</th>
                    <th>JK</th><th>Agama</th><th>Sekolah Asal</th><th>Tgl Daftar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $s)
                <tr>
                    <td><img src="{{ $s->foto_url }}" class="foto-thumb" alt="{{ $s->nama }}"></td>
                    <td><span class="badge-no">{{ $s->no_pendaftaran }}</span></td>
                    <td><strong>{{ $s->nama }}</strong><br><small class="text-muted">{{ Str::limit($s->alamat, 30) }}</small></td>
                    <td>
                        <span class="badge badge-gen {{ $s->jenis_kelamin==='Laki-laki' ? 'badge-lk' : 'badge-pr' }}">
                            <i class="bi bi-gender-{{ $s->jenis_kelamin==='Laki-laki' ? 'male' : 'female' }} me-1"></i>{{ $s->jenis_kelamin }}
                        </span>
                    </td>
                    <td><span class="badge badge-gen badge-agama">{{ $s->agama }}</span></td>
                    <td>{{ $s->sekolah_asal }}</td>
                    <td class="text-muted small">{{ $s->created_at->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('siswa.edit', $s->id) }}" class="btn btn-edit me-1">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus data {{ addslashes($s->nama) }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-hapus"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8"><div class="no-data"><i class="bi bi-inbox"></i>{{ $cari ? 'Tidak ada hasil.' : 'Belum ada data.' }}</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span class="text-muted small">Menampilkan {{ $siswa->firstItem() ?? 0 }}–{{ $siswa->lastItem() ?? 0 }} dari {{ $siswa->total() }}</span>
        {{ $siswa->links() }}
    </div>
</div>

@endsection
