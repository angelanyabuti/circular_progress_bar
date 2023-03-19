<?php

namespace App\Http\Livewire\Merchant;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Scopes\ActiveProduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductsComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $categories,$shop_id;
    public $quantity, $category, $name, $description, $price, $cost,$end_date = null, $option,$active;
    public $images= [];
    public $search = '';
    public $perPage = 20 ;
    public $editMode = false;

    protected $listeners =['delete'];

    public function mount($shop)
    {
        $this->shop_id = $shop;
        $this->categories = ProductCategory::all();
    }
    public function render()
    {
        return view('livewire.merchant.products-component',[
            'products'=> Product::search($this->search)
                ->withoutGlobalScope(ActiveProduct::class)
                ->where('shop_id','=', $this->shop_id)
                ->latest()
                ->with('shop')
                ->simplePaginate($this->perPage)
        ]);
    }
    public function resetAll()
    {
        $this->cost = 0;
        $this->price = 0 ;
        $this->quantity = 0 ;
        $this->category = '';
        $this->name = '';
        $this->end_date = '';
        $this->description = '';
        $this->options = '';
        $this->images = [];
    }

    public function save()
    {


        $item = new Product();
        $item->cost = $this->cost;
        $item->price = $this->price;
        $item->quantity = $this->quantity;
        $item->product_category_id = $this->category;
        $item->name = $this->name;
        $item->description = $this->description;
        $item->shop_id = $this->shop_id;
        $item->end_date = $this->end_date;
        $item->save();

        foreach ($this->images as $img) {
            $image = new ProductImage();
            $image->product_id = $item->id;
            $image->url =$img->store('products','public');
            $image->save();
        }
        if($this->editMode ==  true)
        {
            $this->emit('updated');
        }else
        {
            $this->emit('created');
        }
        $this->resetAll();


    }

    public function store()
    {
        $this->save();
    }

    public function edit($id)
    {
        $pro = Product::find($id);
        $this->cost = $pro ->cost;
        $this->price = $pro ->price ;
        $this->quantity = $pro ->quantity ;
        $this->category = $pro ->category_id;
        $this->name = $pro ->name;
        $this->end_date = $pro ->end_date;
        $this->description = $pro ->description;
        $this->option = '';
        $this->images = [];
        $this->active = $pro;
        $this->editMode = true;
    }

    public function setActive($id)
    {
        $this->active = Product::find($id);
    }

    public function delete()
    {
        $this->active ->delete();
        $this->emit('deleted');
    }
}
