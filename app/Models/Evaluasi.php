<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluasi extends Model
{
    use HasFactory;

    protected $table = 'evaluasi';
    protected $primaryKey = 'id_evaluasi';
    public $timestamps = true;

    protected $fillable = [
        'kode_prs',
        'kode_kriteria',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'kode_prs', 'kode_prs');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kode_kriteria', 'kode_kriteria');
    }
}
