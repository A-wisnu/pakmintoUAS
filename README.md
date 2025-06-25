# MemeHub

<p align="center">
  <img src="https://i.pinimg.com/736x/75/3e/31/753e3132cb52e77ee9fa984d63736a74.jpg" alt="Logo MemeHub" width="200" height="auto"/>
</p>

<p align="center">
  <b>Platform sosial modern untuk berbagi dan menemukan meme</b>
</p>

<p align="center">
  <a href="#fitur">Fitur</a> •
  <a href="#instalasi">Instalasi</a> •
  <a href="#penggunaan">Penggunaan</a> •
  <a href="#arsitektur">Arsitektur</a> •
  <a href="#autentikasi">Autentikasi</a> •
  <a href="#database">Skema Database</a> •
  <a href="#kontribusi">Kontribusi</a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Laravel-10.0-red" alt="Laravel 10.0">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-purple" alt="Bootstrap 5.3">
</p>

## 🌟 Fitur <a name="fitur"></a>

MemeHub adalah platform sosial yang kaya fitur untuk berbagi dan menemukan meme dari berbagai sumber:

- **Konten Multi-Sumber**: Unggah meme buatan sendiri atau bagikan dari Instagram dan TikTok
- **Antarmuka Pengguna Interaktif**: Desain modern dan responsif untuk semua perangkat
- **Beberapa Mode Tampilan**:
  - **Tampilan Feed**: Feed tradisional yang dapat di-scroll
  - **Tampilan Reels**: Scrolling vertikal layar penuh yang imersif (mirip dengan TikTok/Instagram Reels)
- **Autentikasi Pengguna**: 
  - Autentikasi email/kata sandi standar
  - Sistem pendaftaran "Kode Rahasia" eksklusif hanya dengan undangan
- **Profil Pengguna**: Profil yang dipersonalisasi dengan riwayat aktivitas dan koleksi meme
- **Interaksi Sosial**: Suka dan lihat konten meme
- **Manajemen Konten**: Buat, edit, dan hapus postingan meme Anda

## 🚀 Instalasi <a name="instalasi"></a>

### Prasyarat

- PHP 8.2+
- Composer
- MySQL/PostgreSQL
- Node.js dan NPM

### Langkah-langkah Pengaturan

1. Kloning repositori:
   ```bash
   git clone https://github.com/username-anda/meme-hub.git
   cd meme-hub
   ```

2. Instal dependensi PHP:
   ```bash
   composer install
   ```

3. Instal dependensi frontend:
   ```bash
   npm install && npm run dev
   ```

4. Buat file lingkungan:
   ```bash
   cp .env.example .env
   ```

5. Generate kunci aplikasi:
   ```bash
   php artisan key:generate
   ```

6. Konfigurasi database Anda di file `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=meme_hub
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Jalankan migrasi database dan seeder:
   ```bash
   php artisan migrate --seed
   ```

8. Hubungkan penyimpanan:
   ```bash
   php artisan storage:link
   ```

9. Mulai server pengembangan:
   ```bash
   php artisan serve
   ```

10. Kunjungi `http://localhost:8000` di browser Anda.

## 💻 Penggunaan <a name="penggunaan"></a>

### Navigasi MemeHub

1. **Halaman Beranda**: Jelajahi meme terbaru dari semua pengguna
2. **Tampilan Feed**: Lihat konten yang disematkan dari sumber eksternal seperti Instagram dan TikTok
3. **Tampilan Reels**: Nikmati meme dalam mode scroll vertikal layar penuh yang imersif
4. **Halaman Profil**: Lihat dan kelola profil Anda dan meme yang telah diposting

### Membuat Meme

1. Klik tombol "Unggah" di bilah navigasi
2. Isi informasi yang diperlukan:
   - Judul untuk meme Anda
   - Pilih jenis konten (gambar atau video)
   - Pilih sumber (unggah file, tautan Instagram, atau tautan TikTok)
3. Pratinjau konten Anda dan kirim
4. Meme Anda akan muncul di feed, reels, dan profil Anda

### Interaksi

