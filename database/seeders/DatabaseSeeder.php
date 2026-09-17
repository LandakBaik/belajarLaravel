<?php

namespace Database\Seeders;
use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'role' => 'umum',
        ]);

        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'role' => 'admin',
        ]);

        Book::create([
            'nama' => 'Bercerita',
            'harga' => '15000',
            'stok' => 10
        ]);

        Book::create([
            'nama' => 'Terharu',
            'harga' => '45000',
            'stok' => 19
        ]);

        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ]);
            
        \App\Models\Product::factory(50)->create();
    }
}
