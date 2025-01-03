<?php

namespace App\Livewire\Dashboard;

use App\Models\Package;
use App\Models\PatientBilling;
use App\Models\PatientRegistration;
use App\Models\Test;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {

        return view('livewire.dashboard.dashboard', 
        [
            'total_tests' => Test::count(),
            'total_packages' => Package::count(),
            'total_patients' => PatientRegistration::count(),
            'perform_test' => PatientBilling::count(),
    ]);
    }
}
