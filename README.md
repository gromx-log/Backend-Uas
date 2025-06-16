# Backend UAS - Kelompok 8

Repositori ini berisi backend API untuk proyek UAS yang dibangun menggunakan Laravel Framework.
Proyek ini didasarkan pada sosial media X.com (dahulu Twitter).

## 👥 Tim Pengembang

| Nama | NIM | GitHub |
|------|-----|--------|
| Frederick Andy Junior | 535240010 | [@ToastF](https://github.com/ToastF) |
| Ellen Elvira | 535240023 | [@reishelly](https://github.com/reishelly) |
| Grevano Geraldo | 535240030 | [@Grevano](https://github.com/Grevano) |
| Elvan Mariano | 535240133 | [@Elvan1210](https://github.com/Elvan1210) |
| Filbert Ferdinand | 535240135 | [@gromx-log](https://github.com/gromx-log) |

## 🚀 Teknologi yang Dipakai

- **Framework**: Laravel (PHP)
- **Database**: MySQL/PostgreSQL
- **Server**: Apache/Nginx
- **Dependencies Management**: Composer

## 📋 Prasyarat

Pastikan sistem Anda memiliki:

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Web Server (Apache/Nginx) atau gunakan built-in PHP server

## ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/gromx-log/Backend-Uas.git
cd Backend-Uas
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_anda
DB_PASSWORD=password_anda
```

### 5. Migrasi Database

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder (untuk generate user, post, dan reply.
php artisan db:seed
```

### 6. Jalankan Aplikasi

```bash
# Menjalankan aplikasi
php artisan serve

# Aplikasi akan berjalan di http://localhost:8000
```


## 📝 Dokumentasi API

[https://docs.google.com/document/d/1JbFhlz652ZiHzFemtlgSePGjoHhLA_gVB0nFVeHQfL8/edit?usp=sharing]



Proyek ini dibuat sebagai penilaian akhir semester (UAS).
---

**Catatan**: Pastikan untuk selalu update dependencies dan ikuti best practices dalam pengembangan Laravel.
