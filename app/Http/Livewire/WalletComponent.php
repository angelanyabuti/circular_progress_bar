<?php

namespace App\Http\Livewire;

use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WalletComponent extends Component
{
    public $perPage = 30;
    public $amount;
    public function render()
    {

        return view('livewire.wallet-component');
    }

    public function deposit()
    {
        Auth::user()->depositFloat($this->amount);
    }

    public function withdraw()
    {
        $this->validate([
            'amount'=> 'required'
        ]);

        $bal = Auth::user()->balance;
        if ($this->amount > $bal )
        {
            $this->emit('error','Sorry Your balance is insufficient');
            return 0;
        }

        $wr = new WithdrawRequest();
        $wr->amount = $this->amount;
        $wr->wallet_id = Auth::id();
        $wr ->save();

//        Auth::user()->withdrawFloat($this->amount);

    }
}
