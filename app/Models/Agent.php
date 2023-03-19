<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $search) {
        return $query
            ->where('id', 'like', '%'.$search.'%')
            ->orWhere('bio', 'like', '%'.$search.'%');
    }


    public function user()
    {
       return  $this->belongsTo(User::class,'user_id');
    }
}
