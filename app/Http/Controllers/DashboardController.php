<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $total     = CalonSiswa::count();
        $lakiLaki  = CalonSiswa::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = CalonSiswa::where('jenis_kelamin', 'Perempuan')->count();
        $agamas    = CalonSiswa::selectRaw('agama, COUNT(*) as jumlah')->groupBy('agama')->orderByDesc('jumlah')->get();
        $sekolah   = CalonSiswa::selectRaw('sekolah_asal, COUNT(*) as jumlah')->groupBy('sekolah_asal')->orderByDesc('jumlah')->limit(5)->get();
        $terbaru   = CalonSiswa::latest()->limit(5)->get();

        return view('dashboard', compact('total','lakiLaki','perempuan','agamas','sekolah','terbaru'));
    }
}
