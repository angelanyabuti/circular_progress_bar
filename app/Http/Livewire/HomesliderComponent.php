<?php

namespace App\Http\Livewire;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class HomesliderComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $description, $image,$url, $title, $active;
    public $editMode = false;
    public $perPage = 15;
    public $search = '';

    public function render()
    {
        $sliders =HomeSlider::search($this->search)
            ->latest()
            ->simplePaginate($this->perPage);

        return view('livewire.homeslider-component',[
            'sliders'=> $sliders
        ]);
    }

    public function save()
    {
        $this->validate([
            'url'=>'required|url',
            'title'=>'required',
            'image'=>'required',
        ]);
        if ($this->editMode ==  true)
        {
            $item = $this->active;
        }else{
            $item = new HomeSlider();
        }
        $item -> title = $this->title;
        $item -> url = $this->url;
        $item -> description = $this->description;
        if ($this->image != null)
        {
            $item->image = $this->image->store('sliders','public');
        }

        $item -> save();
        $this->emit('created');

        $this->resetAll();
    }

    public function resetAll()
    {
        $this->active = null;
        $this->title = null;
        $this->image = null;
        $this->url = null;
        $this->description = null;
        $this->editMode = false;
    }


    public function setActive($id)
    {
        $this->active = HomeSlider::find($id);
    }

    public function edit($id)
    {
        $k = HomeSlider::find($id);
        $this->title = $k ->title;
        $this->description = $k ->description;
        $this->title = $k ->title;
        $this->url = $k ->url;
        $this->editMode = true;
        $this->active = $k;


    }

    public function delete()
    {
        $this->active -> delete();
    }
}
