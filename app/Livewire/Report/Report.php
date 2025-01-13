<?php

namespace App\Livewire\Report;

use App\Models\PatientBilling;
use Livewire\Component;


class Report extends Component
{
    public $patientDetails;

    public function mount($id){

        $this->patientDetails=PatientBilling::find($id)->with('patient', 'testbill')->get();
       
    }
    public function render()
    {
        return view('livewire.report.report');
    }
}
