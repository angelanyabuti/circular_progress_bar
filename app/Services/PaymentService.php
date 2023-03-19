<?php


namespace App\Services;


use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentService
{
    public function store(array  $data)
    {
        $payment  = New Payment();
        $payment -> amount = $data['amount'];
        $payment -> ref = Str::random(8);
        $payment -> source = $data['source'];
        $payment -> order_id = $data['order_id'];
        $payment -> user_id = $data['user_id'];
        $payment -> save();
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }


}
