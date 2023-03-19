<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Scopes\ActiveProduct;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage= 15;
    public $search= '';

    public function render()
    {
        return view('livewire.admin.products',[
            'products'=> Product::search($this->search)
                ->latest()
                ->with('shop')
                ->paginate($this->perPage)
        ]);
    }
}
