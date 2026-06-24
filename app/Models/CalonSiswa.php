<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    protected $table    = 'calon_siswa';
    protected $fillable = [
        'no_pendaftaran', 'nama', 'alamat',
        'jenis_kelamin', 'agama', 'sekolah_asal', 'foto',
    ];

    // Generate nomor pendaftaran otomatis: SMK-2025-0001
    public static function generateNoPendaftaran(): string
    {
        $tahun  = date('Y');
        $prefix = "SMK-{$tahun}-";
        $last   = self::where('no_pendaftaran', 'like', "{$prefix}%")
                      ->orderByDesc('no_pendaftaran')
                      ->first();
        $urut   = $last ? ((int) substr($last->no_pendaftaran, -4)) + 1 : 1;
        return $prefix . str_pad($urut, 4, '0', STR_PAD_LEFT);
    }

    // URL foto (pakai default kalau tidak ada)
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(storage_path("app/public/{$this->foto}"))) {
            return asset("storage/{$this->foto}");
        }
        return "https://ui-avatars.com/api/?name=" . urlencode($this->nama) . "&background=667eea&color=fff&size=100";
    }
}
