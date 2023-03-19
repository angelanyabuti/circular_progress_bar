<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeComponent extends Component
{
    public $kids = [];
    public $active;
    public $products;
    public $active_category;

    public function render()
    {
        $cats = ProductCategory::where('parent_id', null)->limit(10)->get();

        return view('livewire.home-component', [
            'categories' => $cats
        ]);
    }

    public function getKids($item)
    {

        $this->active = $item;
        $this->kids = ProductCategory::
        has('products')->
        where('parent_id', $item['id'])->get();
        if ($this->kids -> count() == 0)
        {

           $this->getProducts($item);
        }
    }

    public function getProducts($item)
    {
        $this->active_category = $item;
        $this->products = Product::where('product_category_id', $item['id'])
            ->latest()
            ->active()
            ->with('shop')
            ->take(5)
            ->get();
    }
}
