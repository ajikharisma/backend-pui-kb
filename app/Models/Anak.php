<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $table = 'anak';
    protected $primaryKey = 'id_anak';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_anak', 'id_orang_tua', 'nama_anak', 'kelompok', 'tanggal_lahir', 'foto', 'tempat_lahir', 'jenis_kelamin','agama'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_anak', 'desc')->first();
            $number = $last ? (int) substr($last->id_anak, 3) + 1 : 1;
            $model->id_anak = 'ANK' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'id_orang_tua');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_anak');
    }

    public function hasilAnalisis()
    {
        return $this->hasMany(HasilAnalisis::class, 'id_anak');
    }

    public function catatan()
    {
        return $this->hasMany(CatatanOrangTua::class, 'id_anak');
    }
}