<?php

namespace App\Http\Livewire\Auth;

use App\Models\Plan;
use Livewire\Component;

class MerchantRegisterComponent extends Component
{
    public $plan;

    public function mount()
    {
        if (!(request()->get('plan') && Plan::whereSlug(request()->get('plan'))->first())) {
            return redirect()->route('auth.plans');
        }

        $this->plan = Plan::whereSlug(request()->get('plan'))->first()->id;
    }

    public function render()
    {

        return view('livewire.auth.merchant-register-component')->layout('layouts.index');
    }
}
