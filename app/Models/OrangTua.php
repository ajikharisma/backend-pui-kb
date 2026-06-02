<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua';
    protected $primaryKey = 'id_orang_tua';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_orang_tua', 'id_user', 'alamat'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_orang_tua', 'desc')->first();
            $number = $last ? (int) substr($last->id_orang_tua, 3) + 1 : 1;
            $model->id_orang_tua = 'ORT' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function anak()
    {
        return $this->hasMany(Anak::class, 'id_orang_tua');
    }

    public function catatan()
    {
        return $this->hasMany(CatatanOrangTua::class, 'id_orang_tua');
    }
}