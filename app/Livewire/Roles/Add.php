<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Add extends Component
{
    public $name;
    public $selectedPermissions = [];
    public $permissions ;

    public function mount()
    {
        $this->permissions = Permission::orderBy('name', 'ASC')->get();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:roles,name',
            'selectedPermissions' => 'nullable|array|min:1',
        ];
    }

    public function store()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        if (!empty($this->selectedPermissions)) {
            $role->syncPermissions($this->selectedPermissions);
        }
        else{
            $role->syncPermissions([]); 
        }

        $this->dispatch(event: 'reset-modal-role');
        $this->dispatch('refresh-roless');
        $this->dispatch('success', __("Role added successfully!"));

        $this->reset(['name', 'selectedPermissions']);
    }
    

    public function render()
    {
        return view('livewire.roles.add');
    }

}
