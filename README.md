# ReminderOS — Smart Reminder App

**Mata Kuliah:** [isi nama mata kuliah]  
**Dosen Pengampu:** [isi nama dosen]  
**Semester:** [isi semester]  

---

## Identitas Mahasiswa

| | |
|---|---|
| **KELOMPOK** | [C] |
| **NAMA KELOMPOK** | [AZRIL,RAFAEL,ARYA  ] |
| **Kelas** | [XI PPLG] |
| **Program Studi** | [PROJECT AKHIR PERIODE MAGANG] |

---

## Deskripsi Aplikasi

ReminderOS adalah aplikasi web manajemen pengingat berbasis Laravel. Pengguna dapat membuat, mengelola, dan memantau jadwal kegiatan dengan fitur notifikasi otomatis ketika pengingat hampir jatuh tempo atau sudah terlewat.

---

## Fitur Utama

- Register & Login menggunakan Laravel Breeze
- Tambah pengingat dengan judul, catatan, durasi waktu, dan tingkat kepentingan
- Filter pengingat: Semua, Akan Datang, Selesai, dan Terlewat
- Filter berdasarkan prioritas: Tidak Penting, Penting, Sangat Penting
- Tandai pengingat selesai / belum selesai
- Hapus pengingat
- Notifikasi alert otomatis di dashboard
- Progress bar penyelesaian
- Jam real-time di navbar

---

## Teknologi yang Digunakan

- **Framework:** Laravel 13
- **Autentikasi:** Laravel Breeze
- **Frontend:** Blade Template, CSS, Vite
- **Database:** MySQL
- **Library:** Carbon

---

## Cara Menjalankan Aplikasi

### Persyaratan
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL (Laragon / XAMPP)

### Langkah-langkah

**1. Install dependency**
```bash
composer install
npm install
```

**2. Salin file environment**
```bash
cp .env.example .env
php artisan key:generate
```

**3. Konfigurasi database di file `.env`**
```env
DB_DATABASE=smart_reminder
DB_USERNAME=root
DB_PASSWORD=
```

**4. Jalankan migrasi**
```bash
php artisan migrate
```

**5. Build asset & jalankan server**
```bash
npm run dev
php artisan serve
```

**6. Buka di browser**
```
http://localhost:8000
```

**7. Daftar akun baru** melalui halaman `/register`, lalu login.

---

## Struktur Database

### Tabel `jadwal`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke tabel users |
| judul_kegiatan | varchar | Judul pengingat |
| catatan | text | Catatan tambahan |
| waktu | integer | Angka durasi |
| satuan_waktu | varchar | menit / jam / hari |
| tingkat_kepentingan | enum | tidak penting / penting / sangat penting |
| status | enum | akan datang / selesai |
| due_date | datetime | Waktu jatuh tempo |
| created_at | timestamp | Waktu dibuat |

---

## Tampilan Aplikasi

| Halaman | Keterangan |
|---|---|
| `/login` | Halaman masuk akun |
| `/register` | Halaman daftar akun baru |
| `/dashboard` | Halaman utama pengingat |
| `/dashboard?tab=upcoming` | Filter pengingat akan datang |
| `/dashboard?tab=selesai` | Filter pengingat selesai |
| `/dashboard?tab=terlewat` | Filter pengingat terlewat |