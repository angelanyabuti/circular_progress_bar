<?php

namespace App\Http\Livewire\Market;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public function mount($product)
    {
     $this->product = $product;
    }
    public function render()
    {
       return view('livewire.market.add-to-cart');
    }
    public function session()
    {
        return session()->getId();
    }


}
