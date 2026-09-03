<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        $perusahaan = [
            [
                'kode_prs' => 'PRS001',
                'nama_prs' => 'PT Krakatau Baja Persada',
                'alamat' => 'Jl. Industri Raya No. 18, Cilegon, Banten',
                'email' => 'pengadaan@krakataubajapersada.co.id',
            ],
            [
                'kode_prs' => 'PRS002',
                'nama_prs' => 'PT Sinar Logam Nusantara',
                'alamat' => 'Jl. Raya Bekasi Km. 27, Cikarang, Jawa Barat',
                'email' => 'procurement@sinarlogamnusantara.co.id',
            ],
            [
                'kode_prs' => 'PRS003',
                'nama_prs' => 'PT Mitra Baja Sejahtera',
                'alamat' => 'Jl. Margomulyo Industri No. 7, Surabaya, Jawa Timur',
                'email' => 'sales@mitrabajasejahtera.co.id',
            ],
            [
                'kode_prs' => 'PRS004',
                'nama_prs' => 'PT Indo Metalindo Abadi',
                'alamat' => 'Jl. Gatot Subroto No. 45, Medan, Sumatera Utara',
                'email' => 'vendor@indometalindoabadi.co.id',
            ],
            [
                'kode_prs' => 'PRS005',
                'nama_prs' => 'PT Cakrawala Steel Mandiri',
                'alamat' => 'Jl. Soekarno Hatta No. 102, Semarang, Jawa Tengah',
                'email' => 'info@cakrawalasteelmandiri.co.id',
            ],
        ];

        foreach ($perusahaan as $data) {
            Perusahaan::updateOrCreate(
                ['kode_prs' => $data['kode_prs']],
                $data
            );
        }
    }
}
