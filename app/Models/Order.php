<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $searchTerm) {
        return $query
            ->where('course_title', 'like', "%" . $searchTerm . "%")
            ->orWhere('subject_code', 'like', "%" . $searchTerm . "%")
            ->orWhere('course_no', 'like', "%" . $searchTerm . "%");
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
