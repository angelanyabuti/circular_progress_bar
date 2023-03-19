<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class ListPayments extends Component
{
    use WithPagination;
    public $perPage= 10;
    public $search= '';
    public function render()
    {

        return view('livewire.admin.list-payments',[
            'payments'=>Payment::latest()->simplePaginate(10)
        ]);
    }
}
