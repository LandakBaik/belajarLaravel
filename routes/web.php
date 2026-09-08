<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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