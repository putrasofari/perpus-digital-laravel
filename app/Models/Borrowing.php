<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'requested_at',
        'approved_at',
        'borrow_date',
        'due_date',
        'returned_at',
        'status',
        'description',
    ];

    protected $casts = [
        'requested_at' => 'date',
        'approved_at' => 'date',
        'borrow_date' => 'date',
        'due_date' => 'date',
        'returned_at' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getIsLateAttribute()
    {
        return $this->status === 'dipinjam'
            && $this->due_date
            && now()->gt($this->due_date);
    }

    public function getLateDaysAttribute()
    {
        if (!$this->is_late) {
            return 0;
        }

        return now()->diffInDays($this->due_date);
    }

    public function getStatusLabelAttribute()
    {
        if ($this->is_late) {
            return "Terlambat {$this->late_days} Hari";
        }

        return match ($this->status) {

            'menunggu' => 'Menunggu',

            'diterima' => 'Disetujui',

            'dipinjam' => 'Dipinjam',

            'ditolak' => 'Ditolak',

            'dikembalikan' => 'Dikembalikan',

            default => '-',
        };
    }

    public function getStatusColorAttribute()
    {
        if ($this->is_late) {
            return 'red';
        }

        return match ($this->status) {

            'menunggu' => 'yellow',

            'diterima' => 'blue',

            'dipinjam' => 'green',

            'ditolak' => 'red',

            'dikembalikan' => 'slate',

            default => 'gray',
        };
    }
}
