<?php

namespace App\Livewire\LabProfile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class All extends Component
{
    public $user;
    public function mount(){        
    $this->user=Auth::user();
     
    }
    public function render()
    {
        return view('livewire.lab-profile.all');
    }
}
