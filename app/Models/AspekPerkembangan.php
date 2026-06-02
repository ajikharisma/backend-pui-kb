<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspekPerkembangan extends Model
{
    protected $table = 'aspek_perkembangan';
    protected $primaryKey = 'id_aspek';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_aspek', 'nama_aspek'];

    public $timestamps = false; // karena di migration tidak ada

    // 🔥 AUTO GENERATE ID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_aspek', 'desc')->first();
            $number = $last ? (int) substr($last->id_aspek, 3) + 1 : 1;
            $model->id_aspek = 'ASP' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function indikator()
    {
        return $this->hasMany(Indikator::class, 'id_aspek');
    }
}