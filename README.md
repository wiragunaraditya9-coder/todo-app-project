
## 📋 Deskripsi Singkat
Aplikasi web Todo List adalah aplikasi manajemen tugas sederhana yang memungkinkan pengguna mengelola daftar tugas pribadi secara terorganisir. Pengguna dapat melakukan registrasi dan login untuk mengakses fitur CRUD (Create, Read, Update, Delete) pada task. Aplikasi ini dilengkapi dengan sistem autentikasi dan manajemen sesi untuk menjaga keamanan data pengguna, serta dikembangkan sebagai penerapan dasar Back-End Web Development menggunakan PHP Native dan MySQL.

## 👥 Daftar Anggota
| Nama | NIM | Username GitHub | Peran/Tugas |
|------|-----|-----------------|-------------|
| Raditya | [240030084] | [wiragunaraditya9-coder] |Backend Developer – Bertanggung jawab atas desain dan implementasi database MySQL (relasi one-to-many), pengembangan sistem autentikasi (register, login, logout), password hashing `(password_hash())`, session management dengan timeout, implementasi CRUD task menggunakan prepared statements, validasi dan sanitasi input untuk mencegah SQL Injection dan XSS, serta pengembangan dashboard dan statistik task.|
| GusAlit | [240030093] | [gusalit054-eng] | Frontend Developer – Mengembangkan tampilan aplikasi melalui `index.php`, `header.php`, dan `footer.php`. `index.php` berfungsi sebagai landing page dengan pengecekan session dan navigasi login/register, `header.php` sebagai template atas yang memuat Bootstrap 5 dan Bootstrap Icons, serta `footer.php` sebagai template bawah yang memuat JavaScript Bootstrap dan fitur auto-close notifikasi. |
| Dewa | [240030099] | [dwastriaa-boop] | Deployment & Testing – bertugas menyiapkan lingkungan aplikasi, melakukan konfigurasi server dan database, serta menguji seluruh fitur aplikasi termasuk autentikasi, CRUD task, dan keamanan dasar untuk memastikan aplikasi berjalan dengan baik. |

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
  
## Hasil Pengembangan 
## 1. Autentikasi Pengguna
- Register: Form pendaftaran pengguna baru dengan validasi username unik, email valid, dan password hashing menggunakan `password_hash()`
- Login: Autentikasi menggunakan username atau email dengan verifikasi password menggunakan `password_verify()`
- Logout: Menghapus semua session data dan redirect ke halaman login dengan pesan konfirmasi
- Session Management: Session timeout otomatis setelah 30 menit tidak aktif dengan validasi $_SESSION['login_time']

## 2. Manajemen Task (CRUD Operations)
- Tambah Task: Form input dengan field judul (required), deskripsi (optional), dan deadline (optional)
- Lihat Tasks: Menampilkan daftar tasks dalam format tabel dengan sorting berdasarkan status (pending first) dan deadline
- Edit Task: Form edit untuk mengubah judul, deskripsi, deadline, dan status task
- Hapus Task: Konfirmasi delete dengan validasi kepemilikan data (user hanya bisa hapus task miliknya)
- Toggle Status: Fitur toggle cepat untuk mengubah status task antara pending dan completed

## 3. Dashboard & Statistik
- Statistics Cards: Menampilkan total tasks, tasks pending, dan tasks completed
- Task Overview: Ringkasan jumlah tasks yang dimiliki pengguna
- Quick Actions: Shortcut untuk menambah task baru dan melihat daftar tasks lengkap

## 4. Manajemen Session & Keamanan
- Session Validation: Cek session di setiap halaman yang membutuhkan autentikasi
- Ownership Validation: Validasi kepemilikan data sebelum operasi edit/delete
- Auto Logout: Session destruction setelah 30 menit inaktivitas
- Route Protection: Redirect ke login jika mengakses halaman terproteksi tanpa autentikasi

## 5. Fitur Tambahan
- Deadline Visualization: Badge warna berdasarkan status deadline (normal, mendekati, terlambat)
- Responsive Design: Interface yang kompatibel dengan desktop dan mobile
- Real-time Status Update: Toggle status tanpa reload halaman

