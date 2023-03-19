<?php

namespace App\Http\Livewire\Market;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        return view('livewire.market.products',[
            'products'=>Product::all()
        ]);
    }
}
