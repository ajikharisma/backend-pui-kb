<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user', 'nama', 'email', 'no_hp', 'password', 'role'
    ];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_user', 'desc')->first();
            $number = $last ? (int) substr($last->id_user, 3) + 1 : 1;
            $model->id_user = 'USR' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_user', 'id_user');
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'id_user');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_user');
    }
}