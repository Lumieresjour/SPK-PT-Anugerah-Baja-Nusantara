<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $primaryKey = 'kode_kriteria';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'jenis',
    ];

    protected $casts = [
        'bobot' => 'decimal:2',
    ];

    public function klasifikasi()
    {
        return $this->hasMany(Klasifikasi::class, 'kode_kriteria', 'kode_kriteria');
    }

    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'kode_kriteria', 'kode_kriteria');
    }
}
