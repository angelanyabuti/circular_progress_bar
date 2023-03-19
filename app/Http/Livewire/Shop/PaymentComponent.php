<?php

namespace App\Http\Livewire\Shop;


use App\Models\Agent;
use App\Models\County;
use App\Models\Order;
use App\Models\Shop;
use App\Services\ipayService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class PaymentComponent extends Component
{
    public $order, $fs, $hash, $user, $counties, $latitude, $longitude, $address, $name,$email, $phone, $county;

    public $agent;
    public $distance = 0;
    public $method;
    public $agents = [];
    public $addm = true;

    public function mount($order)
    {
        $this->order = Order::find($order);
    }
    public function render()
    {
        $this->pay();
        $this->user = Auth::user();
        $this->name = $this->user -> name;
        $this->email = $this->user -> email;
        $this->phone = $this->user -> phone_number;
        $this->counties = County::all();

        return view('livewire.shop.payment-component')->layout('layouts.index');
    }

    public function updatedAgent()
    {
        if ($this->agent )
        {
            $this->method = 'pick';
        }
    }

    public function updatedMethod()
    {
        if ($this->method == 'home')
        {
            $this->order ->update([
                    'shipping_cost' =>  sprintf('%.2f', $this->distance * 20)
                ]
            );
            $this->agent = '';
        }else{
            $this->order->update([
                'shipping_cost' => 0.0,
            ]);
        }
    }

    public function add()
    {
        $this->validate([
            'latitude'=> 'required'
        ]);
        $this->order -> update([
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ]);

        $this->addm = false;
        $this->getAgents();
        $this->getDistanceBetweenPointsNew();
    }

    public function getAgents()
    {
        $agents =DB::table("agents")
            ->select("agents.id"
                ,DB::raw("6371 * acos(cos(radians(" . $this->latitude . "))
        * cos(radians(agents.latitude))
        * cos(radians(agents.longitude) - radians(" . $this->longitude . "))
        + sin(radians(" .$this->latitude. "))
        * sin(radians(agents.latitude))) AS distance"))
            ->having("distance", "<", 5)
            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
//            ->groupBy("shops.id")
            ->get();

        $this->ListAgents($agents);
    }

   public function getDistanceBetweenPointsNew($unit = 'km') {
        $theta = 36.8219 - $this->longitude;
        $distance = (sin(deg2rad(-1.2921)) * sin(deg2rad($this->latitude))) + (cos(deg2rad(-1.2921)) * cos(deg2rad($this->latitude)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch($unit) {
            case 'miles':
                break;
            case 'km' :
                $distance = $distance * 1.609344;
        }

        $this->distance =ceil($distance);
    }



    public function listAgents($shops)
    {
        foreach ($shops as $shop)
        {
            $sop =  Agent::with('user')->find($shop->id);
            if ($sop instanceof Agent)
            {
                $this->agents []= $sop;
            }
        }

//        dd($this->agents);


    }

    public function pay()
    {
        $fiels = $this->ipayFrame($this->order);

        $this->fs = $fiels[1];
        $this->hash = $fiels[0];
    }

    public function ipayFrame($invoice)
    {
        $ips = new ipayService();
        return $ips->ipayFrame($invoice);
    }
}
