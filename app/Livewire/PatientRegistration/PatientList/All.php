<?php

namespace App\Livewire\PatientRegistration\PatientList;


use App\Models\PatientBilling;
use App\Models\TestPackageBill;
use Livewire\Attributes\On;
use Livewire\Component;

class All extends Component
{
    public $search = '';
    public $filterStatus = '';
    public $filterDate = '';



    #[On('refresh-patient')]
    #[On('refresh-updated-bill')]
    public function render()
    {

        $patientDetails = PatientBilling::with('patient', 'testbill')
            ->when($this->search, function ($query) {
                $query->whereHas('patient', function ($query) {
                    $query->whereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->search. '%')
                            ->orWhere('mobile', 'like', '%' . $this->search. '%');
                    });
                       
                });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterDate, function ($query) {
                $query->whereDate('date', $this->filterDate);
            })
            ->get();

        return view('livewire.patient-registration.patient-list.all', [
            'patientDetails' => $patientDetails,
        ]);
    }
}
