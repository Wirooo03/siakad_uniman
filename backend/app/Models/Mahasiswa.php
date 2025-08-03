<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'jurusan',
        'semester',
        'status',
        'tanggal_masuk',
        'alamat',
        'telepon',
        // Informasi Pendaftaran
        'program_studi',
        'konsentrasi',
        'periode_masuk',
        'tahun_kurikulum',
        'sistem_kuliah',
        'kelas_kelompok',
        'jenis_pendaftaran',
        'jalur_pendaftaran',
        'gelombang',
        'kebutuhan_khusus',
        'biodata_valid',
        'kampus',
        // Informasi Umum
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'suku',
        'berat_badan',
        'tinggi_badan',
        'golongan_darah',
        'transportasi',
        // Administrasi
        'kewarganegaraan',
        'nik',
        'paspor',
        'no_kk',
        'no_kps',
        'status_nikah',
        'ukuran_jas',
        'file_akta',
        // Kontak
        'no_hp',
        'kepemilikan_hp',
        'email_kampus',
        'email_pribadi',
        // Pekerjaan
        'pekerjaan',
        'instansi_pekerjaan',
        'penghasilan',
        // Bank
        'no_rekening',
        'nama_rekening',
        'nama_bank',
        // Academic
        'sks_total',
        'ipk'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_lahir' => 'date',
        'semester' => 'integer',
        'berat_badan' => 'integer',
        'tinggi_badan' => 'integer',
        'sks_total' => 'integer',
        'ipk' => 'decimal:2'
    ];

    // Relasi dengan tabel terkait
    public function domisili()
    {
        return $this->hasOne(MahasiswaDomisili::class);
    }

    public function orangTua()
    {
        return $this->hasOne(MahasiswaOrtu::class);
    }

    public function wali()
    {
        return $this->hasOne(MahasiswaWali::class);
    }

    public function perguruanTinggiAsal()
    {
        return $this->hasOne(MahasiswaPtAsal::class);
    }

    // Scope untuk mahasiswa aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope berdasarkan jurusan
    public function scopeJurusan($query, $jurusan)
    {
        return $query->where('jurusan', $jurusan);
    }
}
