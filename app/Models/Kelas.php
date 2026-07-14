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

    public function getActiveUsersCountAttribute()
    {
        return $this->users()
            ->where('is_active', true)
            ->count();
    }

    public function getInactiveUsersCountAttribute()
    {
        return $this->users()
            ->where('is_active', false)
            ->count();
    }
}
