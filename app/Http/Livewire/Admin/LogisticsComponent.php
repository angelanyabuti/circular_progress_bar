<?php

namespace App\Http\Livewire\Admin;

use App\Models\Event;
use App\Models\Logistic;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LogisticsComponent extends Component
{
    use WithPagination;
    public $vehicle_type,$base_price,$price_per_km, $active;
    public $search = '';
    public $perPage = 20 ;
    public $editMode = false;
    public $sortField;
    public $sortAsc = true;
    protected $listeners =['delete'];
    protected $queryString = ['search', 'active', 'sortAsc', 'sortField'];

    public function render()
    {
        return view('livewire.admin.logistics-component',[
            'items' => Logistic::where(function ($query) {
                $query->where('vehicle_type', 'like', '%' . $this->search . '%');
            })
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })->paginate($this->perPage),
        ]);
    }
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save($item)
    {

        $item ->vehicle_type = $this->vehicle_type;
        $item ->base_price = $this->base_price;
        $item ->price_per_km = $this->price_per_km;
        $item ->save();

        if ($this->editMode == true)
        {
            $this->emit('updated');
        }else{
            $this->emit('created');
        }

        $this->resetAll();
    }

    public function resetAll()
    {
        $this->resetErrorBag();
        $this->price_per_km = '';
        $this->base_price = '';
        $this->vehicle_type = '';
    }


    public function edit($id)
    {
        $item =  Logistic::find($id);
        $this->price_per_km = $item->price_per_km;
        $this->base_price = $item->base_price;
        $this->vehicle_type = $item->vehicle_type;
        $this->active = $item;
        $this->editMode = true;
    }

    public function store()
    {

        $this->validate([
            'vehicle_type' => 'required',
            'base_price' => 'required',
            'price_per_km' => 'required',
        ]);

        $event = new Logistic();
        $this->save($event);
    }
    public function setActive($id)
    {
        $this->active = Logistic::find($id);
    }
    public function update()
    {
        $this->save($this->active);
    }

    public function delete()
    {
        $this->active->delete();
        $this->resetAll();
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
        DB::table('logistics')->where('id', $item['id'])->update(['status' => $k]);
        $this->emit('message','Updated');
    }
}
