<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
</head>
<body>

    <h1>HALAMAN DASHBOARD UMUM</h1>
    <p>Halo, selamat datang <b>{{ Auth::user()->name ?? 'User Umum' }}</b>!</p>
    <p>Status Akun: Pengguna Umum.</p>

    <hr>

    <!-- Menu Navigasi Polos -->
    <ul>
        <li><a href="#">Lihat Profil Saya</a></li>
        <li><a href="#">Riwayat Transaksi</a></li>
    </ul>

</body>
</html>
