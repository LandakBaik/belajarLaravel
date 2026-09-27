<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    // 1. Pengenalan & Pembuatan Data Baru (Insert)
    public function insertData()
    {
        // Insert standar
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123')
        ]);

        // Insert dan mendapatkan ID yang baru dibuat
        $id = DB::table('users')->insertGetId([
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => bcrypt('password123')
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'new_user_id' => $id
        ]);
    }

    // 2. Mengambil Data dari Database (Read / Select)
    public function readData()
    {
        // Mengambil semua data
        $allUsers = DB::table('users')->get();

        // Mengambil data berdasarkan kondisi (baris pertama)
        $singleUser = DB::table('users')->where('email', 'johndoe@example.com')->first();

        // Mengambil kolom spesifik
        $specificColumns = DB::table('users')->select('id', 'name')->get();

        // Where dengan banyak kondisi
        $activeAdmins = DB::table('users')
            ->where('status', 'active')
            ->where('role', 'admin')
            ->get();

        // Where dengan operator pembandingan
        $adultUsers = DB::table('users')->where('age', '>=', 18)->get();

        return response()->json([
            'all_users' => $allUsers,
            'single_user' => $singleUser,
            'specific_columns' => $specificColumns,
            'active_admins' => $activeAdmins,
            'adult_users' => $adultUsers,
        ]);
    }

    // 3. Memperbarui Data (Update)
    // public function updateData()
    // {
    //     // Update data standar
    //     DB::table('users')
    //         ->where('email', 'johndoe@example.com')
    //         ->update(['status' => 'inactive']);

    //     // Increment & Decrement
    //     DB::table('users')->where('id', 1)->increment('points', 10);
    //     DB::table('users')->where('id', 1)->decrement('points', 5);

    //     return response()->json(['message' => 'Data berhasil diperbarui']);
    // }

    // 4. Menghapus Data (Delete)
    // public function deleteData()
    // {
    //     // Hapus data berdasarkan kondisi
    //     DB::table('users')->where('email', 'johndoe@example.com')->delete();

    //     // Truncate (Hapus semua data dan reset auto-increment)
    //     // DB::table('users')->truncate(); // Gunakan dengan hati-hati!

    //     return response()->json(['message' => 'Data berhasil dihapus']);
    // }

    // 5. Mengambil Daftar Nilai Kolom (Pluck)
    public function pluckData()
    {
        // Pluck satu kolom (Array dari nama)
        $names = DB::table('users')->pluck('name');

        // Pluck dua kolom (Key = email, Value = name)
        $usersMap = DB::table('users')->pluck('name', 'email');

        return response()->json([
            'names' => $names,
            'users_map' => $usersMap
        ]);
    }

    // 6. Agregat (Count, Sum, Avg, Max, Min)
    public function aggregateData()
    {
        $totalUsers = DB::table('users')->count();
        $totalPoints = DB::table('users')->sum('points');
        $averageAge = DB::table('users')->avg('age');
        $maxSalary = DB::table('employees')->max('salary');
        $minSalary = DB::table('employees')->min('salary');

        return response()->json([
            'total_users' => $totalUsers,
            'total_points' => $totalPoints,
            'average_age' => $averageAge,
            'max_salary' => $maxSalary,
            'min_salary' => $minSalary
        ]);
    }

    // 7. Join (Menggabungkan Tabel)
    public function joinData()
    {
        // Inner Join
        $innerJoin = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.name', 'orders.total_price')
            ->get();

        // Left Join
        $leftJoin = DB::table('users')
            ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
            ->get();

        return response()->json([
            'inner_join' => $innerJoin,
            'left_join' => $leftJoin
        ]);
    }

    // 8. Pengurutan, Limit, dan Offset
    public function orderingAndPaging()
    {
        // Order By
        $orderedUsers = DB::table('users')->orderBy('name', 'asc')->get();

        // Limit
        $limitedUsers = DB::table('users')->limit(10)->get();

        // Offset & Limit (Pagination manual)
        $pagedUsers = DB::table('users')->offset(10)->limit(10)->get();

        return response()->json([
            'ordered' => $orderedUsers,
            'limited' => $limitedUsers,
            'paged' => $pagedUsers
        ]);
    }

    // 9. Subquery
    public function subqueryData()
    {
        $usersWithOrderCount = DB::table('users')
            ->select('name')
            ->selectSub(function ($query) {
                $query->from('orders')
                    ->selectRaw('count(*)')
                    ->whereColumn('orders.user_id', 'users.id');
            }, 'order_count')
            ->get();

        return response()->json($usersWithOrderCount);
    }

    // 10. Query Raw (Raw SQL)
    public function rawQueryData()
    {
        // Select Raw
        $usersByStatus = DB::table('users')
            ->selectRaw('COUNT(*) as total_users, status')
            ->groupBy('status')
            ->get();

        // Where Raw
        $filteredUsers = DB::table('users')
            ->whereRaw('age > ? AND status = ?', [18, 'active'])
            ->get();

        return response()->json([
            'users_by_status' => $usersByStatus,
            'filtered_users' => $filteredUsers
        ]);
    }


    // 1) Menambahkan Data ke Database (Create)
    public function storeData()
    {
        // a) Menggunakan create() (Membutuhkan $fillable di Model)
        $user1 = User::create([
            'name'     => 'John Doe',
            'email'    => 'john@example.com',
            'password' => bcrypt('password')
        ]);

        // b) Menggunakan save()
        $user2 = new User;
        $user2->name     = 'Jane Doe';
        $user2->email    = 'jane@example.com';
        $user2->password = bcrypt('password');
        $user2->save();

        return response()->json([
            'message' => 'Data berhasil dibuat',
            'user1'   => $user1,
            'user2'   => $user2
        ]);
    }


    // 2) Mengambil Data dari Database (Retrieve)
    public function retrieveData()
    {
        // a) Mengambil Semua Data
        $allUsers = User::all();

        // b) Mengambil Data Berdasarkan ID
        $singleUser = User::find(1);

        // c) Menggunakan Query Builder bersama Eloquent
        $filteredUsers = User::where('email', 'john@example.com')->get();

        // d) Menggunakan firstOrFail() (Gagal jika data tidak ditemukan -> 404)
        $userOrFail = User::where('email', 'john@example.com')->firstOrFail();

        return response()->json([
            'all_users'      => $allUsers,
            'single_user'    => $singleUser,
            'filtered_users' => $filteredUsers,
            'user_or_fail'   => $userOrFail
        ]);
    }


    // 3) Memperbarui Data (Update)
    public function updateData()
    {
        // a) Menggunakan update() massal berdasarkan kondisi
        User::where('email', 'john@example.com')->update([
            'name' => 'John Updated'
        ]);

        // b) Menggunakan save() pada instance spesifik
        $user = User::find(1);
        if ($user) {
            $user->name = 'John Updated';
            $user->save();
        }

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }


    // 4) Menghapus Data (Delete)
    public function deleteData()
    {
        // a) Menggunakan delete() dari objek yang ditemukan
        $user = User::find(1);
        if ($user) {
            $user->delete();
        }

        // b) Menggunakan destroy() langsung menggunakan Primary Key / ID
        User::destroy(2); // Atau menghapus beberapa sekaligus: User::destroy([1, 2, 3]);

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    // 1) Conditional Clauses dalam Query
    public function conditionalQueries(Request $request)
    {
        // a) where()
        $activeUsers = User::where('status', 'active')->get();

        // b) orWhere()
        $adminOrActive = User::where('status', 'active')->orWhere('role', 'admin')->get();

        // c) whereBetween()
        $youthUsers = User::whereBetween('age', [18, 30])->get();

        // d) whereIn()
        $staffUsers = User::whereIn('role', ['admin', 'editor'])->get();

        // e) whereNull() dan whereNotNull()
        $nonDeleted = User::whereNull('deleted_at')->get();
        $verified = User::whereNotNull('email_verified_at')->get();

        // f) when() untuk Kondisi Dinamis
        $role = $request->query('role', 'admin');
        $filteredUsers = User::when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->get();

        return response()->json([
            'active' => $activeUsers,
            'admin_or_active' => $adminOrActive,
            'youth' => $youthUsers,
            'staff' => $staffUsers,
            'non_deleted' => $nonDeleted,
            'verified' => $verified,
            'filtered' => $filteredUsers,
        ]);
    }

    // Contoh Penggunaan Accessor
    public function showAccessor()
    {
        $user = User::find(1);
        // Memanggil accessor 'full_name' dari getFullNameAttribute()
        return response()->json([
            'full_name' => $user ? $user->full_name : null
        ]);
    }

    // 4) Pengelolaan Soft Deletes
    public function handleSoftDeletes()
    {
        // b) Menghapus Data (Soft Delete)
        $user = User::find(1);
        if ($user) {
            $user->delete(); // Hanya mengisi kolom deleted_at
        }

        // c) Mengambil semua data, termasuk yang sudah di soft-delete
        $allWithTrashed = User::withTrashed()->get();

        // d) Mengambil data yang HANYA sudah di soft-delete
        $onlyTrashed = User::onlyTrashed()->get();

        // e) Mengembalikan Data yang Dihapus (Restore)
        if ($user) {
            $user->restore();
        }

        return response()->json([
            'with_trashed' => $allWithTrashed,
            'only_trashed' => $onlyTrashed,
        ]);
    }

    // 6) Penggunaan Query Scope
    public function showActiveUsers()
    {
        // Memanggil scope 'active' dari scopeActive() di Model
        $activeUsers = User::active()->get();

        return response()->json($activeUsers);
    }
}

