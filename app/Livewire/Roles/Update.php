<?php

namespace App\Livewire\Roles;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Update extends Component
{
    public $name;
    public $roleId;
    public $permissions = [];
    public $selectedPermissions = [];

    #[On('update-role')]
    public function edit($id)
    {

        $role = Role::findOrFail($id);

        $this->roleId = $role->id;
        $this->name = $role->name;

        $this->permissions = Permission::orderBy('name', 'ASC')->get();

        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
    }

    public function update()
    {

        $this->validate([
            'name' => 'required|string|min:3',
            'selectedPermissions' => 'nullable|array',
        ]);

        $role = Role::findOrFail($this->roleId);
        $role->update([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($this->selectedPermissions);
        $this->dispatch('reset-modal-role');
        $this->dispatch('refresh-roless');
        $this->dispatch('success', __("Role updated successfully!"));

    }
    public function render()
    {
        return view('livewire.roles.update');
    }
}
