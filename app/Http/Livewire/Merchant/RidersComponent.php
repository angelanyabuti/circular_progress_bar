<?php

namespace App\Http\Livewire\Merchant;

use App\Models\Logistic;
use App\Models\Rider;
use App\Models\User;
use App\Notifications\NewRider;
use App\Notifications\NewStaff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RidersComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $name,$first_name, $national_id, $last_name, $vehicle_registration, $vehicle_type, $email, $phone_number,$gender,$dob, $active, $role, $roles, $status, $plans, $plan;
    public $editMode = false;
    protected $listeners = ['reset' =>'resetAll','delete'=>'delete'];
    public $type = '';
    public $search = '';
    public $vTypes;
    public $perPage = 15;

    public function mount()
    {
        $this->vTypes = Logistic::all();
    }
    public function render()
    {
        return view('livewire.merchant.riders-component',[
            'users'=>User::where('company_id', Auth::user()->company_id)->has('rider')->get()
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
        $this->vehicle_registration = '';
        $this->vehicle_type = '';
        $this->editMode = false;
        $this->active = '';
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'vehicle_registration'=>'required',
            'national_id'=>'required',
            'phone_number'=>'required',
        ]);
        if ($this->editMode == true)
        {
            $user = $this->active;
        }else{
            $user = new User();
        }
        $user ->first_name = $this->first_name;
        $user ->last_name = $this->last_name;
        $user ->email = $this->email;
        $user ->phone_number = $this->phone_number;
        $user ->type = 'merchant';
        $user ->company_id = Auth::user()->company_id;
        $user ->status = 'active';
        if ($this->editMode == false)
        {
            $user ->password = Hash::make(Str::random(16));
        }
        $user ->save();

        /*rider records*/

        $rider =  new Rider();
        $rider ->user_id = $user->id;
        $rider ->vehicle_registration = $this->vehicle_registration;
        $rider ->vehicle_type = $this->vehicle_type;
        $rider ->company_id =  Auth::user()->company_id;
        $rider->save();

        $this->emit('created');

        $this->resetAll();

        $token = app('auth.password.broker')->createToken($user);
        $url = route('password.reset', $token);
        Notification::send($user, new NewRider($url));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->first_name = $user -> first_name;
        $this->last_name = $user -> last_name;
        $this->email = $user -> email;
        $this->phone_number = $user -> phone_number;
        $this->status = $user -> status;
        $this->vehicle_type =  $user ->rider -> vehicle_type;
        $this->vehicle_registration =  $user ->rider -> vehicle_registration;
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


    public function delete()
    {
        $this->active -> delete();
        $this->emit('deleted');
    }
}
