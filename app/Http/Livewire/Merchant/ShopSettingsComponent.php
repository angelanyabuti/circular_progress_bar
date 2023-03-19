<?php

namespace App\Http\Livewire\Merchant;

use App\Models\ShopSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShopSettingsComponent extends Component
{
    public $name, $time, $state,  $activeItem;
    public $editMode = false;

    protected $listeners =['delete'];

    public function render()
    {
        return view('livewire.merchant.shop-settings-component',[
            'items'=>ShopSettings::where('shop_id',Auth::user()->shop_id)->orderBy('id', 'desc')->get()
        ]);
    }

    public function save()
    {
        $this->validate([
            'name'=>'required',
            'time'=>'required|date_format:H:i',
        ]);
        if ($this->editMode == true)
        {
            $this->update();
        }else
        {
            $item = new ShopSettings();
            $item -> shop_id = Auth::user()->shop_id;
            $item -> name = $this->name;
            $item -> time = $this->time;
            $item->save();
            $this->emit('created');
        }

        $this->clearFields();
    }

    public function clearFields()
    {
        $this->time = '';
        $this->name = '';
    }

    public function toggleActive($id)
    {
        DB::table('shop_settings')->where('shop_id',$id)->update(['active'=> $this->state]);
        $this->emit('message','State Changed successfully');
    }

    public function edit($item)
    {
        $this->time = $item['time'];
        $this->name = $item['name'];
        $this->activeItem = $item;
        $this->editMode = true;
    }

    public function update()
    {
        DB::table('shop_settings')->where('id', $this->activeItem['id'])->update([
            'name'=>$this->name,
            'time'=>$this->time,
        ]);
        $this->emit('updated');
    }

    public function setActive($item)
    {
        $this->activeItem = $item;
    }


    public function delete()
    {
        DB::table('shop_settings')->where('id', $this->activeItem['id'])->delete();
        $this->emit('deleted');
    }
}
