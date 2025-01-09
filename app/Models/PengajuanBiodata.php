<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBiodata extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_biodata';

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
        'tahun_diterima',
        'status_bekerja',
        'foto_pribadi',
    ];

    // Status validasi will use the database default 'menunggu'
    protected $attributes = [
        'status_validasi' => 'menunggu'
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}