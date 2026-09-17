<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $statistik = [
            'total_transaksi' => 150,
            'total_pendapatan' => 45000000,
            'produk_terlaris'  => 'Laptop Gaming',
        ];

        return view('laporan.index', compact('statistik'));
    }
}
