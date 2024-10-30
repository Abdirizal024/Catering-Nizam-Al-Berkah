# 🌟 Catering Nizam Al-Berkah 🌟

> Sebuah sistem aplikasi manajemen pesanan catering dengan fitur yang lengkap untuk kemudahan pelanggan dan efisiensi admin!

![Laravel](https://img.shields.io/badge/Laravel-^8.0-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-^7.3-blue?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-^5.7-orange?style=for-the-badge&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-^4.5-purple?style=for-the-badge&logo=bootstrap)

## 🚀 Fitur Utama
- **Manajemen Pesanan**: Pengelolaan pesanan dan transaksi dengan status dan notifikasi yang lengkap.
- **Manajemen Menu**: Tambah, edit, dan hapus menu secara mudah.
- **Laporan dan Statistik**: Analisis penjualan dan performa melalui grafik dan laporan.

## 🔧 Persyaratan
Sebelum memulai, pastikan perangkat Anda telah memenuhi persyaratan berikut:
- **PHP** >= 7.3
- **Composer** >= 2.0
- **MySQL** >= 5.7
- **Node.js** >= 12.x dan **npm** >= 6.x
- **Git** (opsional)

## 📦 Instalasi Langkah-demi-Langkah

### 1. Clone Repository
Clone repository ini ke dalam komputer Anda:

```bash
git clone https://github.com/Abdirizal024/Catering-Nizam-Al-Berkah.git
cd Catering-Nizam-Al-Berkah
composer install
cp .env.example .env
php artisan key:generate
bash
php artisan migrate --seed


Buat database baru di MySQL, contohnya catering_db.
Konfigurasikan database pada file .env seperti berikut:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_catering_nizam
DB_USERNAME=root
DB_PASSWORD=your_password

Jalankan server Laravel di alamat http://127.0.0.1:8000:
php artisan serve

🖼️ Screenshots

Admin Dashboard	Halaman Pesanan

🔐 User dan Admin Default
Setelah proses seeding, gunakan akun default berikut untuk login:

Ussername : admin
Password : admin

📚 Panduan Deployment
Untuk deployment ke server produksi, pastikan untuk:

Set konfigurasi .env dengan benar.
Jalankan composer install --optimize-autoloader --no-dev.
Jalankan php artisan config:cache && php artisan route:cache.
Jalankan php artisan migrate --force untuk update database.

🤝 Kontribusi
Kami terbuka untuk kontribusi! Silakan fork repository ini dan buat pull request.

📝 Lisensi
Proyek ini menggunakan MIT License.


💡 Tips: Pastikan selalu memperbarui dependensi dengan composer update dan npm update.


