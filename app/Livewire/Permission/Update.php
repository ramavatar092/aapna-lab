<?php

namespace App\Livewire\Permission;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission as PermissionModel;

class Update extends Component
{
    public $name;
    public $id;

    #[On('update-permission')]
    public function edit($id)
    {
        $permission=PermissionModel::findOrFail($id);
        $this->id=$permission->id;
        $this->name=$permission->name;

    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:3',
        ]);

        $permission = PermissionModel::findOrFail($this->id);
        $permission->update([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        $this->reset('name');

        $this->dispatch('reset-modal-per');
        $this->dispatch('refresh-Permission');
        $this->dispatch('success', __("Permission updated successfully!"));


    }

    public function render()
    {
        return view('livewire.permission.update');
    }
}