## 🚀 Fitur Utama
1. Autentikasi Pengguna
- Register: Form pendaftaran akun baru dengan validasi username (unik), email (valid dan unik), serta password hashing menggunakan algoritma bcrypt melalui fungsi password_hash()
- Login: Sistem autentikasi dengan username atau email, verifikasi password menggunakan password_verify(), dan inisialisasi session dengan timestamp login
- Logout: Menghapus seluruh session data (session_unset(), session_destroy()) dan redirect ke halaman login dengan pesan konfirmasi
- Session Management: Session timeout otomatis setelah 30 menit (1800 detik) inaktivitas dengan validasi waktu login di $_SESSION['login_time']

2. Manajemen Tasks (CRUD Operations)
- Tambah Task: Form input dengan field judul (required), deskripsi (optional, textarea), dan deadline (optional, date picker) menggunakan PDO prepared statements
- Lihat Tasks: Menampilkan daftar tasks dalam format tabel terurut berdasarkan status (pending pertama) dan deadline terdekat, dengan visualisasi badge warna untuk deadline status
- Edit Task: Form edit dengan validasi kepemilikan data (user hanya bisa edit task miliknya), dapat mengubah judul, deskripsi, deadline, dan status task (pending/completed)
- Hapus Task: Konfirmasi delete dengan JavaScript confirm() dialog dan validasi ownership sebelum penghapusan dari database
- Toggle Status: Fitur one-click toggle untuk mengubah status task antara pending dan completed melalui parameter URL dengan validasi keamanan

3. Dashboard & Statistik
- Dashboard Overview: Halaman utama setelah login yang menampilkan welcome message dengan username pengguna
- Statistics Cards: Tiga kartu statistik yang menampilkan (1) Total Tasks, (2) Pending Tasks, dan (3) Completed Tasks dengan perhitungan real-time dari database
- Quick Actions: Tombol akses cepat untuk "Tambah Task" dan "Lihat Tasks" untuk navigasi yang efisien
- Empty State Handling: UI yang informatif ketika belum ada tasks dengan call-to-action untuk membuat task pertama

4. Session & Security System
- Session Validation: Pengecekan $_SESSION['user_id'] di setiap halaman terproteksi melalui includes/auth-check.php
- wnership Validation: Validasi kepemilikan data sebelum operasi edit/delete dengan query WHERE user_id = ?
- Auto Logout: Mekanisme timeout yang menghapus session dan redirect ke login jika melebihi 30 menit inaktivitas
- Route Protection: Redirect otomatis ke halaman login jika mengakses halaman terproteksi tanpa session yang valid
- CSRF Protection: Implementasi token-based form submission (siap untuk diimplementasikan lebih lanjut)

5. User Interface & Experience
- Responsive Design: Menggunakan Bootstrap 5 untuk layout yang responsif di desktop, tablet, dan mobile
- Visual Feedback: Alert messages untuk success/error operations dengan auto-hide functionality
- Deadline Visualization: Sistem badge warna: hijau (completed), biru (normal), kuning (deadline ≤ 3 hari), merah (terlambat)
- Table Interface: Tabel tasks dengan hover effect, status indicator, dan action buttons yang jelas
- Empty States: Desain yang user-friendly untuk kondisi belum ada data dengan guidance yang jelas

6. Database & Backend Architecture
- PDO Connection: Koneksi database menggunakan PHP Data Objects dengan error handling dan UTF-8 configuration
- Database Schema: Dua tabel utama: users (id, username, email, password, created_at) dan tasks (id, user_id, title, description, due_date, status, created_at) dengan foreign key constraint
- Prepared Statements: Penggunaan PDO prepared statements untuk semua query database dengan parameter binding
- Input Validation: Server-side validation untuk required fields dan sanitasi data input
- Output Encoding: Penggunaan htmlspecialchars() dan nl2br() untuk aman dan format output yang tepat

7. Fitur Keamanan Tambahan
- Password Security: Password disimpan sebagai hash menggunakan PASSWORD_DEFAULT algorithm
- SQL Injection Prevention: 100% menggunakan parameterized queries dengan PDO
- XSS Prevention: Output encoding pada semua data user yang ditampilkan di UI
- Direct Access Prevention: .htaccess configuration untuk membatasi akses file sensitif
- Session Fixation Protection: Session regeneration pada login
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

