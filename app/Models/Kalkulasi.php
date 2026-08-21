<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kalkulasi extends Model
{
    use HasFactory;

    protected $table = 'kalkulasi';
    protected $primaryKey = 'id_hasil';
    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'kode_prs',
        'skor_akhir',
        'ranking',
        'tanggal_hitung',
    ];

    protected $casts = [
        'skor_akhir' => 'decimal:4',
        'tanggal_hitung' => 'datetime',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'kode_prs', 'kode_prs');
    }
    public function admin()
    {
        return this->belongsTo(Admin::class, 'id_admin');
    }
}
