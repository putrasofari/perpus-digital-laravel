<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'kelas',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
