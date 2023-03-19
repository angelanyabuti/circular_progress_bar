<?php

namespace App\Http\Livewire\Market;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;
use Jorenvh\Share\ShareFacade;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product, $links;
    public function mount($product)
    {

     $this->product = $product;
    }
    public function render()
    {
        $this->links  =  ShareFacade::page(route('product', $this->product), $this->product ->name)
            ->facebook()
            ->twitter()
            ->linkedin($this->product ->description)
            ->whatsapp() ->getRawLinks();

        return view('livewire.market.product-details');
    }

    public function add()
    {
        $cart =  Cart::session(session()->getId());
        $cart->add(array(
            'row_id' => Str::random(5),
            'id' => $this->product ->id,
            'name' => $this->product->name,
            'price' => $this->product->price,
            'quantity' => 1,
            'associatedModel' => $this->product
        ));



        return redirect()->route('checkout');
    }
}
