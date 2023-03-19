<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingBatch extends Model
{
    use HasFactory;

    public function items()
    {
        return $this ->hasMany(BatchItem::class);
    }
}
