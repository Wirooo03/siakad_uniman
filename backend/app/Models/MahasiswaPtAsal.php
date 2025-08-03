<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPtAsal extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_pt_asal';

    protected $fillable = [
        'mahasiswa_id',
        'nama_pt_asal',
        'fakultas_asal',
        'prodi_asal',
        'jenjang_asal',
        'tahun_masuk_asal',
        'tahun_lulus_asal',
        'no_ijazah',
        'tanggal_ijazah',
        'ipk_asal'
    ];

    protected $casts = [
        'tahun_masuk_asal' => 'integer',
        'tahun_lulus_asal' => 'integer',
        'tanggal_ijazah' => 'date',
        'ipk_asal' => 'decimal:2'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
