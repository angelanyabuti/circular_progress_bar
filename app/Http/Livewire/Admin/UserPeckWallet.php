<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserPeckWallet extends Component
{
    public $user;
    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        $wallet = Auth::user()->getWallet('peck-wallet');
        return view('livewire.admin.user-peck-wallet',[
            'items'=> Auth::user()
        ]);
    }
}
