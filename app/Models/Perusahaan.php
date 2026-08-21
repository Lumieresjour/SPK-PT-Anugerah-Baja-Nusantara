<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';
    protected $primaryKey = 'kode_prs';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'kode_prs',
        'nama_prs',
        'alamat',
        'email',
    ];

    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'kode_prs', 'kode_prs');
    }

    public function kalkulasi()
    {
        return $this->hasMany(Kalkulasi::class, 'kode_prs', 'kode_prs');
    }
}
