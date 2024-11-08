## Langkah Installasi Pertama:
- Ganti nama file .env menjadi env di folder /project-dandan-baru/logistik/
- Untuk penggunaan pertama, aktifkan menu daftar dengan menggunakan cara dibawah.
- Setelah mengaktifkan menu register, pada halaman login cari link daftar akun.
- Isi data sesuai dengan kolom yang dibutuhkan, user akan langsung diarahkan ke halaman beranda/dashboard.

## Langkah menonaktifkan/mengaktifkan link Register pada halaman login
- Edit file Auth.php pada folder /project-dandan-baru/logistik/app/config/
- Ganti nilai vaiable $allowRegistration = true/false
- Jika nilai variabel diatas true maka link Register akan muncul dan sebalik nya.
