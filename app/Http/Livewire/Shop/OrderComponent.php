<?php

namespace App\Http\Livewire\Shop;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\AccountCreated;
use App\Notifications\NewOrderNotificaton;
use App\Services\MpesaService;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;
use SmoDav\Mpesa\Laravel\Facades\STK;

class OrderComponent extends Component
{
    public $first_name, $last_name,$email,$phone,$postal_code,$address,$country,$town,$state, $city, $order_details;
    public $mpesa_number;

    public function render()
    {
        return view('livewire.shop.order-component');
    }

    public function order()
    {





    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->email = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->address = '';
        $this->city = '';
        $this->country = '';
        $this->postal_code = '';
        $this->phone = '';
    }

    public function pay()
    {
        $this->validate([
            'mpesa_number'=> 'required'
        ]);

        $mpsa = new MpesaService();
        $mpsa->push($this->order_details->amount, $this->phone);
    }
}
