<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
</head>
<body>

    <h1>PANEL UTAMA ADMIN</h1>
    <p>Selamat datang, <b>{{ Auth::user()->name ?? 'Administrator' }}</b>!</p>
    <p>Status Akun: Anda login sebagai Admin (Kendali Penuh).</p>
    
    <hr>

    <!-- Menu Navigasi Polos -->
    <ul>
        <li><a href="#">Kelola Data Pengguna</a></li>
        <li><a href="#">Lihat Laporan Keuangan</a></li>
        <li><a href="#">Pengaturan Sistem</a></li>
    </ul>

</body>
</html>
