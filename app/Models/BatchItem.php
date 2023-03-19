<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchItem extends Model
{
    use HasFactory;

    protected $table = 'batch_items';

    public function batch()
    {
        return $this->belongsTo(ShippingBatch::class,'shipping_batch_id');
    }
}
