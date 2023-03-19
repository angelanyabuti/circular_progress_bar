<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class RiderProfileComponent extends Component
{
    public $rider;
    public function mount($id)
    {
        $this->rider = User::find($id);
    }
    public function render()
    {
        return view('livewire.rider-profile-component');
    }
}
