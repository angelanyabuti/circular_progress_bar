<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;
use Livewire\Component;

class InstoreCoupons extends Component
{
    public $active;
    public function render()
    {
        return view('livewire.shop.instore-coupons',[
            'products'=> Product::with('shop')->where('type','instore')->get()
        ]);
    }
    public function show($item)
    {
        $this->active = $item;
        $this->emit('re-calc', $item['end_date']);
    }


    public function add()
    {
        $cart =  Cart::session(session()->getId());
        $cart->add(array(
            'row_id' => Str::random(5),
            'id' => $this->active['id'],
            'name' => $this->active['name'],
            'price' => $this->active['price'],
            'quantity' => 1,
            'associatedModel' => Product::find($this->active['id'])
        ));

        return redirect()->route('checkout');
    }
}
