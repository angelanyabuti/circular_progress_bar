<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MerchantSubscriptionComponent extends Component
{
    public $invoice, $plan, $fs, $hash;

    public function mount()
    {

        $user = auth()->user();

        $invoice = Invoice::where('customer_id', '=', $user->id)->latest()->first();

        $plan = Plan::find($user->plan_id);
        $this->invoice = $invoice;
        $this->plan = $plan;
    }

    public function render()
    {
        if ($this ->invoice) {

            $this->pay();
        }


        return view('livewire.merchant-subscription-component');
    }

    public function pay()
    {

        $fields = $this->ipayFrame($this->invoice);

        $this->fs = $fields[1];
        $this->hash = $fields[0];
    }

    public function ipayFrame($invoice)
    {
        $fields = array(
            "live"=> "0",
            "oid"=> 'inv-' . $invoice ->id,
            "inv"=> 'inv-' . $invoice ->id,
            "ttl"=> $invoice ->amount,
            "tel"=> '0'.substr($invoice -> user -> phone, -9),
            "eml"=>  $invoice -> user -> email,
            "vid"=> "demo",
            "p1"=> "",
            "p2"=> "",
            "p3"=> "",
            "p4"=> "900",
            "curr"=> "KES",
            "cbk"=> route('ipay.callBack'),
            "cst"=> "1",
            "crl"=> "2"
        );
        /*
        ----------------------------------------------------------------------------------------------------
        ************(b.) GENERATING THE HASH PARAMETER FROM THE DATASTRING *********************************
        ----------------------------------------------------------------------------------------------------

        The datastring IS concatenated from the data above
        */
        $datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];

//        $datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['cbk'].$fields['cst'].$fields['crl'];
        $hashkey = 'demoCHANGED';
        //use "demoCHANGED" for testing where vid is set to "demo"

        /********************************************************************************************************
         * Generating the HashString sample
         */
        $generated_hash = hash_hmac('sha1',$datastring , $hashkey);

        return [$generated_hash, $fields];
    }

    public function startSub()
    {
//        dd($this->plan->isFree());

        if ($this->plan->isFree()) {
            if (Auth::user()->subscribedTo($this->plan->id) && Auth::user()->subscription(Auth::user()->slug)->ended()) {
                Auth::user()->subscription($this->plan->slug)->renew();
            } else {
                Auth::user()->newSubscription($this->plan->name . ' - ' . 'Main', $this->plan);

                return redirect()->route('dashboard');
            }
        }
        return redirect()->route('auth.plans');
    }
}
