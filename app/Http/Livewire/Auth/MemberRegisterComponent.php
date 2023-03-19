<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class MemberRegisterComponent extends Component
{
    public  $profession;
    public function render()
    {
        return view('livewire.auth.member-register-component')->layout('layouts.index');
    }
}
