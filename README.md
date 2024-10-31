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
- **PHP** >= 8.2
- **Composer** >= 2.0
- **MySQL** >= 5.7
- **Git** (opsional)

## 📦 Instalasi Langkah-demi-Langkah

### 1. Clone Repository
Clone repository ini ke dalam komputer Anda:

```bash
git clone https://github.com/Abdirizal024/Catering-Nizam-Al-Berkah.git
```
Extraks folder zip Catering-Nizam-Al-Berkah-main menjadi nama catering
```
cd catering
```
```
composer install
```
```
cp .env.example .env
```
```
php artisan migrate
```
```
php artisan key:generate
```
```
php artisan migrate --seed
```
```
php artisan storage:link
```
Buat database baru di MySQL, contohnya catering_db.
Konfigurasikan database pada file ```.env``` seperti berikut:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=catering_db
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan server Laravel di alamat http://127.0.0.1:8000:
```
php artisan serve
```

🖼️ Screenshots

Admin Dashboard	Halaman Pesanan

🔐 User dan Admin Default
Setelah proses seeding, gunakan akun default berikut untuk login:

```
Username : admin
Password : admin
```

🤝 Kontribusi
Kami terbuka untuk kontribusi! Silakan fork repository ini dan buat pull request.


📝 Lisensi
Proyek ini menggunakan MIT License.


💡 Tips: Pastikan selalu memperbarui dependensi dengan composer update dan npm update.





## 📱 Ikuti Kami di Media Sosial Tetap terhubung dan ikuti perkembangan proyek kami di media sosial :

<div align="center">
  
[![Facebook](https://img.shields.io/badge/Facebook-%231877F2.svg?style=for-the-badge&logo=Facebook&logoColor=white)](https://facebook.com/YourPageName)
[![Twitter](https://img.shields.io/badge/Twitter-%231DA1F2.svg?style=for-the-badge&logo=Twitter&logoColor=white)](https://twitter.com/YourTwitterHandle)
[![Instagram](https://img.shields.io/badge/Instagram-%23E4405F.svg?style=for-the-badge&logo=Instagram&logoColor=white)](https://instagram.com/YourInstagram)
[![LinkedIn](https://img.shields.io/badge/linkedin-%230077B5.svg?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/YourLinkedIn)
[![WhatsApp](https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white)](https://wa.me/YourPhoneNumber)

</div>

### 🌟 Stay Connected!

Follow us and join our community for:

- 🎯 Get exclusive updates and news
- 💡 Share your ideas and feedback
- 🤝 Direct consultation via WhatsApp
- 🎉 Be the first to know about new features

---

<div align="center">
  <sub>Made with ❤️ by Abdi</sub>
</div>
