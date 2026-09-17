<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->only(['index', 'store']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {
        return $book->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Form tambah buku";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Menyimpan buku baru";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Menampilkan buku dengan ID: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Form edit buku dengan ID : " . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Mengupdate buku dengan ID : " . $id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Menghapus Buku dengan ID : " . $id;
    }
}
