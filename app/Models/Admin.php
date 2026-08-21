<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'email',
    ];

    protected $hidden = [
        'password',
    ];

    public function kalkulasi()
    {
        return this->hasMany(Kalkulasi::class, 'id_kalkulasi');
    }
}
