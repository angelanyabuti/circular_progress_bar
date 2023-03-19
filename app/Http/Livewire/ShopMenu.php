<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShopMenu extends Component
{
    public $shop;
    public function mount($shop)
    {
        $this->shop = $shop;

    }
    public function render()
    {
        return view('livewire.shop-menu');
    }
}
