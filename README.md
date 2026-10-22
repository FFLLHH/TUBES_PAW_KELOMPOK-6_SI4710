# TJ Mart — Aplikasi E-Commerce

TJ Mart adalah aplikasi e-commerce berbasis web yang dibangun dengan **Laravel 9**, dibuat untuk memenuhi Tugas Besar mata kuliah Pemrograman Aplikasi Web (PAW). Aplikasi ini menyediakan toko online lengkap dengan panel admin, halaman pelanggan (katalog, keranjang, checkout), sistem pesanan & pengiriman, serta akun kurir.

## Fitur

**Halaman Pelanggan**
- Katalog produk, pencarian produk, dan kategori
- Detail produk, keranjang belanja (tambah, ubah jumlah, hapus)
- Checkout dan riwayat/pelacakan pesanan
- Halaman tentang toko

**Panel Admin**
- Manajemen produk (CRUD + gambar produk)
- Manajemen kategori dan data toko
- Manajemen pesanan (order) dan pengiriman (shipping)
- Manajemen pengguna

**Lainnya**
- Autentikasi (login, registrasi, logout) dengan 3 role: `admin`, `customer`, `kurir`
- Middleware proteksi halaman admin berdasarkan role
- API controller untuk produk, kategori, pesanan, dan user

## Persyaratan

| Perangkat Lunak | Versi |
|-----------------|-------|
| PHP | 8.2 – 8.3 (disarankan), 8.4 (jalan, dengan warning deprecated) |
| Composer | 2.x |
| Node.js & npm | Node 16+ |
| MySQL | 5.7+ / 8.x |
| Web server | PHP built-in (`php artisan serve`) atau Laragon/XAMPP |

> **Catatan:** proyek ini menggunakan Laravel 9. PHP 8.4 bisa dipakai, tetapi akan menampilkan banyak warning `Deprecated` di layar. Gunakan PHP 8.2/8.3 untuk pengalaman terbaik.

## Cara Menjalankan (Setup)

### 1. Clone repositori

```bash
git clone https://github.com/FFLLHH/TUBES_PAW_KELOMPOK-6_SI4710.git
cd TUBES_PAW_KELOMPOK-6_SI4710
```

### 2. Install dependency PHP

```bash
composer install
```

### 3. Install dependency JavaScript

```bash
npm install
```

> `npm install` sudah meng-handle semua dependency frontend termasuk versi webpack yang kompatibel (sudah dipin di `package.json`).

### 4. Buat file konfigurasi

```bash
copy .env.example .env        # Windows
cp .env.example .env          # Linux/Mac
php artisan key:generate
```

### 5. Buat database

Buat database kosong bernama `tjmart` di MySQL:

```sql
CREATE DATABASE tjmart;
```

Atau lewat phpMyAdmin / HeidiSQL. Default kredensial di `.env` mengasumsikan user `root` tanpa password (default Laragon/XAMPP) — sesuaikan `DB_USERNAME` / `DB_PASSWORD` bila berbeda.

### 6. Migrasi & seed database

```bash
php artisan migrate --seed
```

Perintah ini membuat semua tabel sekaligus mengisi data awal: akun admin, customer, kurir, dan data toko TJ Mart. Kategori dan produk belum termasuk — silakan ditambahkan lewat panel admin setelah login.

### 7. Compile aset frontend

```bash
npm run dev
```

### 8. Jalankan server

```bash
php artisan serve
```

Buka **http://127.0.0.1:8000** di browser — kamu akan diarahkan ke halaman login.

## Akun Default (Hasil Seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@gmail.com` | `12345678` |
| Customer | `pengguna@gmail.com` | `12345678` |
| Kurir 1 | `kurir1@example.com` | `password` |
| Kurir 2 | `kurir2@example.com` | `password` |
| Kurir 3 | `kurir3@example.com` | `password` |

> Password akun kurir memang berbeda dari admin/customer. Bisa diubah di `database/seeders/DatabaseSeeder.php`.

## Struktur Ringkas

```
app/
├── Http/Controllers/
│   ├── Admin/      → Controller panel admin (produk, kategori, order, dll.)
│   ├── Api/        → Controller API
│   ├── Auth/       → Login, register, logout
│   ├── Client/     → Halaman pelanggan (katalog, keranjang, checkout)
│   └── ShippingController.php
├── Middleware/AdminMiddleware.php  → Proteksi role admin
database/
├── migrations/     → Skema tabel (users, shops, products, orders, ...)
└── seeders/        → Data awal
public/
├── assets/         → CSS/JS template (Mazer, Bootstrap, SweetAlert2)
└── shop/           → Logo toko & gambar produk
resources/
├── views/          → Blade templates (admin/, client/, auth/)
└── sass/           → Sumber SCSS
routes/web.php      → Definisi seluruh route
```

## Tech Stack

- **Backend:** Laravel 9, PHP 8.2+
- **Frontend:** Blade, Bootstrap 5 (template Mazer), Laravel Mix, Sass
- **Database:** MySQL
- **Autentikasi:** Laravel UI (session-based)

## Catatan Pengembangan

- Gambar logo & produk tersimpan di `public/shop/` — pastikan folder ini ikut ter-commit agar aset tampil.
- Untuk produksi, compile aset dengan `npm run prod`.
- Jika kamu menjalankan beberapa project Laravel sekaligus, jalankan dengan port berbeda (mis. `php artisan serve --port=8001`) untuk menghindari konflik.

## Anggota Kelompok

Tugas Besar PAW — Kelompok 6 — SI4710

---

Dibuat untuk tujuan edukasi.
