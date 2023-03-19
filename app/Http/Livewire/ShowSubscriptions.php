<?php

namespace App\Http\Livewire;

use App\Models\Subscription;
use Livewire\Component;

class ShowSubscriptions extends Component
{
    public $search, $perPage;
    public function render()
    {
        return view('livewire.show-subscriptions',[
            'subscriptions' =>Subscription::all()
        ]);
    }
}
