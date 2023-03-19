<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartComponent extends Component
{
    public $qty;
    public function render()
    {
        $cart = Cart::session(session()->getId());
        $items = $cart ->getContent();
        return view('livewire.shop.cart',[
            'items'=>$items,
            'cart'=>$cart
        ]);
    }

    public function updateQty($value)
    {
        dd($value);
    }

    public function delete($id)
    {
        $cart =  Cart::session(session()->getId());
        $cart->remove($id);
        $this->emit('updateCounter');
    }

    public function clear()
    {
        Cart::session(session()->getId())->clear();
    }
}
