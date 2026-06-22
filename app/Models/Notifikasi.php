<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notif';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_notif',
        'id_user',
        'id_anak',
        'judul',
        'jenis',
        'pesan',
        'status_baca',
        'tanggal',
    ];

    public $timestamps = true;   // ← aktifkan, karena tabel sudah punya created_at/updated_at

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last   = self::orderBy('id_notif', 'desc')->first();
            $number = $last ? (int) substr($last->id_notif, 3) + 1 : 1;
            $model->id_notif = 'NTF' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }
}