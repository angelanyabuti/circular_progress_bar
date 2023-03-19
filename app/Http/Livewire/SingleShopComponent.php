<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Livewire\Component;

class SingleShopComponent extends Component
{
    public  $shop, $orders=0, $product_count =0, $riders;
    public function mount($shop)
    {

        $this->shop = Shop::where('slug',$shop)->first();
        $this->product_count = Product::where('shop_id',$this->shop ->id)->count();
        $this->orders  = OrderItem::where('shop_id', $this->shop ->id)->get();
    }

    public function render()
    {

        return view('livewire.single-shop-component');
    }
}