- **Suka**: Klik ikon hati untuk mengapresiasi meme
- **Lihat**: Jelajahi meme dalam berbagai mode tampilan
- **Bagikan**: Buat tautan yang dapat dibagikan ke meme apa pun
- **Profil**: Lihat meme yang Anda posting dan informasi akun

## 🏗️ Arsitektur <a name="arsitektur"></a>

MemeHub mengikuti pola arsitektur Model-View-Controller (MVC) menggunakan framework Laravel:

```
meme-hub/
├── app/                     # Kode aplikasi inti
│   ├── Http/
│   │   ├── Controllers/     # Controller MVC
│   │   ├── Middleware/      # Middleware HTTP
│   │   └── Requests/        # Form Requests
│   ├── Models/              # Model Eloquent
│   └── Providers/           # Penyedia Layanan
├── bootstrap/               # File bootstrap framework
├── config/                  # File konfigurasi
├── database/                # Migrasi dan seeder database
├── public/                  # File yang dapat diakses publik
├── resources/               # Tampilan dan aset yang belum dikompilasi
│   ├── js/                  # File JavaScript
│   ├── sass/                # File SASS
│   └── views/               # Template Blade
│       ├── layouts/         # Template layout
│       ├── memes/           # Tampilan terkait meme
│       └── auth/            # Tampilan autentikasi
├── routes/                  # Definisi rute
├── storage/                 # Unggahan, cache, dan log
└── tests/                   # Pengujian otomatis
```

### Alur Proyek

1. Pengguna membuat permintaan ke rute tertentu (mis., `/memes/create`)
2. Rute dipetakan ke aksi controller (mis., `MemeController@create`)
3. Controller memproses permintaan, berinteraksi dengan model, dan mengembalikan tampilan
4. Tampilan merender HTML yang dikirim kembali ke browser pengguna

### Komponen Utama

- **Model**: Mewakili tabel database dan menangani operasi data
- **View**: Template Blade yang merender antarmuka pengguna
- **Controller**: Memproses permintaan pengguna dan mengembalikan respons
- **Route**: Mendefinisikan endpoint URL dan memetakannya ke aksi controller
- **Middleware**: Memproses permintaan sebelum/sesudah mencapai controller

## 🔐 Autentikasi <a name="autentikasi"></a>

MemeHub mengimplementasikan sistem autentikasi ganda:

### Autentikasi Standar

- Pendaftaran/login email dan kata sandi tradisional
- Fungsi reset kata sandi
- Fitur "Ingat saya"
- Manajemen sesi

### Autentikasi Kode Rahasia

Fitur unik yang membuat MemeHub menjadi platform eksklusif:

1. **Kode Rahasia**: Pengguna admin dapat menghasilkan kode undangan dengan penggunaan terbatas
2. **Distribusi Kode**: Kode dibagikan kepada calon pengguna baru
3. **Pendaftaran**: Pengguna baru menggunakan kode ini untuk mendaftarkan akun
4. **Validasi**: Kode hanya dapat digunakan sekali dan kedaluwarsa setelah waktu tertentu

Sistem ini menciptakan atmosfer eksklusif, hanya melalui undangan sambil mengontrol pertumbuhan pengguna.

### Implementasi

Sistem autentikasi diimplementasikan menggunakan:
- Fitur autentikasi bawaan Laravel
- `SecretCodeController` khusus untuk pembuatan dan validasi kode
- Hashing kata sandi yang aman menggunakan bcrypt
- Autentikasi berbasis sesi dengan perlindungan CSRF
- Middleware khusus untuk perlindungan rute

## 📊 Skema Database <a name="database"></a>

MemeHub menggunakan database relasional dengan tabel inti berikut:

### Pengguna (Users)

| Kolom           | Tipe         | Deskripsi                             |
|-----------------|--------------|---------------------------------------|
| id              | bigint       | Kunci utama                           |
| name            | varchar(255) | Nama tampilan pengguna                |
| email           | varchar(255) | Alamat email pengguna (unik)          |
| password        | varchar(255) | Kata sandi terenkripsi                |
| remember_token  | varchar(100) | Token "Ingat saya"                    |
| created_at      | timestamp    | Waktu pembuatan akun                  |
| updated_at      | timestamp    | Waktu pembaruan terakhir akun         |

