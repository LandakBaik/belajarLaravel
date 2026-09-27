<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Model
{
    use HasFactory;
    // 4a) Menambahkan Soft Deletes pada Model
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    // 5a) & 5b) Mass Assignment Protection (Gunakan salah satu: $fillable atau $guarded)
    protected $fillable = ['name', 'email', 'password', 'first_name', 'last_name', 'status', 'role', 'age'];
    // protected $guarded = ['id'];
   

    // 2) Relasi Antar Model (Eloquent Relationships)
    
    // a) One to One
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // b) One to Many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // c) Many to Many
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // 3) Mutators & Accessors
    
    // a) Mutator (Mengubah data sebelum disimpan)
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // b) Accessor (Mengubah data sebelum ditampilkan)
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // 6) Query Scopes (Local Scope)
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}