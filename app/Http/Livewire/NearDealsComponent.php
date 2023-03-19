<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;
use Livewire\Component;

class NearDealsComponent extends Component
{
    public $products =[];
    public $active;
    public function render()
    {
        return view('livewire.near-deals-component');
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
