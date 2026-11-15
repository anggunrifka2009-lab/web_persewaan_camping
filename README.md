# CampRent – Sistem Informasi Persewaan Alat Camping

---

## Deskripsi

CampRent merupakan aplikasi berbasis web yang dikembangkan untuk memudahkan proses persewaan alat camping secara online. Aplikasi ini menyediakan informasi barang camping, ketersediaan stok, proses penyewaan, pembayaran, hingga pengembalian barang.

CampRent memiliki dua jenis pengguna, yaitu **Admin** dan **Pelanggan**, dengan hak akses dan fitur yang berbeda.

## Fitur Aplikasi

### Admin
- Dashboard admin
- Mengelola data kategori
- Mengelola data barang
- Mengelola data penyewaan
- Konfirmasi pembayaran
- Mengelola pengembalian barang
- Mengelola laporan penyewaan
- Mengelola akun pengguna

### Pelanggan (User)
- Registrasi dan login
- Melihat daftar barang camping
- Melihat detail barang
- Melakukan penyewaan barang
- Melihat status penyewaan
- Melihat riwayat penyewaan
- Melihat informasi akun

## Teknologi yang Digunakan

| Teknologi | Keterangan |
|---|---|
| Laravel | Framework backend |
| PHP | Bahasa pemrograman |
| MySQL | Database |
| HTML | Struktur halaman |
| CSS | Styling tampilan |
| JavaScript | Interaksi halaman |

## Akses Website

Website CampRent dapat diakses melalui tautan berikut:

**https://camprent.web.id**

## Screenshot Aplikasi

## Screenshot Aplikasi

### Halaman Login dan Register

| Halaman | Screenshot |
|---|---|
| Login | <img src="screenshots/login.png" width="400"> |
| Register | <img src="screenshots/register.png" width="400"> |

### 1. Tampilan Pelanggan (User)

| Halaman | Screenshot |
|---|---|
| Beranda | <img src="screenshots/user-beranda.png" width="400"> |
| Daftar Barang | <img src="screenshots/user-barang.png" width="400"> |
| Detail Barang | <img src="screenshots/user-detail-barang.png" width="400"> |
| Penyewaan | <img src="screenshots/user-penyewaan.png" width="400"> |
| Riwayat Penyewaan | <img src="screenshots/user-riwayat.png" width="400"> |
| Informasi Akun | <img src="screenshots/user-akun.png" width="400"> |

### 2. Tampilan Admin

| Halaman | Screenshot |
|---|---|
| Dashboard Admin | <img src="screenshots/admin-dashboard.png" width="400"> |
| Kelola Kategori | <img src="screenshots/admin-kategori.png" width="400"> |
| Kelola Barang | <img src="screenshots/admin-barang.png" width="400"> |
| Data Penyewaan | <img src="screenshots/admin-penyewaan.png" width="400"> |
| Kelola Akun | <img src="screenshots/admin-user.png" width="400"> |
| Laporan Penyewaan | <img src="screenshots/admin-laporan.png" width="400"> |
| Informasi Akun | <img src="screenshots/admin-akun.png" width="400"> |

## Entity Relationship Diagram (ERD)

ERD berikut menggambarkan hubungan antar tabel dalam database CampRent.

![ERD CampRent](screenshots/erd.png)

## Instalasi dan Menjalankan Project

### Persyaratan
- PHP
- Composer
- MySQL
- Node.js dan NPM
- Git

### Langkah Instalasi

**1. Clone repository**

```bash
git clone https://github.com/anggunrifka2009-lab/web_persewaan_camping.git
```

**2. Masuk ke direktori project**

```bash
cd web_persewaan_camping
```

**3. Install dependency Laravel**

```bash
composer install
```

**4. Install dependency frontend**

```bash
npm install
```

**5. Salin file environment**

```bash
cp .env.example .env
```

**6. Generate application key**

```bash
php artisan key:generate
```

**7. Buat database MySQL**

Buat database dengan nama `persewaan_camping`, kemudian sesuaikan konfigurasi pada file `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=persewaan_camping
DB_USERNAME=root
DB_PASSWORD=
```

**8. Jalankan migrasi database**

```bash
php artisan migrate
```

Jika tersedia seeder:

```bash
php artisan db:seed
```

**9. Hubungkan storage**

```bash
php artisan storage:link
```

**10. Jalankan aplikasi**

Terminal pertama:

```bash
npm run dev
```

Terminal kedua:

```bash
php artisan serve
```

Buka browser melalui:

```text
http://127.0.0.1:8000
```

## Akun Demo

Gunakan akun berikut untuk mencoba aplikasi.

| Role | Email | Password |
|---|---|---|
| Admin | admin@sewa.com | 12345678 |
| Pelanggan | rifka@sewa.com | 12345678 |

---

<p align="center">
  © 2026 CampRent. All Rights Reserved.
</p>