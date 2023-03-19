<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class SubscribeComponent extends Component
{
    public $plans;

    public function mount()
    {
        $this->plans = Plan::all();
    }
    public function render()
    {
        return view('livewire.subscribe-component')->layout('layouts.index');
    }
}
