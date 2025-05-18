Sistem Akademik
Repository ini dibuat untuk memenuhi tugas mata kuliah Administrasi Sistem kelas TI - C. Aplikasi web ini berguna untuk mengelola daftar mata kuliah, dengan pengelompokan per semester dan halaman admin untuk CRUD.
Prasyarat

Docker
Docker Compose

Cara Menjalankan

Clone repository ini.
Masuk ke direktori proyek: cd project-akademik
Jalankan Docker Compose: docker-compose -f docker/docker-compose.yml up -d
Akses aplikasi:
Halaman utama: http://localhost:8080
Halaman admin: http://localhost:8080/admin.php (username: admin, password: admin123)
phpMyAdmin: http://localhost:8081


Untuk menghentikan: docker-compose -f docker/docker-compose.yml down

Struktur Proyek

docker/: File Docker dan skrip SQL.
src/: Kode aplikasi PHP.
config/: Konfigurasi database.


.gitignore: File yang diabaikan oleh Git.
README.md: Dokumentasi ini.

Catatan

Data MySQL disimpan di volume mysql-data untuk persistensi.
Pastikan port 8080 dan 8081 tidak digunakan oleh aplikasi lain.

