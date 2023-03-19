<?php

namespace App\Http\Livewire\Shop;

use App\Enums\RiderDelivaryStatus;
use App\Models\OrderItem;
use App\Models\Rider;
use App\Models\RiderDelivery;
use App\Models\ShippingBatch;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrdersComponent extends Component
{
    public $perPage = 10;
    public $orders, $state, $active, $code, $batches, $batch, $riders, $rider;
    public function mount($shop)
    {
        $shp = Shop::where('id', $shop)->first();
        $this->orders = OrderItem::where('shop_id', $shop)->get();
        $this->batches = ShippingBatch::where('shop_id',$shop)->where('status','pending')->get();
        $this->riders = Rider::where('company_id',$shp -> company_id)->get();
    }
    public function render()
    {

        return view('livewire.shop.orders-component');
    }

    public function edit($active)
    {
        $this->active = $active;
    }

    public function setActive($item)
    {
        $this->active = $item;
    }

    public function update()
    {

        $item = OrderItem::find($this->active['id']);
        if ($item -> status == 'pending')
        {
            if ($this->code == $item['code'])
            {
                $item -> product ->decrement('quantity', 1);
                $item->status = 'completed';
                $item->save();
                $this->emit('accepted');
            }else{
                $item->status = 'rejected';
                $item->save();
                $this->emit('rejected');
            }
        }else{
            $this->emit('message','Code has been verified Already or does not Exist');
        }

        $this->code = '';

    }


    public function assignRider()
    {

        RiderDelivery::firstOrCreate(
            [
                'order_id'=> $this->active,
            ],
            [
            'order_id'=> $this->active,
            'rider_id'=> $this->rider,
            'status'=> RiderDelivaryStatus::PENDING,
            ]
        );

        $this->emit('message','Successfully assigned rider');
    }

    public function addToBatch()
    {

    }
}
