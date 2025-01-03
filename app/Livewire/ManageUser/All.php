<?php

namespace App\Livewire\ManageUser;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class All extends Component
{
    
    public $users;

    #[On('refresh-user')]
    public function mount(){
        $this->users=User::get();
    }

    #[On('goOn-Delete-user')]
    public function destroy($id){
        User::find($id)->delete();
        $this->dispatch('success', __("User deleted successfully"));
       
    }
    public function render()
    {
        return view('livewire.manage-user.all');
    }
}
