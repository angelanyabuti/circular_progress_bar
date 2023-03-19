<?php

namespace App\Http\Livewire;

use App\Models\Industry;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateShopComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $name,$description,$latitude, $longitude, $email, $phone,$logo, $active, $type, $user_id,$industry_id;
    public $industries =[];

    public function mount()
    {
        $this->industries = Industry::all();
    }
    public function render()
    {
        return view('livewire.create-shop-component')->layout('layouts.guest');
    }

    public function save($item)
    {
        $item ->uuid = (string) Str::uuid();;
        $item ->name = $this->name;
        $item ->description = $this->description;
        $item ->latitude = $this->latitude;
        $item ->longitude = $this->longitude;
        $item ->email = $this->email;
        $item ->industry_id = $this->industry_id;
        $item ->phone = $this->phone;
        $item ->company_id = Auth::user()->company_id;
        $item ->active = true;
        if ($this->logo != null)
        {
            $item->logo =$this->logo->store('shops','public');
        }
        $item ->save();

        $this->emit('created');

        $this->resetAll();

        return redirect()->route('shops');
    }

    public function resetAll()
    {
        $this->resetErrorBag();
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->longitude = '';
        $this->latitude = '';
        $this->description = '';
        $this->type = '';
        $this->industry_id = '';
        $this->logo = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'industry_id' => 'required',
            'email' => 'required|unique:shops',
            'phone' => 'required|unique:shops',
            'description' => 'required',
        ]);

        $shop = new Shop();
        $this->save($shop);
    }
}
