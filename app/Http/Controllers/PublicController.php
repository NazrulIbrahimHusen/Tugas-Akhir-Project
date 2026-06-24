<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function home()
    {
        $total = CalonSiswa::count();
        return view('public.home', compact('total'));
    }

    public function formDaftar()
    {
        return view('public.daftar');
    }

    public function simpanDaftar(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:100',
            'alamat'        => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'required|string|max:20',
            'sekolah_asal'  => 'required|string|max:100',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama.required'          => 'Nama lengkap wajib diisi.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'agama.required'         => 'Agama wajib dipilih.',
            'sekolah_asal.required'  => 'Sekolah asal wajib diisi.',
            'foto.image'             => 'File harus berupa gambar.',
            'foto.max'               => 'Ukuran foto maksimal 2MB.',
        ]);

        $data['no_pendaftaran'] = CalonSiswa::generateNoPendaftaran();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-siswa', 'public');
        }

        $siswa = CalonSiswa::create($data);

        return redirect()->route('public.sukses', $siswa->no_pendaftaran);
    }

    // Halaman sukses setelah daftar
    public function sukses($no)
    {
        $siswa = CalonSiswa::where('no_pendaftaran', $no)->firstOrFail();
        return view('public.sukses', compact('siswa'));
    }

    public function listSiswa(Request $request)
    {
        $cari  = $request->input('cari');
        $siswa = CalonSiswa::when($cari, fn($q) =>
                    $q->where('nama','like',"%$cari%")
                      ->orWhere('no_pendaftaran','like',"%$cari%")
                      ->orWhere('sekolah_asal','like',"%$cari%")
                 )->latest()->paginate(10)->withQueryString();

        $total = CalonSiswa::count();

        return view('public.list', compact('siswa','cari','total'));
    }
}
