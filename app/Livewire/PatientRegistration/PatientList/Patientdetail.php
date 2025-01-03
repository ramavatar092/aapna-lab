<?php

namespace App\Livewire\PatientRegistration\PatientList;

use App\Models\PatientBilling;
use App\Models\PatientRegistration;
use App\Models\User;
use Livewire\Component;

class Patientdetail extends Component
{
    public  $patientbillingDetails;
    public $patientDetail;
    public function mount($id){
         
        $this->patientbillingDetails=PatientBilling::where('patient_id', $id)->get();
        $this->patientDetail=PatientRegistration::find($id)->with('user','patientbilling')->first();

      

       
       
      
    }
    public function render()
    {
        return view('livewire.patient-registration.patient-list.patientdetail');
    }
}
