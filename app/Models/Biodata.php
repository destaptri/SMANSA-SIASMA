<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'user_id',
        'nisn',
        'nama_lengkap',
        'kelas',
        'tahun_lulus',
        'universitas',
        'fakultas',
        'jurusan',
        'jalur_penerimaan',
        'pilihan_pertama',
        'pilihan_kedua',
        'skor_utbk',
        'tahun_diterima',
        'status_bekerja',
        'foto_pribadi'
    ];
}
