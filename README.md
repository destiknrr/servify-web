# 💻 Servify — Aplikasi Booking Service Laptop

Servify adalah aplikasi berbasis web yang dirancang untuk mempermudah proses **booking service laptop** secara online.  
Melalui aplikasi ini, pengguna dapat mengajukan permintaan servis, mengisi detail kerusakan, menentukan jadwal kunjungan, dan memantau status service secara real-time.

---

## 🚀 Fitur Utama

### 🏠 Halaman Utama
- Tampilan awal berisi tombol **"Ajukan"** dan **"Jadwal"** untuk memulai proses booking.
- Desain clean dan responsif sesuai dengan prototype.

### 🧾 Form Booking
- Pengguna dapat memilih jadwal kunjungan service.
- Formulir pengisian **kerusakan laptop** dan **data pelanggan** secara lengkap.
- Ringkasan data ditampilkan sebelum pengajuan final (konfirmasi).

### 🔧 Status Service
- Menampilkan status servis laptop setelah pengajuan berhasil.
- Pengguna dapat memantau progres perbaikan dengan mudah.

---

## 🧰 Tech Stack

| Layer | Technology |
|-------|-------------|
| **Frontend** | HTML5, CSS3, Bootstrap 5 |
| **Backend** | PHP (Native, tanpa framework) |
| **Database** | MySQL |
| **Server** | Apache (XAMPP / Laragon / MAMP) |

---

## 🎨 Desain & Responsivitas

- Desain antarmuka mengikuti prototype yang telah disediakan.  
- Warna, ikon, dan layout menyesuaikan dengan skema warna pada prototype.  
- Menggunakan **Bootstrap 5** agar tampil optimal di berbagai ukuran layar (desktop, tablet, mobile).

---

## 📂 Struktur Direktori
servify/
├── index.php # Halaman utama
├── booking/
│ ├── form_jadwal.php # Pemilihan jadwal kunjungan
│ ├── form_kerusakan.php # Form input kerusakan laptop
│ ├── form_pelanggan.php # Form data pelanggan
│ └── ringkasan.php # Ringkasan & konfirmasi booking
├── status/
│ └── status_service.php # Tampilan status service laptop
├── assets/
│ ├── css/
│ │ └── style.css # Styling utama
│ ├── js/
│ │ └── main.js # Script interaktif
│ └── img/
│ └── ... # Gambar dan ikon
├── config/
│ └── database.php # Koneksi ke MySQL