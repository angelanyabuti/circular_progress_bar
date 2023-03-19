<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserLogin extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.user-login');
    }

    public function login()
    {

        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            $this->emit('loggedIn');
        }else{
            $this->emit('failLog');
        }


    }
}
