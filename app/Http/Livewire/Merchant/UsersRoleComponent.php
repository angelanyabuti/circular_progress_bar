<?php

namespace App\Http\Livewire\Merchant;

use App\Models\CompanyRole;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UsersRoleComponent extends Component
{

    use WithPagination;
    public $name,$description, $active;
    public $permissions = [];
    public $editMode = false;
    public $search = '';
    public $perPage = 15;
    protected $listeners = ['reset' =>'resetAll','delete'=>'delete'];
    public function render()
    {
        return view('livewire.merchant.users-role-component',[
            'roles' => CompanyRole::search($this->search)
                ->where('company_id', Auth::user()->company_id)
                ->latest()
                ->simplePaginate($this->perPage),
            'perms' => config('permissions.merchants')
        ]);
    }

    public function resetAll()
    {
        $this ->name = '';
        $this ->description = '';
        $this ->permissions = '';
        $this ->active = '';
        $this->editMode = false;
    }
    public function val()
    {
        $this->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
    }

    public function save($role)
    {
        $this->val();
        $role ->name = $this->name;
        $role ->description = $this->description;
        $role ->permissions = $this->permissions;
        $role -> save();
        $this->emit('role_created');
        $this->resetAll();
    }

    public function store()
    {

        $role = new CompanyRole();
        $role -> company_id = Auth::user()->company_id;
        $this->save($role);
    }

    public function update()
    {
        $this->save($this->active);

    }

    public function edit($id)
    {
        $role = CompanyRole::find($id);
        $this->name = $role->name;
        $this->description = $role->description;
        $pems = [];
        foreach ($role ->permissions as $k)
        {
            $pems[] = $k;
        }
        $this->permissions = $pems;
        $this->name = $role->name;
        $this->active = $role;
        $this->editMode = true;
    }

    public function setActive($id)
    {
        $this->active = Role::find($id);
    }

    public function delete()
    {
        $this->active->delete();
        $this->resetAll();
        $this->emit('role_deleted');
    }
}
