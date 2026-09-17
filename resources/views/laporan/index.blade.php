<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
</head>
<body>
    <h1>Rekap Penjualan</h1>
    <ul>
        <li><strong>Total Transaksi:</strong> {{ $statistik['total_transaksi'] }}</li>
        <li><strong>Total Pendapatan:</strong> Rp {{ number_format($statistik['total_pendapatan'], 0, ',', '.') }}</li>
        <li><strong>Produk Terlaris:</strong> {{ $statistik['produk_terlaris'] }}</li>
    </ul>
</body>
</html>