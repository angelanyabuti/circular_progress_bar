<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MerchantsComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $company_name, $name, $first_name, $last_name, $email, $company_email, $company_phone, $latitude, $longitude;
    public $phone_number, $gender, $dob, $active, $role, $roles, $status, $plans, $plan, $shop_description, $image;
    public $editMode = false;
    public $type = '';
    public $search = '';
    public $perPage = 15;
    protected $listeners = ['reset' => 'resetAll', 'delete' => 'delete'];


    public function mount()
    {
        $this->plans = app('rinvex.subscriptions.plan')->get();
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.merchants-component', [
            'users' => User::search($this->search)
                ->where('type', 'merchant')
                ->latest()
                ->simplePaginate($this->perPage)
        ]);
    }

    public function store()
    {
        $this->validate([
            'company_name' => 'required',
            'company_email' => 'required|email',
            'company_phone' => 'required',
            'name' => 'required',
            'latitude' => 'required||between:-90,90',
            'longitude' => 'required|between:-180,180',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users',
            'shop_description' => 'required',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            /*create company*/
            $comp = new Company();
            $comp->name = $this->company_name;
            $comp->email = $this->company_email;
            $comp->phone = $this->company_phone;
            $comp->save();

            /*create user*/
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            $user->type = 'merchant';
            $user->status = $this->status;
            $user->company_id = $comp->id;
            if ($this->editMode == false) {
                $user->password = Hash::make(Str::random(16));
            }
            $user->save();

            /*create shop*/
            $shop = new Shop();
            $shop->name = $this->company_name;
            $shop->company_id = $comp->id;
            $shop->description = $this->shop_description;
            $shop->latitude = $this->latitude;
            $shop->longitude = $this->longitude;
            $shop->save();

            /*create subscription*/

            if ($this->plan != null) {
                $plan = app('rinvex.subscriptions.plan')->find($this->plan);

                $comp->newSubscription('main', $plan);
            }

            DB::commit();

            $this->emit('message', 'Merchant Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->emit('error', 'We could not complete your request at this point, Kindly Try again later');
            Log::error($exception);
        }

    }

    public function setActive($item)
    {
       $this->active = $item;
    }

    public function toggleActive($item)
    {
        $state = $item['status'];
        if ($state == 'pending') {
            $k = 'active';
        } else {
            $k = 'pending';
        }
        DB::table('users')->where('id', $item['id'])->update(['status' => $k]);
        $this->emit('message', 'Updated');
    }

    public function delete()
    {
        User::destroy($this->active);
    }


}
