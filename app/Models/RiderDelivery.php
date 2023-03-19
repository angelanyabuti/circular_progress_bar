<?php

namespace App\Models;

use App\Enums\RiderDelivaryStatus;
use App\Notifications\ConfirmOrderReceived;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Konekt\Enum\Eloquent\CastsEnums;
use Ramsey\Uuid\Uuid;

class RiderDelivery extends Model
{
    use HasFactory;

    use CastsEnums;

    protected $guarded = [];

    protected $enums = [
        'status' => RiderDelivaryStatus::class
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updated(function ($model) {
            if ($model->status == RiderDelivaryStatus::COMPLETED) {
                $order = $model->order;
                $order->receive_confirm_code = Uuid::uuid4();
                $order->save();

                Notification::route('africasTalking', $order->customer->phone_number)
                    ->notify(new ConfirmOrderReceived($order->receive_confirm_code));
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
