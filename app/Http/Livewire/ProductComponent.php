<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Shop;
use App\Scopes\ActiveProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $categories,$shop_id;
    public $quantity = 1, $image, $category, $name, $type, $description, $price = 0, $cost, $end_date;
        public  $option,$active, $start_date;
    public $mock_price=  0;
    public $images= [];
    public $search = '';
    public $perPage = 20 ;
    public $editMode = false;

    protected $listeners =['del'];
    public function mount($shop)
    {
        $this->shop_id = $shop;
        $this->categories = ProductCategory::select('id','name')->get();
    }
    public function render()
    {

        return view('livewire.product-component',[
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
        $this->price = 0;
        $this->mock_price = 0;
        $this->quantity = 0;
        $this->category = '';
        $this->type = '';
        $this->name = '';
        $this->end_date = '';
        $this->start_date = '';
        $this->description = '';
        $this->image = null;
    }



    public function store()
    {


        $this->validate([
            'name' =>'required',
            'quantity' =>'required',
            'type' =>'required',
            'category' =>'required',
            'image' =>'required',
            'description' =>'required',
        ]);



        $prod = new Product();
        $prod->cost = 0;
        $prod->price = $this->price;
        $prod->mock_price = $this->mock_price;
        $prod->quantity = $this->quantity;
        $prod->product_category_id = $this->category;
        $prod->name = $this->name;
        $prod->description = $this->description;
        $prod->shop_id = $this->shop_id;
        $prod->type = $this->type;
        $prod->end_date = $this->end_date;
        $prod->start_date = $this->start_date;
        $prod->save();


        if ($this->image != null) {

            $prod->addMediaFromString($this->image->get())
                ->usingFileName($this->image->getFilename())
                ->toMediaCollection('product');
        }


        $this->emit('created');

        $this->resetAll();

    }

    public function edit($id)
    {

        $pro = Product::find($id);

        $this->price = $pro ->price ;
        $this->mock_price = $pro ->mock_price ;
        $this->quantity = $pro ->quantity ;
        $this->category = $pro ->product_category_id;
        $this->name = $pro ->name;
        $this->end_date = $pro ->end_date;
        $this->start_date = $pro ->start_date;
        $this->type = $pro ->type;
        $this->description = $pro ->description;
        $this->option = '';
        $this->images = $pro->default_image;
        $this->active = $pro;
        $this->editMode = true;
    }

    public function setActive($id)
    {
        $this->active = Product::find($id);
    }

    public function update()
    {

        $this->validate([
            'name' =>'required',
            'price' =>'required',
            'quantity' =>'required',
            'type' =>'required',
            'category' =>'required',
            'description' =>'required',
        ]);
        $item = $this->active;
        $item->cost = 0;
        $item->price = $this->price;
        $item->mock_price = $this->mock_price;
        $item->quantity = $this->quantity;
        $item->product_category_id = $this->category;
        $item->name = $this->name;
        $item->description = $this->description;
        $item->shop_id = $this->shop_id;
        $item->type = $this->type;
        $item->end_date = $this->end_date;
        $item->start_date = $this->start_date;
        $item->save();


        if ($this->image != null) {
            $item->addMediaFromString($this->image->get())
                ->usingFileName($this->image->getFilename())
                ->toMediaCollection('product');
        }

        $this->emit('updated');
        $this->resetAll();
    }

    public function del()
    {
        $this->active ->delete();
        $this->emit('deleted');
    }
}
