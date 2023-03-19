<?php

namespace App\Http\Livewire\Shop;

use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class Categories extends Component
{
    public $perPage = 20;
    public $search = '';
    public function render()
    {
        return view('livewire.shop.categories',[
            'categories'=> Industry::search($this->search)->latest()
                ->has('shops')
                ->orderBy('name', 'ASC')
                ->with('shops', function ($query){
                    $query ->has('products');
                })
                ->simplePaginate($this->perPage)
        ]);
    }
}