### Meme

| Kolom           | Tipe         | Deskripsi                             |
|-----------------|--------------|---------------------------------------|
| id              | bigint       | Kunci utama                           |
| user_id         | bigint       | Kunci asing ke tabel pengguna         |
| title           | varchar(255) | Judul meme                            |
| type            | varchar(50)  | Jenis konten (gambar/video)           |
| source          | varchar(50)  | Sumber (unggahan/instagram/tiktok)    |
| content_url     | text         | URL ke konten atau jalur file         |
| views           | integer      | Jumlah tampilan                       |
| likes           | integer      | Jumlah suka                           |
| created_at      | timestamp    | Waktu pembuatan postingan             |
| updated_at      | timestamp    | Waktu pembaruan terakhir postingan    |

### Kode Rahasia (Secret Codes)

| Kolom           | Tipe         | Deskripsi                             |
|-----------------|--------------|---------------------------------------|
| id              | bigint       | Kunci utama                           |
| code            | varchar(255) | Kode rahasia unik                     |
| creator_id      | bigint       | ID pengguna yang menghasilkan kode    |
| user_id         | bigint       | ID pengguna yang menggunakan kode     |
| is_used         | boolean      | Apakah kode telah digunakan           |
| expires_at      | timestamp    | Waktu kedaluwarsa kode                |
| created_at      | timestamp    | Waktu pembuatan kode                  |
| updated_at      | timestamp    | Waktu pembaruan terakhir kode         |

### Profil (Profiles)

| Kolom           | Tipe         | Deskripsi                             |
|-----------------|--------------|---------------------------------------|
| id              | bigint       | Kunci utama                           |
| user_id         | bigint       | Kunci asing ke tabel pengguna         |
| bio             | text         | Biografi pengguna                     |
| avatar          | varchar(255) | Jalur ke gambar avatar                |
| created_at      | timestamp    | Waktu pembuatan profil                |
| updated_at      | timestamp    | Waktu pembaruan terakhir profil       |

### Diagram Hubungan Entitas

```
┌────────────┐       ┌────────────┐       ┌────────────┐
│  Pengguna  │       │    Meme    │       │   Profil   │
├────────────┤       ├────────────┤       ├────────────┤
│ id         │       │ id         │       │ id         │
│ name       │       │ user_id    │──┐    │ user_id    │──┐
│ email      │       │ title      │  │    │ bio        │  │
│ password   │◄──────┤ type       │  └────┤ avatar     │  │
│ created_at │       │ source     │       │ created_at │  │
│ updated_at │       │ content_url│       │ updated_at │  │
└────────────┘       │ views      │       └────────────┘  │
       ▲             │ likes      │                       │
       │             │ created_at │                       │
       │             │ updated_at │                       │
       │             └────────────┘                       │
       │                                                  │
┌──────┴─────┐                                           │
│Kode Rahasia│                                           │
├────────────┤                                           │
│ id         │                                           │
│ code       │                                           │
│ creator_id │◄─────────────────────────────────────────┘
│ user_id    │◄─────────────────────────────────────────┘
│ is_used    │
│ expires_at │
│ created_at │
│ updated_at │
└────────────┘
```

## 👥 Kontribusi <a name="kontribusi"></a>

MemeHub dibuat oleh **Wisnu Hidayat** sebagai bagian dari proyek. Kontribusi sangat disambut! Silakan ikuti langkah-langkah berikut:

1. Fork repositori
2. Buat branch fitur Anda (`git checkout -b fitur/fitur-luar-biasa`)
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur luar biasa'`)
4. Push ke branch (`git push origin fitur/fitur-luar-biasa`)
5. Buka Pull Request

## ✨ Pengembangan Masa Depan

- Fitur komentar untuk meme
- Sistem mengikuti pengguna
- Algoritma meme yang sedang tren
- Fungsionalitas pencarian lanjutan
- Aplikasi mobile untuk iOS dan Android
- Pesan langsung antar pengguna
- Sistem notifikasi
- Alat moderasi konten

---

<p align="center">
  Dibuat oleh Wisnu Hidayat
</p>
