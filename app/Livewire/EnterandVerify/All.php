<?php

namespace App\Livewire\EnterandVerify;

use App\Models\PatientBilling;
use Livewire\Component;

class All extends Component
{
    public $search = '';
    public $filterStatus = '';
    public $filterDate = '';
    public function render()
    {


        $patientDetails = PatientBilling::with('patient', 'testbill')
            ->when($this->search, function ($query) {
                $query->whereHas('patient', function ($query) {
                    $query->whereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('mobile', 'like', '%' . $this->search . '%');
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

        return view('livewire.enterand-verify.all', [
            'patientDetails' => $patientDetails
        ]);
    }
}
