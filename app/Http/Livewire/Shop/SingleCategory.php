<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use App\Models\ProductCategory;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;
use Jorenvh\Share\Share;
use Jorenvh\Share\ShareFacade;
use Livewire\Component;

class SingleCategory extends Component
{

    public $active;
    public $category;
    public $perPage= 10;
    public $image ;
    public $links ;
    public $website ;
    public $quantity = 1 ;
    public function mount($category)
    {

        $this->category = $category;
    }
    public function render()
    {

        return view('livewire.shop.single-category',[
            'products'=> Product::where('product_category_id', $this->category ->id)
                ->with('shop')
                ->active()
            ->simplePaginate($this -> perPage)
        ]);
    }

    public function show($item)
    {

        $this->active = $item;
        $this->website =  $active['shop']['company']['website'] ?? '#';
       $this -> links =  ShareFacade::page(route('product', $item['id']), $item['name'])
            ->facebook()
            ->twitter()
            ->linkedin($item['description'])
            ->whatsapp() ->getRawLinks();
        $data = [
            $item['id'],
            $item['end_date']
        ];
        $this->emit('re-calc', $data);
    }

    public function add()
    {
        $cart =  Cart::session(session()->getId());
        $cart->add(array(
            'row_id' => Str::random(5),
            'id' => $this->active['id'],
            'name' => $this->active['name'],
            'price' => $this->active['price'],
            'quantity' => 1,
            'associatedModel' => Product::find($this->active['id'])
        ));

        return redirect()->route('checkout');
    }
}
