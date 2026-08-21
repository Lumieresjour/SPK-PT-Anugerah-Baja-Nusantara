- merupakan website Sistem Penunjang Keputusan dengan metode SAW yang berjalan secara localhost dengan xampp sebagai tugas kuliah

- CONTOH design tampilan per fitur ada pada folder design web, karena icon sama dan belum di ubah nanti ubah icon per fiturnya.

- tulisan/isi baris pada tabel di dalam contoh folder design web adalah data dummy alias contoh pada design, tidak usah ditambahkan

Fitur Website:
1. Login dengan username dan password
2. Home utama admin dengan tampilan pada folder design web
3. Laman Perusahan untuk CRUD data perusahaan dengan tabel sesuai pada folder design web
4. Laman Kriteria untuk input CRUD data kriteria dengan tabel sesuai folder design web
5. Laman Klasifikasi untukk input CRUD data berdasarkan kriteria yang dianggap kuallitatif (benefit) oleh admin dengan tabel sesuai design web
6. Laman Evaluasi untuk input CRUD data perusahaan terhadap data kriteria dan data Klasifikasi web dengan tabel sesuai design web
7. Laman Kalkulasi merupakan halaman untuk menghitung data yang sudah diinput sesuai dengan rumus metode SAW
8. Fitur LogOut untuk logout dari web

- ALur Fitur Login
1. Admin Login dengan username dan password
2. Jika gagal dengan username atau password yang salah, maka muncul notif "Username atau password salah, silahkan hubungi tim IT anda"
3. Jika salah satu username atau password ada yang tidak diisi, tulis "ini harus diisi"
3. Jika berhasil masuk ke laman Home Admin.

- Alur Fitur Home
1. Admin mengakses home admin

- Alur Fitur Perusahaan
1. Admin mengakses laman perusahaan
2. Ada tabel jika kosong ada tampilan "belum ada data"
3. Admin dapat CRUD data Perusahaan pada tabel
4. di form edit/tambah data, Jika salah satu isian atau tempat input ada yang tidak diisi, tulis "ini harus diisi"
5. di form edit/tambah data ada konfirmasi jika sudah selesai edit/tambah data
6. saat hapus ada notif "hapus data?"

- Alur Fitur Kriteria
1. Admin mengakses laman kriteria
2. Ada tabel jika kosong ada tampilan "belum ada data"
3. Admin dapat CRUD data Kriteria pada tabel
4. di form edit/tambah data, Jika salah satu isian atau tempat input ada yang tidak diisi, tulis "ini harus diisi"
5. di form edit/tambah data ada konfirmasi jika sudah selesai edit/tambah data
6. saat hapus ada notif "hapus data?"

- Alur Fitur Klasifikasi
1. Admin mengakses laman Klasifikasi
2. Ada tabel jika kosong ada tampilan "belum ada data"
3. Admin dapat CRUD data Klaifikasi terhadap kriteria yang dianggap admin kualitatif (benefit) oleh admin pada tabel
4. di form edit/tambah data, Jika salah satu isian atau tempat input ada yang tidak diisi, tulis "ini harus diisi"
5. di form edit/tambah data ada konfirmasi jika sudah selesai edit/tambah data
6. saat hapus ada notif "hapus data?"

- Alur Fitur Evaluasi
1. Admin mengakses laman Evaluasi
2. Ada tabel jika kosong ada tampilan "belum ada data"
3. Admin dapat CRUD data Evaluasi berdasarkan perusahaan terhadap kriteria dan klasifikasi pada tabel
4. di form edit/tambah data, Jika salah satu isian atau tempat input ada yang tidak diisi, tulis "ini harus diisi"
5. di form edit/tambah data ada konfirmasi jika sudah selesai edit/tambah data
6. saat hapus ada notif "hapus data?"

- Alur Fitur Kalkulasi
1. Admin mengakses laman Evaluasi
2. Ada tabel jika kosong ada tampilan "belum ada data, silahkan tambah data pada laman Perusahaan, Kriteria dan Evaluasi"
3. Jika ada sistem akan otomatis menghitung dengan rumus Metode Saw terhadap data yang ada.
4. ada fitur tombol PDF untuk print data pdf pada tabel hasil rank

- Alur Fitur Logout
1. admin dapat logout dengan klik icon logout
2. ada notif "Ingin log-out" sebagai konfirmasi


- Struktur Database dengan PhpMyadmin
1. Admin
    id_admin (PK,int,auto_increment)
    username (varchar(50), unique, not null)
    password (varchar(255), not null)
    nama_lengkap (varchar(100))
    email (varchar(100))
    created_at (timestamp, default current_timestamp)
2. Perusahaan
    kode_prs (PK, varchar(10))
    nama_prs (varchar(100), not null)
    alamat(text)
    email(varchar(100))
    created_at (timestamp, default current_timestamp)
3. Kriteria
    kode_kriteria (PK, varchar(10))
    nama_kriteria (varchar(100), not null)
    bobot (decimal(3,2), not null)
    jenis (enum("cost","benefit"), not null)
    created_at (timestamp, default current_timestamp)
4. Klasifikasi
    kode_klasifikasi (PK,varchar(10))
    kode_kriteria (FK, varchar(10),not null)
    nama_klasifikasi (varchar(100), nt null)
    nilai (int, not null)
    created_at (timestamp, default current_timestamp)
    foreign key (kode_kriteria) references kriteria(kode_kriteria) on delete cascade
5. Evaluasi
    id_evaluasi (PK, int, auto increment)
    kode_prs(FK, varchar(10), not null)
    kode_kriteria (FK, varchar(10),not null)
    nilai (decimal(10,2), not null)
    created_at (timestamp, default current_timestamp)
    unique key (kode_prs, kode_kriteria)
    foreign key (kode_prs) references perusahaan (kode_prs) on delete cascade
    foreign key (kode_kriteria) references kriteria (kode_kriteria) on delete cascade
6. Kalkulasi
    id_hasil (PK, int, auto_increment)
    kode_prs (FK,varchar(10), not null)
    skor_akhir (decimal(5,4), not null,)
    ranking (int)
    tanggal hitung (timestamp, default current_timestamp)
    foreign key (kode_prs) references perusahaan (kode_prs) on delete cascade

- Relasi Tabel
Krteria (1) -> (N) Klasifikasi
Perusahaan (1) -> (N) Evaluasi
Kriteria (1) -> (N) Evaluasi
Perusahaan (1) -> (N) Kalkulasi

- Alur perhitungan 
Evaluasi + Kriteria -> Normalisasi * Bobot -> Kalkulasi

- Normalisasi (di PHP/Backend)
untuk setiap kriteria, cari max(benefit) atau min(cost)
hitung nilai ternomalisasi pakai rumus saw

- Kalikan dengan bobot dan jumlahkan
Perusahaan:SUM(nilai_ternomalisasi * bobot)

- Simpan hasil ke Kalkulasi


- catatan design web pada folder design web
nanti ubah icon sesuai nama laman yang sesuai dengan style awal
di beberapa form pada fitur ada input berupa dropdown dengan style segitiga kebalik


- catatan log kamu
nanti kalau kamu selesai, kamu tulis di laporan.md. apa saja dan dimana saja yang kamu tambahkan serta pakai apa saja.