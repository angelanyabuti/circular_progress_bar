<?php

namespace App\Http\Livewire;

use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckinComponent extends Component
{
    public $long, $lat, $stores;

    protected $listeners =['getShops'];
    public function render()
    {
        return view('livewire.checkin-component');
    }

    public function getShops()
    {

        $shops = DB::table("shops")
            ->select("shops.id"
                ,DB::raw("6371 * acos(cos(radians(" . $this->lat . "))
        * cos(radians(shops.latitude))
        * cos(radians(shops.longitude) - radians(" . $this->long . "))
        + sin(radians(" .$this->lat. "))
        * sin(radians(shops.latitude))) AS distance"))
            ->having("distance", "<", 10)
            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
//            ->groupBy("shops.id")
            ->get();

       $this->listShops($shops);
    }

    public function listShops($shops)
    {
        foreach ($shops as $shop)
        {
            $sop =  Shop::has('products')
                ->with('products')->find($shop->id);
            if ($sop instanceof Shop)
            {
                $this->stores []= $sop;
            }
        }

        if ($this->stores == null)
        {
            $this->emit('message','NO Deals within, Check later');
        }


    }
}
