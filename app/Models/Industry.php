<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    public function scopeSearch($query, $search) {
        return $query
            ->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
