<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    protected $table = 'indikator';
    protected $primaryKey = 'id_indikator';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_indikator', 'id_aspek', 'nama_indikator'];

    public $timestamps = false; // 🔥 penting

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_indikator', 'desc')->first();
            $number = $last ? (int) substr($last->id_indikator, 3) + 1 : 1;
            $model->id_indikator = 'IND' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function aspek()
    {
        return $this->belongsTo(AspekPerkembangan::class, 'id_aspek');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_indikator');
    }

    public function rpph()
    {
        return $this->belongsToMany(
            Rpph::class,
            'rpph_indikator',
            'id_indikator',
            'id_rpph'
        );
    }
}