<?php

namespace App\Http\Livewire\Admin;

use App\Models\Agent;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AgentsComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $name,$first_name, $last_name, $email, $phone_number,$gender,$address, $active, $bio, $status, $longitude, $latitude;
    public $editMode = false;
    protected $listeners = ['reset' =>'resetAll','delete'=>'delete'];
    public $search = '';
    public $perPage = 15;
    public function render()
    {
        dd( Product::where('product_category_id', 15)->get());
        return view('livewire.admin.agents-component',[
            'users'=> Agent::search($this->search)
                ->with('user')
                ->latest()
                ->simplePaginate($this->perPage)
        ]);
    }

    public function resetAll()
    {
        $this->dob = '';
        $this->name = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->editMode = false;
        $this->active = '';
        $this->resetErrorBag();
    }

    public function val()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
//            'bio' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
    }

    public function save($user)
    {

        $this->val();


       $user =  User::updateOrCreate(
           [
               'email'=> $this->first_name,
           ],
           [
               'first_name'=> $this->first_name,
               'last_name'=> $this->first_name,
               'email'=> $this->first_name,
               'phone_number'=> $this->first_name,
               ]
       );

       $agent = Agent::updateOrCreate(
           [
               'user_id'=> $user->id
           ],
           [
               'bio'=> $this->bio,
               'longitude'=> $this->longitude,
               'latitude'=> $this->latitude,
               'address'=> $this->address,
           ]
       );

        $this->emit('created');

        $this->resetAll();
    }

    public function store()
    {
        $user = new Agent();
        $this->save($user);
    }

    public function edit($id)
    {
        $user = Agent::find($id);
        $this->first_name = $user->user -> first_name;
        $this->last_name = $user ->user -> last_name;
        $this->email = $user ->user -> email;
        $this->phone_number = $user ->user -> phone_number;
        $this->status = $user -> status;
        $this->bio = $user -> bio;
        $this->active = $user;
        $this->editMode = true;
    }

    public function setActive($id)
    {
        $this->active = Agent::find($id);
    }

    public function toggleActive($item)
    {

        $state = $item['status'];
        if ($state == false)
        {
            $k =  true;
        }else{
            $k = false;
        }
        DB::table('agents')->where('id', $item['id'])->update(['status' => $k]);
        $this->emit('message','Updated');
    }

    public function update()
    {
        $this->save($this->active);
    }

    public function delete()
    {
        $this->active -> delete();
        $this->emit('deleted');
    }
}
