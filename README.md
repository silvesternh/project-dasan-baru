## Langkah Installasi Pertama:
- Ganti nama file .env menjadi env di folder /project-dandan-baru/logistik/
- Import database
- Untuk penggunaan pertama, aktifkan menu daftar dengan menggunakan cara dibawah
- Setelah mengaktifkan menu register, pada halaman login cari link daftar akun
- Isi data sesuai dengan kolom yang dibutuhkan, user akan langsung diarahkan ke halaman beranda/dashboard

## Langkah menonaktifkan/mengaktifkan link Register pada halaman login
- Edit file Auth.php pada folder /project-dandan-baru/logistik/app/config/
- Ganti nilai vaiable $allowRegistration = true/false
- Jika nilai variabel diatas true maka link Register akan muncul dan sebalik nya.

## Special Note
Seluruh struktur web ini menggunakan struktur lama, perubahan hanya terjadi pada penamaan folder project dan penambahan fitur login, register dan edit user.
Nama database dapat menggunakan nama database lama atau di ubah dengan sesuka hati
Harap check ulang isi file app.php pada folder /project-dandan-baru/logistik/app/config/
Tidak ada perubahan pada file config lainnya selain routes.php, pengaturan bahasa pada app.php, validation.php, filters.php dan penambahan beberapa file config lainnya.
