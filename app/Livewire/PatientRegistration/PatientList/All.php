<?php

namespace App\Livewire\PatientRegistration\PatientList;


use App\Models\PatientBilling;
use App\Models\TestPackageBill;
use Livewire\Attributes\On;
use Livewire\Component;

class All extends Component
{


    #[On('refresh-patient')]
    #[On('refresh-updated-bill')]
    public function render()
    {
      $patientDetails=PatientBilling::with('patient','testbill')->get();

        return view('livewire.patient-registration.patient-list.all',[
            'patientDetails' => $patientDetails
        ]);
    }
}
