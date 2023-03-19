<?php

namespace App\Http\Livewire\Merchant;

use Livewire\Component;

class Messaging extends Component
{
    public $shop_id;
    public function mount($shop)
    {
        $this->shop_id = $shop;
    }
    public function render()
    {
        return view('livewire.merchant.messaging');
    }
}
