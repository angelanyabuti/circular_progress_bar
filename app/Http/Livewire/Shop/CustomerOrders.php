<?php

namespace App\Http\Livewire\Shop;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerOrders extends Component
{
    public $transactions = [];
    public function render()
    {

        $orderIds = Order::where('customer_id', Auth::id())->pluck('id');

        $user = Auth::user();
        $wallet = $user->hasWallet('peck-wallet');

        if ($wallet) {
            $pw = $user->getWallet('peck-wallet');
        } else {
            $pw = $user->createWallet([
                'name' => 'peck Wallet',
                'slug' => 'peck-wallet',
            ]);
        }

        $this->transactions =   $pw -> transactions;



        return view('livewire.shop.customer-orders',[
            'items' => OrderItem::whereIn('order_id', $orderIds)->with('product')->latest()->get(),
            'pw'=>$pw
        ]);
    }
}
