<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidasiBiodata extends Model
{
    protected $table = 'validasi_biodata';

    // Relasi ke model PengajuanBiodata
    public function pengajuanBiodata()
    {
        return $this->belongsTo(PengajuanBiodata::class, 'biodata_id');
    }

    // Relasi ke model User sebagai verifikator
    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator');
    }
}
