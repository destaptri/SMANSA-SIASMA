<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidasiBiodata extends Model
{
    protected $table = 'validasi_biodata';

    protected $fillable = [
        'biodata_id',
        'verifikator',
        'status',
        'tanggal_verifikasi'
    ];

    public function pengajuanBiodata()
    {
        return $this->belongsTo(PengajuanBiodata::class, 'biodata_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'verifikator');
    }
}