<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Notifications\AccountCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $name,$first_name, $last_name, $email, $phone_number,$gender,$dob, $active, $role, $roles, $status, $plans, $plan;
    public $editMode = false;
    protected $listeners = ['reset' =>'resetAll','delete'=>'delete'];
    public $type = 'merchant';
    public $search = '';
    public $perPage = 15;

    public function mount()
    {
        $this->plans = app('rinvex.subscriptions.plan')->get();
        $this->roles = Role::all();
    }
    public function render()
    {
        return view('livewire.users-component',[
            'users' => User::search($this->search)
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
            'phone_number' => array(
                'required',
                'regex:/^(\+254|0)([7][0-9]|[1][0-1]){1}[0-9]{1}[0-9]{6}$/'
                ),
        ]);
    }

    public function save($user)
    {

        $this->val();
        $user ->first_name = $this->first_name;
        $user ->last_name = $this->last_name;
        $user ->email = $this->email;
        $user ->phone_number = $this->phone_number;
        $user ->type = $this->type;
        $user ->role_id = $this->role;
        $user ->status = $this->status;
        if ($this->editMode == false)
        {
            $user ->password = Hash::make(Str::random(16));
        }

        $user ->save();


        $this->emit('created');

        $this->resetAll();
    }

    public function store()
    {
        $user = new User();
        $this->save($user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->first_name = $user -> first_name;
        $this->last_name = $user -> last_name;
        $this->email = $user -> email;
        $this->phone_number = $user -> phone_number;
        $this->status = $user -> status;
        $this->type = $user -> type;
        $this->active = $user;
        $this->editMode = true;
    }

    public function setActive($id)
    {
        $this->active = User::find($id);
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
