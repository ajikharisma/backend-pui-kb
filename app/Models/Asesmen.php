<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asesmen extends Model
{
    protected $table = 'asesmen';

    protected $primaryKey = 'id_asesmen';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [

        'id_asesmen',
        'nama_asesmen',
        'deskripsi'

    ];
}