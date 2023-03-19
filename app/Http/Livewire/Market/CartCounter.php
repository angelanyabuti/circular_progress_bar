<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners =['updateCounter'=> 'render','loggedIn'=> 'render'];
    public function render()
    {
        return view('livewire.market.cart-counter');
    }
}
