<?php

namespace App\Livewire\Permission;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission as PermissionModel;
use Livewire\WithPagination;

class All extends Component
{
    use WithPagination;


    public $searchTerm = ''; // For storing the search input value.

    #[On('goOn-Delete-per')]
    public function destroy( $id)
    {
        $permisssion=PermissionModel::findOrFail($id);
        $permisssion->delete();
        $this->dispatch('refresh-Permission');

        $this->dispatch('success', __("permission deleted successfully"));

    }

    #[On('refresh-Permission')]
    public function render()
    {
       // Search and paginate permissions
       $permissions = PermissionModel::where('name', 'like', '%' . $this->searchTerm . '%')
       ->orderBy('id', 'desc')
       ->paginate(10); // Customize the number of items per page if needed.

        return view('livewire.permission.all', [
            'permissionlist' => $permissions,
        ]);
    }
}
