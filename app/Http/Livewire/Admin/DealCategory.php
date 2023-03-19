<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DealCategory extends Component
{
    use WithPagination, WithFileUploads;
    public $name,$description,$image, $parent, $active;
    public $search = '';
    public $parents = null;
    public $perPage = 10 ;
    public $editMode = false;
    protected $listeners =['delete'];
    public function render()
    {
        return view('livewire.admin.deal-category',[
            'categories'=> ProductCategory::search($this->search)
                ->where('parent_id', '!=',null)
                ->latest()
                ->simplePaginate($this->perPage)
        ]);
    }
    public function save($item)
    {

        if ($this->parent == '')
        {
            $this->parent = null;
        }
        $item ->name = $this->name;
        $item ->description = $this->description;
        $item ->parent_id = $this->parent;

        if ($this->image != null)
        {
            $item->image =$this->image->store('product/category','public');
        }
        $item ->save();

        if ($this->editMode == true)
        {
            $this->emit('mess', ['mess'=>'Deal Category Updated ','modal'=>'#dealModal']);
        }else{
            $this->emit('mess', ['mess'=>'Deal Category Created ','modal'=>'#dealModal']);
        }
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->resetErrorBag();
        $this->name = '';
        $this->parent = '';
        $this->image = '';
        $this->description = '';
        $this->active = '';
        $this->editMode = false;
    }

    public function edit($id)
    {
        $item =  ProductCategory::find($id);
        $this->name = $item->name;
        $this->parent = $item->parent_id;
        $this->description = $item->description;
        $this->active = $item;
        $this->editMode = true;
    }

    public function store()
    {
        $shop = new ProductCategory();
        $this->save($shop);
    }

    public function setActive($id)
    {
        $this->active = ProductCategory::find($id);
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
