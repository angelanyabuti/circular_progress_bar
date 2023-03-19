<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CashierDashbaord extends Component
{
    public $code;
    public $cashier;


    public function render()
    {
        $cashier = Auth::user();
        return view('livewire.cashier-dashbaord');
    }


    public function vak()
    {
        $item = OrderItem::where('code', $this->code)->first();
        if ($item instanceof OrderItem)
        {
            if ($item -> status == 'pending')
            {
                if ($this->code == $item->code)
                {
                    $item -> product ->decrement('quantity', 1);
                    $item->status = 'completed';
                    $item->save();
                    $this->emit('accepted');
                }else{
                    $item->status = 'rejected';
                    $item->save();
                    $this->emit('rejected');
                }
            }else{
                $this->emit('message','Code has been verified Already or does not Exist');
            }
        }

        $this->emit('message','Code has been verified Already or does not Exist');
        $this->code = '';
    }
}
