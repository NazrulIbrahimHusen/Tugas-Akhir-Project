<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $siswa = CalonSiswa::when($cari, fn($q) =>
                    $q->where('nama','like',"%$cari%")
                      ->orWhere('no_pendaftaran','like',"%$cari%")
                      ->orWhere('sekolah_asal','like',"%$cari%")
                      ->orWhere('agama','like',"%$cari%")
                 )->latest()->paginate(10)->withQueryString();

        $total     = CalonSiswa::count();
        $lakiLaki  = CalonSiswa::where('jenis_kelamin','Laki-laki')->count();
        $perempuan = CalonSiswa::where('jenis_kelamin','Perempuan')->count();

        return view('siswa.index', compact('siswa','cari','total','lakiLaki','perempuan'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:100',
            'alamat'        => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'required|string|max:20',
            'sekolah_asal'  => 'required|string|max:100',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['no_pendaftaran'] = CalonSiswa::generateNoPendaftaran();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-siswa', 'public');
        }

        CalonSiswa::create($data);

        return redirect()->route('siswa.index')->with('sukses', 'Data pendaftar berhasil ditambahkan!');
    }

    public function edit(CalonSiswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, CalonSiswa $siswa)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:100',
            'alamat'        => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'required|string|max:20',
            'sekolah_asal'  => 'required|string|max:100',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($siswa->foto) Storage::disk('public')->delete($siswa->foto);
            $data['foto'] = $request->file('foto')->store('foto-siswa', 'public');
        }

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('sukses', 'Data berhasil diperbarui!');
    }

    public function destroy(CalonSiswa $siswa)
    {
        if ($siswa->foto) Storage::disk('public')->delete($siswa->foto);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('sukses', 'Data berhasil dihapus!');
    }

    // Print PDF
    public function print()
    {
        $siswa     = CalonSiswa::orderBy('no_pendaftaran')->get();
        $total     = $siswa->count();
        $lakiLaki  = $siswa->where('jenis_kelamin','Laki-laki')->count();
        $perempuan = $siswa->where('jenis_kelamin','Perempuan')->count();
        return view('siswa.print', compact('siswa','total','lakiLaki','perempuan'));
    }

    // Export Excel (CSV)
    public function exportExcel()
    {
        $siswa = CalonSiswa::orderBy('no_pendaftaran')->get();

        $filename = 'data-pendaftar-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($siswa) {
            $file = fopen('php://output', 'w');
            // BOM untuk Excel agar UTF-8 terbaca
            fputs($file, "\xEF\xBB\xBF");
            // Header kolom
            fputcsv($file, ['No', 'No. Pendaftaran', 'Nama Lengkap', 'Alamat', 'Jenis Kelamin', 'Agama', 'Sekolah Asal', 'Tanggal Daftar']);
            foreach ($siswa as $i => $s) {
                fputcsv($file, [
                    $i + 1,
                    $s->no_pendaftaran,
                    $s->nama,
                    $s->alamat,
                    $s->jenis_kelamin,
                    $s->agama,
                    $s->sekolah_asal,
                    $s->created_at->format('d/m/Y'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
