<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Plan;
use App\Services\SubscrptionService;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function getPaySubscription()
    {

        $user = auth()->user();
        $plan = Plan::find($user->plan_id);

        if (!$plan) {
            return redirect()->route('auth.plans');
        }


        if ($user->subscribedTo($plan->id)) {
            return redirect()->route('dashboard');
        }

//        $sub = SubscrptionService::subscribe($plan, $user);
//        if ($sub instanceof Invoice)
//        {
//
//            return  redirect()->route('invoice.show', $sub);
//        }
        return view('auth.subscribe');
    }

    public function updatePlan(Request $request)
    {
        $plan = Plan::whereSlug($request->get('plan'))->first();

        if ($plan) {
            if ($user = auth()->user()) {
                $user->plan_id = $plan->id;
                $user->save();
            } else {
                return redirect()->route('login');
            }

            if (!$plan->isFree()) {
                return redirect()->route('get.pay.subscription');
            } else {

                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->route('auth.plans');
        }


    }
}
