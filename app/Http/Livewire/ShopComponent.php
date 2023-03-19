<?php

namespace App\Http\Livewire;

use App\Models\Industry;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $name,$description,$latitude, $longitude, $email, $phone,$logo, $active, $type, $user_id;
    public $search = '';
    public $perPage = 20 ;
    public $editMode = false;
    protected $listeners =['delete'];
    public $industry_id;

    public function mount()
    {
        $this ->industries = Industry::select('name', 'id')->orderBy('name', 'ASC')->get();

    }
    public function render()
    {

        if (Auth::user() ->type != 'internal')
        {

            $shops = Shop::search($this->search)
                ->with('company')
                ->where('company_id', Auth::user()-> company_id)
                ->latest()
                ->simplePaginate($this->perPage);
        }else{
            $shops = Shop::search($this->search)
                ->latest()
                ->simplePaginate($this->perPage);
        }

        return view('livewire.shop-component',[
            'shops'=>  $shops
        ]);
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
        $this->phone = '';
        $this->email = '';
        $this->longitude = '';
        $this->latitude = '';
        $this->description = '';
        $this->type = '';
        $this->logo = null;
        $this->active = '';
        $this->editMode = false;
    }

    public function edit($id)
    {
       $shop =  Shop::find($id);
       $this->name = $shop->name;
       $this->phone = $shop->phone;
       $this->email = $shop->email;
       $this->longitude = $shop->longitude;
       $this->latitude = $shop->latitude;
       $this->description = $shop->description;
       $this->industry_id = $shop->industry_id;
       $this->active = $shop;
       $this->editMode = true;
    }

    public function store()
    {


        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'industry_id' => 'required',
            'description' => 'required',
        ]);

        $shop = new Shop();
        $this->save($shop);
    }

    public function setActive($id)
    {
        $this->active = Shop::find($id);
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
        DB::table('users')->where('id', $item['id'])->update(['status' => $k]);
        $this->emit('message','Updated');
    }
}
