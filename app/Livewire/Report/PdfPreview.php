<?php

namespace App\Livewire\Report;

use App\Models\PatientBilling;
use App\Models\PatientReport;
use Livewire\Attributes\On;
use Livewire\Component;

class PdfPreview extends Component
{
    public $patientId;
    public $bill_id;
    public $patientDetialsPdf=[];
    public $user;

    #[On('patient_details')]
    public function PatientDetails($data){
        $this->patientId=$data['patient_id'];
        $this->bill_id=$data['bill_id'];

        $this->patientDetialsPdf=PatientReport::where('patient_id',$this->patientId)->where('bill_id',$this->bill_id)->get();
        
        $this->user = PatientBilling::find($this->bill_id);
    }
    public function render()
    {
        return view('livewire.report.pdf-preview');
    }
}
