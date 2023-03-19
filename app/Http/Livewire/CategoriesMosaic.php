<?php

namespace App\Http\Livewire;

use App\Models\ProductCategory;
use Livewire\Component;

class CategoriesMosaic extends Component
{

    public function render()
    {
        return view('livewire.categories-mosaic',[
            'categories'=> ProductCategory::take(6)->get()
        ]);
    }
}
