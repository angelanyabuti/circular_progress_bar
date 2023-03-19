<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $casts = [
        'channel' => 'array',
    ];

    public function scopeSearch($query, $search) {
        return $query
            ->where('id', 'like', '%'.$search.'%')
            ->orWhere('title', 'like', '%'.$search.'%')
            ->orWhere('body', 'like', '%'.$search.'%');
    }
}
