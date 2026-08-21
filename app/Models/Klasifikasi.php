<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Klasifikasi extends Model
{
    use HasFactory;

    protected $table = 'klasifikasi';
    protected $primaryKey = 'kode_klasifikasi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'kode_klasifikasi',
        'kode_kriteria',
        'nama_klasifikasi',
        'nilai',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kode_kriteria', 'kode_kriteria');
    }
}
