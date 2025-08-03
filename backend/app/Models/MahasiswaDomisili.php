<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaDomisili extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_domisili';

    protected $fillable = [
        'mahasiswa_id',
        'alamat_ktp',
        'rt_ktp',
        'rw_ktp',
        'kelurahan_ktp',
        'kecamatan_ktp',
        'kabupaten_ktp',
        'provinsi_ktp',
        'kode_pos_ktp',
        'alamat_domisili',
        'rt_domisili',
        'rw_domisili',
        'kelurahan_domisili',
        'kecamatan_domisili',
        'kabupaten_domisili',
        'provinsi_domisili',
        'kode_pos_domisili'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
