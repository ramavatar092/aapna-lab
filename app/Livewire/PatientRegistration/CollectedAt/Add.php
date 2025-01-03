<?php

namespace App\Livewire\PatientRegistration\CollectedAt;

use App\Models\CollectedAddress;
use Livewire\Attributes\On;
use Livewire\Component;

class Add extends Component
{

  
    public $newAddress = '';

    

    public function addAddress()
    {
        $this->validate([
            'newAddress' => 'required|string|max:255',
        ]);

      
        $address = CollectedAddress::create(['address' => $this->newAddress]);
        $this->dispatch('refresh-address');
        $this->newAddress = '';
    }

    public function removeAddress($id)
    {
        CollectedAddress::find($id)->delete();
        $this->dispatch('refresh-address');
    }
    #[On('refresh-address')]
    public function render()
    {
        $addresses = CollectedAddress::all();
        return view('livewire.patient-registration.collected-at.add',[
            'addresses' => $addresses,
        ]);
    }
}
