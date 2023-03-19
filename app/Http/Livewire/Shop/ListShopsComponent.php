<?php

namespace App\Http\Livewire\Shop;

use App\Models\Shop;
use Livewire\Component;

class ListShopsComponent extends Component
{
    public $search = '';
    public $perPage = 20;
    public function render()
    {
        return view('livewire.shop.list-shops-component',[
            'shops' => Shop::search($this->search)
                ->latest()
                ->with(['products'=> function ($q) {
                    $q ->active();
                }])
                ->has('products')
                ->simplePaginate($this->perPage)
        ]);
    }
}
