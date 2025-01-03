<?php

namespace App\Livewire\PatientRegistration\PatientList;

use App\Models\CollectedAddress;
use App\Models\Organisation;
use App\Models\PatientBilling;
use App\Models\PatientRegistration;
use App\Models\SampleCollector;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{  public $designation, $firstname, $lastname, $mobile, $gender, $age, $age_type, $email, $address;
    public $sampleCollector, $organisation, $collectedat, $b2bCenter;
    public $userId;
    public $patientBillId;
    public $patientId;
    #[On('update-patient')]
    public function edit($id){
        $patientDetail=PatientBilling::find($id)->with('patient')->first();
       
        $this->designation = $patientDetail->patient->designation;
        $this->userId=$patientDetail->patient->user_id;//for updating  user details
        $this->patientBillId=$patientDetail->id;//for updating  patient billing details
        $this->patientId=$patientDetail->patient_id;
        $this->firstname = $patientDetail->patient->user->name;
        $this->lastname = $patientDetail->patient->user->lastname;
        $this->mobile = $patientDetail->patient->user->mobile;
        $this->address=$patientDetail->patient->address;
        $this->age = $patientDetail->patient->age;
        $this->age_type = $patientDetail->patient->age_type;
        $this->email = $patientDetail->patient->user->email;
        $this->gender = $patientDetail->patient->user->gender;
        $this->collectedat = $patientDetail->collectedat;
        $this->organisation = $patientDetail->organisation;
        $this->sampleCollector = $patientDetail->sampleCollector;
      
       
    }

    public function updatePatient(){
        User::find($this->userId)->update([
            'name'=>$this->firstname,
            'lastname'=>$this->lastname,
            'mobile'=>$this->mobile,
            'email'=>$this->email,
        ]);

        PatientRegistration::find($this->patientId)->update([
            'designation'=>$this->designation,
            'age'=>$this->age,
            'age_type'=>$this->age_type,]);

        PatientBilling::find($this->patientBillId)->update([
            'sampleCollector'=>$this->sampleCollector,
            'organisation'=>$this->organisation,
            'collectedat'=>$this->collectedat,
           
        ]);
        $this->dispatch('success',__('patient update successfully'));
        $this->dispatch('reset-modal-patientdetail');
        $this->dispatch('refresh-patient');
    }
    public function render()
    {
        $data['collectAt']= CollectedAddress::all();
        $data['organisationlist'] = Organisation::all();
        $data['sampleCollectorlist'] = SampleCollector::all();
        return view('livewire.patient-registration.patient-list.update',$data);
    }
}
