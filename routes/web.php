<?php

use App\Http\Controllers\ApiBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LaporanPenjualanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;

Route::get('/posts', [PostController::class,'index']);

Route::get('/hello', function(){
    return "Hello World";
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// KELOMPOK ROUTE UNTUK ADMIN
Route::middleware(['auth', 'checkrole:admin'])->prefix('/admin')->group(function(){
    Route::get('/dashboard', function () {
        // Membuka file di: resources/views/admin/dashboard.blade.php
        return view('admin.dashboard'); 
    });
});

// KELOMPOK ROUTE UNTUK USER UMUM
Route::middleware(['auth', 'checkrole:umum'])->prefix('/user')->group(function(){
    Route::get('/dashboard', function () {
        // Membuka file di: resources/views/user/dashboard.blade.php
        return view('user.dashboard'); 
    });
});

Route::get('/', function () {
    // Mengirim data ke view menggunakan array asosiatif
    return view('dashboard_pos', [
        'nama_pegawai' => 'Budi Santoso',
        'shift' => 'Pagi (08:00 - 15:00)'
    ]);
});

// Rute dengan Parameter Wajib (Melihat detail produk berdasarkan ID)
Route::get('/produk/{id}', function ($id) {
    return 'Menampilkan data produk dengan ID: ' . $id;
});
// Rute dengan Parameter Opsional (Mencari produk berdasarkan nama)
Route::get('/produk/cari/{nama?}', function ($nama = null) {
    if ($nama) {
        return 'Hasil pencarian produk: ' . $nama;
    }
    return 'Silakan masukkan kata kunci pencarian pada URL 
    (contoh: /produk/cari/sabun)';
});

// Group Rute untuk Fitur Admin (Manajemen Data)
Route::prefix('admin')->group(function () {
    Route::get('/produk', function () {
        return 'Halaman Kelola Produk (Hanya Admin)';
    })->name('admin.produk');
    Route::get('/kategori', function () {
        return 'Halaman Kelola Kategori Produk (Hanya Admin)';
    })->name('admin.kategori');
});
// Group Rute untuk Fitur Kasir (Transaksi)
Route::prefix('kasir')->group(function () {
    Route::get('/transaksi', function () {
        return 'Halaman Input Transaksi Penjualan (Kasir)';
    })->name('kasir.transaksi');
});

Route::get('/produk-toko', function () {
    $produk = [
        [
            'nama' => 'Beras Pandan Wangi 5kg',
            'sku' => 'KL-BRS-001',
            'harga' => 75000,
            'stok' => 20,
            'foto' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=150&auto=format&fit=crop&q=80'
        ],
        [
            'nama' => 'Minyak Goreng Pouch 2L',
            'sku' => 'KL-MYK-002',
            'harga' => 34000,
            'stok' => 15,
            'foto' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=150&auto=format&fit=crop&q=80'
        ],
        [
            'nama' => 'Gula Pasir Premium 1kg',
            'sku' => 'KL-GLA-003',
            'harga' => 17500,
            'stok' => 30,
            'foto' => 'https://images.tokopedia.net/img/cache/700/VqbcmM/2022/3/15/dd3e3256-b936-46f7-93be-b06995a71a44.jpg.webp'
        ],
    ];

    return view('daftar_produk', compact('produk'));
});

route::apiResource('book', ApiBookController::class);
route::resource('book', BookController::class);

route::get('/laporan', LaporanPenjualanController::class);

Route::get('/users/insert', [UserController::class, 'insertData']);
Route::get('/users/read', [UserController::class, 'readData']);
// Route::get('/users/update', [UserController::class, 'updateData']);
// Route::get('/users/delete', [UserController::class, 'deleteData']);
Route::get('/users/pluck', [UserController::class, 'pluckData']);
Route::get('/users/aggregate', [UserController::class, 'aggregateData']);
Route::get('/users/join', [UserController::class, 'joinData']);
Route::get('/users/ordering', [UserController::class, 'orderingAndPaging']);
Route::get('/users/subquery', [UserController::class, 'subqueryData']);
Route::get('/users/raw', [UserController::class, 'rawQueryData']);

Route::get('/eloquent/create', [UserController::class, 'storeData']);
Route::get('/eloquent/read', [UserController::class, 'retrieveData']);
Route::get('/eloquent/update', [UserController::class, 'updateData']);
Route::get('/eloquent/delete', [UserController::class, 'deleteData']);

Route::get('/eloquent/conditionals', [UserController::class, 'conditionalQueries']);
Route::get('/eloquent/accessor', [UserController::class, 'showAccessor']);
Route::get('/eloquent/soft-deletes', [UserController::class, 'handleSoftDeletes']);
Route::get('/eloquent/scope', [UserController::class, 'showActiveUsers']);


// 1. Route untuk MENAMPILKAN halaman form (Method: GET)
Route::get('/form', function () {
    return view('form'); // Mengakses file resources/views/form.blade.php
});

// 2. Route untuk MEMPROSES data dari form (Method: POST)
Route::post('/submit', [FormController::class, 'submitForm']);