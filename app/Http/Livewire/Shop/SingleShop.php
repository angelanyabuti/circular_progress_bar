<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Jorenvh\Share\Share;
use Jorenvh\Share\ShareFacade;
use Livewire\Component;

class SingleShop extends Component
{
    public $active;
    public $shop;
    public $website;
    public $perPage= 10;
    public $links = [];
    public function mount($shop)
    {

        $this->shop = $shop;
    }
    public function render()
    {

        return view('livewire.shop.single-shop',[
            'products'=> Product::where('shop_id', $this->shop ->id)
                ->with('shop','shop.company')
                ->active()
                ->simplePaginate($this -> perPage)

        ]);
    }

    public function show($item)
    {

        $this->active = $item;
        $this->website =  $active['shop']['company']['website'] ?? '#';
        $this -> links =  ShareFacade::page(route('product', $item['slug']), $item['name'])
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
        $uuid = Str::uuid();
        Session::put('basket',$uuid );
        $cart =  Cart::session($uuid);

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
