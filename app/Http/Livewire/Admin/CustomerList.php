<?php

namespace App\Http\Livewire\Admin;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Maatwebsite\Excel\Facades\Excel;

class CustomerList extends Component
{
    public $search = '';
    public $perPage = 15;

    public $from ;
    public $to;
    public $range;

    use WithFileUploads, WithPagination;

    public function mount()
    {

            $this->from = now()->startOfDecade();
            $this->to = now();
            $this->range = now()->startOfDecade()->format('y-m-d')." - " . now()->format('y-m-d');

    }
    public function render()
    {
        $range = [
            'from'=> $this->from,
            'to'=> $this->to,
        ];
        return view('livewire.admin.customer-list',[
            'users' => User::search($this->search)
                ->where('type','customer')
                ->date($range)
                ->latest()
                ->simplePaginate($this->perPage)
        ]);
    }

    public function toggleActive($item)
    {

        $state = $item['status'];
        if ($state == 'pending')
        {
            $k = 'active';
        }else{
            $k = 'pending';
        }
        DB::table('users')->where('id', $item['id'])->update(['status' => $k]);
        $this->emit('message','Updated');
    }

    public function export()
    {
        $this->emit('message','Working on generating excel. Do not close this reload this tab');
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
