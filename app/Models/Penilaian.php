<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Penilaian extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_penilaian',
        'id_anak',
        'id_guru',
        'id_rpph',
        'id_asesmen',
        'id_indikator',
        'nilai',
        'deskripsi',
        'tanggal',
        'periode'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_penilaian', 'desc')->first();
            $number = $last ? (int) substr($last->id_penilaian, 3) + 1 : 1;
            $model->id_penilaian = 'NIL' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'id_indikator');
    }

    public function hasilAnalisis()
    {
        return $this->hasOne(HasilAnalisis::class, 'id_penilaian');
    }

    public function rpph()
    {
        return $this->belongsTo(Rpph::class, 'id_rpph', 'id_rpph');
    }

    public function asesmen()
    {
        return $this->belongsTo(Asesmen::class, 'id_asesmen');
    }
}