<?php

namespace App\Http\Livewire\Admin;

use App\Models\OrderItem;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersComponent extends Component
{
    use WithPagination;
    public $perPage = 10;
    public function render()
    {
        return view('livewire.admin.orders-component',[
            'orders' => OrderItem::latest()->simplePaginate($this->perPage)
        ]);
    }
}
