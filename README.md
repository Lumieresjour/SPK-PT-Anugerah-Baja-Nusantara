# 📊 Sistem Pendukung Keputusan Pemilihan Supplier Bahan Baku Baja (Metode SAW)

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

Aplikasi **Sistem Pendukung Keputusan (SPK)** berbasis web untuk menentukan dan merekomendasikan supplier bahan baku baja terbaik pada **PT Anugerah Baja Nusantara** menggunakan metode **Simple Additive Weighting (SAW)**.

---

## 📌 Ringkasan Proyek

Proses pemilihan supplier bahan baku yang sebelumnya dilakukan secara manual dan subjektif seringkali memakan waktu serta berpotensi menimbulkan bias. Proyek ini mendigitalisasi dan mengotomasi proses penilaian multi-kriteria secara objektif, transparan, dan terukur berdasarkan bobot preferensi yang telah ditentukan perusahaan.

---

## ✨ Fitur Utama

- 🔐 **Autentikasi Pengguna**: Login & Logout yang aman untuk manajemen / admin pengadaan.
- 📊 **Dashboard Interaktif**: Ringkasan data master (Perusahaan, Kriteria, Klasifikasi, Evaluasi).
- 🏢 **Manajemen Data Supplier**: CRUD (Create, Read, Update, Delete) profil dan informasi supplier.
- ⚙️ **Manajemen Kriteria & Klasifikasi**: Penentuan kriteria penilaian (Benefit/Cost), bobot preferensi ($W_j$), serta konversi nilai kualitatif.
- 📝 **Evaluasi Terintegrasi**: Penginputan nilai evaluasi supplier terhadap seluruh parameter kriteria secara batch/terpadu.
- 🧮 **Kalkulasi SAW Otomatis**: Normalisasi matriks keputusan dan kalkulasi nilai preferensi ($V_i$) secara *real-time*.
- 📄 **Export Laporan PDF**: Unduh hasil perankingan dan detail kalkulasi ke dalam format PDF resmi menggunakan DomPDF.

---

## 📐 Kriteria & Metode Penilaian (SAW)

Sistem menggunakan 4 kriteria utama dalam evaluasi pemasok baja:

| Kode | Kriteria Penilaian | Sifat Atribut | Bobot ($W_j$) |
| :--- | :--- | :---: | :---: |
| **C1** | Sertifikat Kelayakan / Mutu | **Benefit** | 50% (0.50) |
| **C2** | Harga Penawaran | **Cost** | 20% (0.20) |
| **C3** | Waktu Pengiriman (Lead Time) | **Cost** | 20% (0.20) |
| **C4** | Kapasitas Produksi | **Benefit** | 10% (0.10) |

### Rumus Perhitungan:
1. **Normalisasi Matriks ($r_{ij}$)**:
   - Kriteria Benefit: $r_{ij} = \frac{x_{ij}}{\max(x_{ij})}$
   - Kriteria Cost: $r_{ij} = \frac{\min(x_{ij})}{x_{ij}}$
2. **Nilai Preferensi ($V_i$)**:
   - $V_i = \sum_{j=1}^{n} w_j \cdot r_{ij}$

---

## 🛠️ Tech Stack

- **Framework Backend**: Laravel (PHP)
- **Frontend**: Blade Template, Bootstrap, HTML5, CSS3, JavaScript
- **Database**: MySQL / MariaDB
- **Reporting Library**: DomPDF
- **Local Server**: XAMPP / Apache

---

## 🚀 Panduan Instalasi & Menjalankan Sistem

### 1. Prasyarat Sistem
- PHP >= 8.1
- Composer
- MySQL Server (XAMPP/Laragon)
- Web Browser

### 2. Langkah Instalasi

```bash
# 1. Clone repositori ini
git clone [https://github.com/username-kamu/spk-supplier-saw.git](https://github.com/username-kamu/spk-supplier-saw.git)

# 2. Masuk ke direktori proyek
cd spk-supplier-saw

# 3. Install dependency composer
composer install

# 4. Salin file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate
