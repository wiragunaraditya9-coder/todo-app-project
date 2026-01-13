# Aplikasi Todo List - Back-End Web Development

## 📋 Deskripsi Singkat
Aplikasi web Todo List untuk manajemen tugas pribadi dengan sistem autentikasi pengguna dan operasi CRUD.

## 👥 Daftar Anggota
| Nama | NIM | Username GitHub | Peran/Tugas |
|------|-----|-----------------|-------------|
| Raditya | [240030084] | [wiragunaraditya9-coder] | BackEnd Developer |
| GusAlit | [240030093] | [gusalit054-eng] | FrontEnd Developer |
| Dewa | [240030099] | [dwastriaa-boop] | Deployment & Testing |

## 🛠 Lingkungan Pengembangan
- **Server:** XAMPP (Apache, PHP 8.2, MySQL)
- **Database:** MySQL
- **Backend:** PHP Native
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **Tools:** VS Code, phpMyAdmin, Git, Ai   

## 🚀 Fitur Utama
### Authentication System
- Registrasi, Login, Logout
- Password hashing dengan `password_hash()`
- Session management dengan timeout

### Task Management (CRUD)
- Create: Tambah task baru
- Read: Lihat semua tasks
- Update: Edit task & ubah status
- Delete: Hapus task

### Session Management
- Session timeout 30 menit
- Secure session handling

## 📁 Struktur Folder
todo-app/
├── config/database.php
├── includes/
├── index.php
├── register.php
├── login.php
├── logout.php
├── dashboard.php
├── add-task.php
├── tasks.php
├── edit-task.php
└── README.md


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

## 📦 Cara Instalasi
1. Install XAMPP

2. Taruh folder di htdocs

3. Buat database todo_app di phpMyAdmin

4. Jalankan query SQL di atas

5. Akses http://localhost/todo-app

🔒 Keamanan
- Password hashing dengan password_hash()

- Prepared statements untuk cegah SQL injection

- htmlspecialchars() untuk cegah XSS

- Session timeout 30 menit

📊 Testing
- Manual testing semua fitur CRUD

- Security testing (SQL injection, XSS)

- User flow testing