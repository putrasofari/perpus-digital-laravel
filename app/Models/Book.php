<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'jmlh_halaman',
        'stok',
        'description',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function getBorrowedCountAttribute()
    {
        return $this->borrowings()
            ->where('status', 'dipinjam')
            ->count();
    }

    public function getAvailableStockAttribute()
    {
        return $this->stok - $this->borrowed_count;
    }
}
