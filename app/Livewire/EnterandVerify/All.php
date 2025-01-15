<?php

namespace App\Livewire\EnterandVerify;

use App\Models\PatientBilling;
use Livewire\Component;

class All extends Component
{
    public function render()
    {  
        $patientDetails = PatientBilling::with('patient', 'testbill')->get();
        return view('livewire.enterand-verify.all',[
            'patientDetails' => $patientDetails
        ]);
    }
}
