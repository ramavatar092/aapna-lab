<?php

namespace App\Livewire\Roles;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;


class All extends Component
{
    use WithPagination;



    public $searchTerm;

    #[On('goOn-Delete-role')]
    public function destroy($id){
        Role::find($id)->delete();
        $this->dispatch('refresh-roles');
    }

    #[On('refresh-roless')]
    public function render()
    {
      
        $roles = Role::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);

        return view('livewire.roles.all', ['roless' => $roles]);
    }
}
