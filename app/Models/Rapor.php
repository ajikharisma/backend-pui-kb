<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    protected $table      = 'rapor';
    protected $primaryKey = 'id_rapor';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_rapor', 'id_anak', 'semester', 'tahun_ajaran', 'fase',
        'id_guru', 'status',
        'narasi_nabp_1', 'narasi_nabp_2', 'narasi_nabp_3', 'narasi_nabp_4',
        'narasi_jd_1', 'narasi_jd_2', 'narasi_jd_3', 'narasi_jd_4',
        'narasi_lmstrs_1', 'narasi_lmstrs_2', 'narasi_lmstrs_3', 'narasi_lmstrs_4',
        'narasi_lmstrs_5', 'narasi_lmstrs_6', 'narasi_lmstrs_7',
        'tinggi_badan', 'berat_badan', 'lingkar_kepala',
        'hadir', 'sakit', 'izin', 'tanpa_keterangan',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}