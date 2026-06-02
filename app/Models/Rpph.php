<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rpph extends Model
{
    protected $table = 'rpph';

    protected $primaryKey = 'id_rpph';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_rpph',
        'tema',
        'minggu',
        'hari',
        'topik_harian',
        'semester',
        'tahun_ajaran'
    ];

    /*
    |--------------------------------------------------------------------------
    | AUTO GENERATE ID RPPH
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($rpph) {

            $lastData = self::orderBy('id_rpph', 'desc')->first();

            if (!$lastData) {
                $number = 1;
            } else {

                $lastNumber = (int) substr($lastData->id_rpph, 4);

                $number = $lastNumber + 1;
            }

            $rpph->id_rpph = 'RPPH' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE INDIKATOR
    |--------------------------------------------------------------------------
    */

    public function indikator()
    {
        return $this->belongsToMany(
            Indikator::class,
            'rpph_indikator',
            'id_rpph',
            'id_indikator'
        );
    }
}