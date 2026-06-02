<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanOrangTua extends Model
{
    protected $table = 'catatan_orang_tua';
    protected $primaryKey = 'id_catatan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_catatan','id_anak','id_orang_tua',
        'judul_catatan','isi_catatan','tanggal'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_catatan', 'desc')->first();
            $number = $last ? (int) substr($last->id_catatan, 3) + 1 : 1;
            $model->id_catatan = 'CTT' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'id_orang_tua');
    }
}