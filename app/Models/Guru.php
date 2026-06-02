<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_guru', 'id_user', 'foto', 'alamat', 'tanggal_lahir', 'jenis_kelamin','kelompok'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_guru', 'desc')->first();
            $number = $last ? (int) substr($last->id_guru, 3) + 1 : 1;
            $model->id_guru = 'GRU' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_guru');
    }
}