## 📋 Cara Instalasi dan Menjalankan Aplikasi
## Prerequisites
- XAMPP/WAMP/LAMP stack (PHP 7.4+ dan MySQL 5.7+)
- Web browser modern (Chrome, Firefox, Edge)
- Git (opsional, untuk cloning repository)

## 📦 Langkah-langkah Instalasi
1. Install XAMPP
- Download XAMPP dari https://www.apachefriends.org
- Install dengan konfigurasi default
- Pastikan Apache dan MySQL berjalan di XAMPP Control Panel

2. Setup Project Folder
- Clone atau download source code project
- Letakkan folder project di dalam direktori:
```text
C:\xampp\htdocs\todo-app\  (Windows)
/opt/lampp/htdocs/todo-app/ (Linux)
```

3. Konfigurasi Database
- Buka phpMyAdmin di browser: http://localhost/phpmyadmin
- Buat database baru dengan nama `todo_app`
- Pilih database tersebut dan eksekusi SQL berikut:

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
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```
4. Konfigurasi Aplikasi (Opsional)

- Jika menggunakan kredensial database berbeda, edit file config/database.php:

```php
private $host = "localhost";
private $db_name = "todo_app";
private $username = "root";    # Sesuaikan jika perlu
private $password = "";        # Sesuaikan jika perlu
```
5. Jalankan Aplikasi

- Pastikan Apache dan MySQL berjalan di XAMPP
- Buka browser dan akses: http://localhost/todo-app/
- Aplikasi siap digunakan

## Testing Instalasi
1. Buka http://localhost/todo-app/  (harus tampil halaman landing)
2. Klik "Daftar" untuk registrasi akun baru
3. Login dengan akun yang dibuat
4. Coba tambah task pertama Anda

## 🔒 Keamanan yang Diimplementasikan
1. Password Security
- Password Hashing: Menggunakan `password_hash()` dengan algoritma PASSWORD_DEFAULT (bcrypt)
- Password Verification: Menggunakan `password_verify()` untuk autentikasi
- Salt Automatic: Salt di-generate otomatis oleh PHP, tidak perlu manual salt
- Strong Algorithm: Bcrypt dengan cost factor default (saat ini 10)

2. SQL Injection Prevention
- 100% PDO Prepared Statements: Semua query menggunakan parameter binding
- Parameter Binding: Menggunakan execute([$params]) untuk semua input user
- Type Safety: Validasi tipe data untuk numeric parameters (is_numeric())
- Database Abstraction: PDO sebagai database abstraction layer

3. XSS (Cross-Site Scripting) Protection
- Output Encoding: Menggunakan htmlspecialchars($string, ENT_QUOTES, 'UTF-8') untuk semua output
- Context-Aware Encoding: Encoding khusus untuk HTML context
- Data Sanitization: trim() dan validasi untuk input sebelum penyimpanan
- NL2BR untuk Textarea: Menggunakan nl2br() untuk menjaga format baris baru

4. Session Security
- Session Timeout: Auto logout setelah 30 menit (1800 detik) inaktivitas
- Session Regeneration: Session di-update timestamp pada setiap aktivitas
- Session Validation: Cek $_SESSION['login_time'] di setiap request
- Secure Session Destruction: session_unset() dan session_destroy() pada logout

5. Access Control & Authorization
- Ownership Validation: Cek user_id sebelum operasi CRUD pada tasks
- Route Protection: Redirect ke login jika mengakses halaman terproteksi tanpa session
- Direct URL Access Prevention: Validasi parameter ID dan kepemilikan data
- Authentication Check: File includes/auth-check.php di-include di semua halaman terproteksi

6. Input Validation
- Server-Side Validation: Validasi di PHP meski sudah ada client-side validation
- Required Fields: Validasi field required sebelum processing
- Email Format: Validasi format email pada registrasi
- Data Trimming: trim() untuk menghapus whitespace yang tidak perlu

## 📊 Testing yang Dilakukan
1. Functional Testing
- User Registration
Registrasi dengan data valid
Registrasi dengan username duplikat (error expected)
Registrasi dengan email duplikat (error expected)
Registrasi dengan email tidak valid
Registrasi dengan password kosong

- User Authentication
Login dengan credentials valid
Login dengan password salah
Login dengan username/email tidak terdaftar
Logout dan verifikasi session destruction
Access halaman terproteksi tanpa login (redirect expected)

- Task Management (CRUD)
Create task dengan semua field
Create task hanya dengan judul (required field)
Read tasks - tampilkan hanya tasks milik user
Update task - edit semua field
Delete task dengan konfirmasi
Toggle status (pending ↔ completed)
Filter tasks by status (pending first)

- Session Management
Session persistance selama aktif
Auto logout setelah 30 menit inaktivitas
Session tidak accessible setelah logout

- Multipe browser tabs handling

2. Security Testing

- SQL Injection Attempts
Input: ' OR '1'='1 pada login form
Input: "; DROP TABLE users; -- pada task title
Input: 1; INSERT INTO users... pada ID parameter
Result: Semua attempts failed - data tetap aman

- XSS Attempts
Input: <script>alert('xss')</script> pada task title
Input: <img src=x onerror=alert('xss')> pada description
Input: javascript:alert('xss') pada input field
Result: Script tidak dieksekusi, ditampilkan sebagai plain text

- Authorization Testing
Access task user lain via direct URL (http://localhost/todo-app/edit-task.php?id=999)
Delete task user lain via parameter manipulation
Edit task tanpa kepemilikan yang valid
Result: Redirect/error atau data tidak ditemukan

- Session Testing
Session fixation attempt
Access dengan expired session
Concurrent sessions handling
Session hijacking simulation

3. User Flow Testing
   
- Happy Path Scenario
Register → Login → Dashboard → Add Task → View Tasks → Edit Task → Toggle Status → Delete Task → Logout
Waktu eksekusi: < 2 menit untuk complete flow

- Error Handling Scenario
Login dengan wrong credentials → proper error message
Add task tanpa judul → validation error
Edit non-existent task → redirect to tasks list
Access protected page without login → redirect to login

- Edge Cases
Task dengan deadline tanggal lampau
Task dengan description sangat panjang
Special characters dalam task title
Empty state (belum ada tasks)
Single user dengan banyak tasks (performance test)

4. Database Testing

- Data Integrity
Foreign key constraint bekerja (CASCADE delete)
Unique constraints (username, email) enforced
ENUM constraint untuk status
Timestamps automatically generated

- Query Performance
SELECT queries dengan WHERE clause efisien
JOIN operations optimal
COUNT queries untuk statistics cepat
Index utilization verified

5. Security Audit Results

| Vulnerability| Status | Keterangan |
|----------|---------|------|
| SQL Injection | ✅ PASS | Dilindungi dengan PDO prepared statements dan parameter binding |
| XSS (Cross-Site Scripting) | ✅ PASS | Output encoding menggunakan `htmlspecialchars()` | 
| Session Hijacking | ✅ PASS | Session timeout dan validasi session diimplementasikan | 
| CSRF Attacks | ⚠️ PARTIAL | Proteksi dasar tersedia, disarankan menambahkan CSRF token |
| Brute Force Login | ⚠️ PARTIAL | Belum ada rate limiting pada proses login |
| Insecure Direct Object Reference (IDOR) | ✅ PASS | Validasi kepemilikan data (ownership validation) diterapkan |

7. Test Data Sample
```text
User Test Accounts:
1. demo@example.com / demo123
2. test@test.com / password123

Sample Tasks:
- Title: "Mengerjakan laporan akhir"
  Desc: "Deadline Jumat depan"
  Due: 2024-01-20
  Status: Pending

- Title: "Meeting tim project"
  Desc: "Persiapan presentasi"
  Due: 2024-01-15
  Status: Completed
  ```
8. Issues Found & Resolved
- Issue: Session tidak konsisten di beberapa halaman
- Solution: Tambah session_start() di setiap file PHP

- Issue: SQL error saat input special characters
- Solution: Set utf8 encoding di PDO connection

- Issue: Tidak ada feedback setelah delete task
- Solution: Tambah redirect ke tasks.php setelah delet
