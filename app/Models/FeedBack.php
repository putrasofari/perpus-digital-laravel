<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    protected $fillable = [
        'user_id',
        'category',
        'message',
        'reply',
        'replied_at',
    ]; 

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'replied_at' => 'datetime'
    ];
}
