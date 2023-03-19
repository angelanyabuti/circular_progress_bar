<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('title', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
            ;
    }

    public function getImgAttribute()
    {
        if ($this->image != null)
        {
            return asset('storage/'.$this ->image);
        }
        return 'https://source.unsplash.com/random/200*250';
    }
}
