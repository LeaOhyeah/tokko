
---

# 🛍️ Toko Online dengan Pencarian Semantik & Rekomendasi AI
Proyek ini adalah implementasi toko online yang memanfaatkan **Pencarian Semantik** dan **Rekomendasi AI** untuk meningkatkan pengalaman pengguna dalam mencari dan menemukan produk. Dibangun menggunakan **Laravel 10**, proyek ini berfungsi sebagai antarmuka pengguna yang berinteraksi dengan API Python untuk pemrosesan pencarian semantik.

## 📋 Fitur Utama

- **Pencarian Semantik** Memungkinkan pengguna mencari produk dengan pemahaman makna, bahkan jika terdapat kesalahan ejaan atau sinonim.
- **Rekomendasi AI** (saat ini belum tersedia) Memberikan rekomendasi produk yang relevan berdasarkan preferensi dan perilaku pengguna.
- **Antarmuka Pengguna Responsif** (mendatang saat ini belum tersedia) Desain yang ramah pengguna dan responsif untuk berbagai perangkat.

## 🛠️ Teknologi yang Digunakan

- **Laravel 10**: Framework PHP untuk pengembangan web.
- **PostgreSQL** dengan Ekstensi Vektor*: Basis data relasional yang mendukung pencarian vektor untuk pemrosesan semantik.
- **API Python**: Digunakan untuk pemrosesan pencarian semantik dan rekomendasi.

## 🚀 Instalasi & Penggunaan

### Prasyarat

- **PHP 8.2.x**: Pastikan PHP versi 8.2 atau lebih baru terinstal.
- **Composer**: Pengelola dependensi PHP.
- **PostgreSQL**: Basis data dengan ekstensi vektor terinstal.
- **Python 3.x**: Diperlukan untuk menjalankan API pencarian semantik.
  
Proyek ini terintegrasi dengan **API Python** untuk pencarian semantik dan rekomendasi berbasis AI. Untuk informasi lebih lanjut dan cara menjalankannya, silakan kunjungi repositori berikut:  

🔗 **[API Python – Semantic Search](https://github.com/LeaOhyeah/api-embedding)**  

Anda juga perlu menginstal dan menjalankan API pendukung ini 

### Langkah-langkah Instalasi

1. **Kloning Repository**
   ```bash
   git clone https://github.com/leaohyeah/tokko.git
   cd tokko
   ```

2. **Instal Dependensi Backend**
   ```bash
   composer install
   ```

3. **Salin File Konfigurasi**
   ```bash
   cp .env.example .env
   ```

4. **Atur Konfigurasi Lingkungan**
  - Buka file `.env` dan sesuaikan pengaturan basis data serta konfigurasi lainnya sesuai kebutuhan Anda.

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Basis Data**
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Server Pengembangan**
   ```bash
   php artisan serve
   ```
   Akses aplikasi di `http://localhost:8000`.

8. **Jalankan API Python**
  - Pastikan API Python untuk pencarian semantik berjalan dan dapat diakses oleh aplikasi Laravel.

## 🧪 Pengujan

Saat ini pengujian belum tersedia.

## 📄 Lisnsi

Proyek ini dilisensikan di bawah lisensi **MIT**. Lihat file [LICENSE](LICENSE) untuk informasi lebih lanjut.
---

