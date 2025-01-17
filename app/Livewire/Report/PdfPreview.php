<?php

namespace App\Livewire\Report;

use App\Models\PatientReport;
use Livewire\Attributes\On;
use Livewire\Component;

class PdfPreview extends Component
{
    public $patientId;
    public $bill_id;

    #[On('patient_details')]
    public function PatientDetails($data){
        $this->patientId=$data['patient_id'];
        $this->bill_id=$data['bill_id'];

        $patientDetialsPdf=PatientReport::where('patient_id',$this->patientId)->where('bill_id',$this->bill_id)->get();
        dd($patientDetialsPdf);
    }
    public function render()
    {
        return view('livewire.report.pdf-preview');
    }
}
