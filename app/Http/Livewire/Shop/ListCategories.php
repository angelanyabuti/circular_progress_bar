<?php

namespace App\Http\Livewire\Shop;

use App\Models\ProductCategory;
use Livewire\Component;

class ListCategories extends Component
{
    public $search = '';
    public $perPage = 10;
    public function render()
    {
        return view('livewire.shop.list-categories',[
            'categories'=> ProductCategory::search($this->search)
                 ->latest()
                ->with('products')
                ->simplePaginate($this->perPage)
        ]);
    }
}
