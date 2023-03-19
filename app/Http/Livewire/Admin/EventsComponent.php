<?php

namespace App\Http\Livewire\Admin;

use App\Configs\Configs;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EventsComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $name,$description,$image, $active;
    public $search = '';
    public $perPage = 20 ;
    public $editMode = false;
    protected $listeners =['delete'];

    public function render()
    {
        return view('livewire.admin.events-component',[
            'events'=> Event::search($this->search)
                ->latest()
                ->simplePaginate($this->perPage)
        ]);
    }

    public function save($item)
    {

        $item ->name = $this->name;
        $item ->description = $this->description;
        if ($this->image != null)
        {
            $item->image =$this->image->store('product/events','public');
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
        $this->description = '';
        $this->image = '';
    }


    public function edit($id)
    {
        $event =  Event::find($id);
        $this->name = $event->name;
        $this->description = $event->description;
        $this->active = $event;
        $this->editMode = true;
    }

    public function store()
    {

        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $event = new Event();
        $this->save($event);
    }
    public function setActive($id)
    {
        $this->active = Event::find($id);
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
        if ($state == Configs::INACTIVE)
        {
            $k = Configs::ACTIVE_STATUS;
        }else{
            $k = Configs::INACTIVE;
        }
        DB::table('events')->where('id', $item['id'])->update(['status' => $k]);
        $this->emit('message','Updated');
    }

}
