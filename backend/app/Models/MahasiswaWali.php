<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaWali extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_wali';

    protected $fillable = [
        'mahasiswa_id',
        'nama_wali',
        'nik_wali',
        'tanggal_lahir_wali',
        'pendidikan_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'telepon_wali',
        'hubungan_wali'
    ];

    protected $casts = [
        'tanggal_lahir_wali' => 'date'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
