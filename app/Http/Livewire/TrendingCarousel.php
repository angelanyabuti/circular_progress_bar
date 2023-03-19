<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class TrendingCarousel extends Component
{
    public function render()
    {
        return view('livewire.trending-carousel',[
            'products'=> Product::take(12)->get()
        ]);
    }
}
