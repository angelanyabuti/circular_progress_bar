<?php

namespace App\Http\Livewire\Admin;

use App\Models\Industry;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IndustryComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $name,$description,$image, $parent, $active;
    public $search = '';
    public $parents = null;
    public $perPage = 20 ;
    public $editMode = false;
    protected $listeners =['delete'];
    public function render()
    {
        return view('livewire.admin.industry-component',[
            'industries'=> Industry::all()
        ]);
    }
    public function save($item)
    {

        $item ->name = $this->name;
        $item ->description = $this->description;

        if ($this->image != null)
        {
            $item->image =$this->image->store('product/industry','public');
        }
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
        $this->name = '';
        $this->image = '';
        $this->description = '';
        $this->active = '';
        $this->editMode = false;
    }

    public function edit($id)
    {
        $item =  Industry::find($id);
        $this->name = $item->name;
        $this->description = $item->description;
        $this->active = $item;
        $this->editMode = true;
    }

    public function store()
    {
        $shop = new Industry();
        $this->save($shop);
    }

    public function setActive($id)
    {
        $this->active = Industry::find($id);
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
}
