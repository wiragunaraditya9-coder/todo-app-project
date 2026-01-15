# Aplikasi Todo List - Back-End Web Development

## 📋 Deskripsi Singkat
Aplikasi web Todo List adalah aplikasi manajemen tugas sederhana yang memungkinkan pengguna mengelola daftar tugas pribadi secara terorganisir. Pengguna dapat melakukan registrasi dan login untuk mengakses fitur CRUD (Create, Read, Update, Delete) pada task. Aplikasi ini dilengkapi dengan sistem autentikasi dan manajemen sesi untuk menjaga keamanan data pengguna, serta dikembangkan sebagai penerapan dasar Back-End Web Development menggunakan PHP Native dan MySQL.

## 👥 Daftar Anggota
| Nama | NIM | Username GitHub | Peran/Tugas |
|------|-----|-----------------|-------------|
| Raditya | [240030084] | [wiragunaraditya9-coder] | BackEnd Developer |
| GusAlit | [240030093] | [gusalit054-eng] | index.php, header.php, dan footer.php merupakan bagian utama tampilan aplikasi, di mana index.php menampilkan halaman utama, mengecek session login, dan mengarahkan pengguna ke dashboard serta menyediakan navigasi login dan register, header.php berfungsi sebagai template atas yang memuat Bootstrap 5, Bootstrap Icons, serta pengaturan layout dan style global, sedangkan footer.php menjadi template bawah yang memuat JavaScript Bootstrap dan fitur auto close notifikasi.  |
| Dewa | [240030099] | [dwastriaa-boop] | Deployment & Testing bertugas menyiapkan lingkungan aplikasi, melakukan konfigurasi server dan database, serta menguji seluruh fitur aplikasi termasuk autentikasi, CRUD task, dan keamanan dasar untuk memastikan aplikasi berjalan dengan baik. |

## 🛠 Lingkungan Pengembangan
### Server
* XAMPP (Apache, PHP 8.2, MySQL)
### Database
* MySQL
### Bahasa Pemrograman (Backend)
* PHP Native
### Bahasa Pemrograman (Frontend)
* HTML
* CSS
* JavaScript
* Bootstrap 5
### Tools & Development Environment
* Visual Studio Code - Code editor
* phpMyAdmin - Database management tool
* Git & GitHub - Version control system
* Google Chrome DevTools - Browser debugging   

## 🚀 Fitur Utama
### Authentication System
- Registrasi akun pengguna
- Login dan logout
- Password hashing menggunakan `password_hash()`
- Manajemen session dengan batas waktu 30 menit

### Task Management (CRUD)
- Create: Menambahkan task baru
- Read: Menampilkan daftar task milik pengguna
- Update: Mengedit task dan status (pending / completed)
- Delete: Menghapus task

### Session Management
- Session timeout 30 menit
- Secure session handling

## 📁 Struktur Folder

```text
todo-app/
├── auth/
│   ├── login.php        # Halaman login pengguna
│   ├── register.php     # Halaman registrasi pengguna
│   └── logout.php       # Proses logout
│
├── config/
│   └── database.php     # Konfigurasi koneksi database
│
├── includes/
│   ├── header.php       # Template header & navbar
│   ├── footer.php       # Template footer & JavaScript
│   └── auth-check.php   # Pengecekan session login
│
├── tasks/
│   ├── add-task.php     # Menambahkan task baru
│   ├── edit-task.php    # Mengedit task
│   ├── delete-task.php  # Menghapus task
│   └── tasks.php        # Menampilkan daftar task
│
├── index.php            # Halaman utama / landing page
├── dashboard.php        # Halaman utama setelah login
└── README.md            # Dokumentasi project

```


## 🗃️ Database Schema
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    status ENUM('pending', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## 🗃️ Database Schema
Database terdiri dari dua tabel utama yaitu `users` dan `tasks`, yang saling terhubung menggunakan relasi foreign key untuk memastikan setiap task dimiliki oleh satu user.

## 📦 Cara Instalasi dan Menjalankan Aplikasi
1. Install dan jalankan XAMPP

2. Letakkan folder project di dalam `htdocs`

3. Buat database `todo_app` melalui phpMyAdmin

4. Jalankan query SQL untuk membuat tabel

5. Akses aplikasi melalui browser di http://localhost/todo-app

## 🔒 Keamanan
- Password disimpan menggunakan hashing

- Prepared statements untuk mencegah SQL Injection

- `htmlspecialchars()` untuk mencegah XSS

- Session timeout 30 menit

## 📊 Testing
- Manual testing semua fitur CRUD

- Security testing (SQL injection, XSS)

- User flow testing