<?php

namespace App\Http\Livewire\Admin;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CompaniesComponent extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $name, $email,$longitude,$latitude, $phone, $address, $website, $country, $language, $timezone, $currency;
    public $editMode = false;
    protected $listeners = ['reset' =>'resetAll','delete'=>'delete'];
    public $type = '';
    public $search = '';
    public $perPage = 15;

    public function render()
    {
        return view('livewire.admin.companies-component',[
            'companies' => Company::search($this->search)
                ->latest()
                ->simplePaginate($this->perPage)
        ]);
    }

    public function setActive($id)
    {
        $this->active = Company::find($id);
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

}
