<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAnalisis extends Model
{
    protected $table = 'hasil_analisis';
    protected $primaryKey = 'id_hasil';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_hasil',
        'id_anak',
        'id_rpph',
        'id_aspek',
        'nilai_dominan',
        'status_perkembangan',
        'jumlah_bb',
        'jumlah_mb',
        'jumlah_bsh',
        'jumlah_bsb',
        'total_penilaian',
        'confidence',
        'indikator_lemah',
        'rekomendasi_ai',    // ← pastikan ada
        'ai_generated',      // ← pastikan ada
        'ai_generated_at',   // ← pastikan ada
        'periode',
        'tanggal_analisis',
    ];

    protected $casts = [
        'indikator_lemah' => 'array', // otomatis decode JSON
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak', 'id_anak');
    }

    public function rpph()
    {
        return $this->belongsTo(Rpph::class, 'id_rpph', 'id_rpph');
    }

    public function aspek()
    {
        return $this->belongsTo(AspekPerkembangan::class, 'id_aspek', 'id_aspek');
    }
}