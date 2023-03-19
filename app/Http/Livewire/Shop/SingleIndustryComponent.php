<?php

namespace App\Http\Livewire\Shop;

use App\Models\Industry;
use App\Models\Shop;
use Livewire\Component;

class SingleIndustryComponent extends Component
{
    public $industry;

    public function mount($industry)
    {
        $this->industry = Industry::find($industry);
    }
    public function render()
    {

        return view('livewire.shop.single-industry-component',[
            'shops'=> Shop::where('type', $this->industry->id)
                ->has('products')
                ->orderBy('name', 'ASC')
                ->with(['products'=> function($q){
                    $q->active();
                }])
                ->simplePaginate(15)
        ])->layout('layouts.index');
    }
}
