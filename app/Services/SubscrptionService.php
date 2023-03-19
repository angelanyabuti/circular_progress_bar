<?php

namespace App\Services;

class SubscrptionService
{
    public static function subscribe($plan, $user)
    {
        if (!$plan->isFree()) {
            $inv = new \App\Models\Invoice();
            $inv->customer_id = $user->id;
            $inv->amount = $plan->price;
            $inv->plan_id = $plan->id;
            $inv ->save();
            return $inv;
        } else {
            $user->newSubscription($plan->name . ' - ' . 'Main', $plan);
//            return redirect()->route('dashboard');
            return 0;
        }
    }
}
