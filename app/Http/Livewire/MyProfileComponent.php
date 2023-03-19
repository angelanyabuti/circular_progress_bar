<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyProfileComponent extends Component
{
    public function render()
    {
        return view('livewire.my-profile-component')->layout('layouts.index');
    }
}
