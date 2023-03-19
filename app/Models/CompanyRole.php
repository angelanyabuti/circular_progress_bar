<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRole extends Model
{
    use HasFactory;
    protected $casts = [
        'permissions' => 'array',
    ];
    public function scopeSearch($query, $search) {
        return $query
            ->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('permissions', 'like', '%'.$search.'%');
    }
}
