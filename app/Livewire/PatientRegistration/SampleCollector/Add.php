<?php

namespace App\Livewire\PatientRegistration\SampleCollector;

use App\Models\SampleCollector;
use Livewire\Component;

class Add extends Component
{
    public $name, $gender = 'male', $phone, $email;

    protected $rules = [
        'name' => 'required|string|max:255',
        'gender' => 'required|string',
        'phone' => 'required|digits:10',
        'email' => 'nullable|email|max:255',
    ];

    public function save()
    {
        $this->validate();


        SampleCollector::create([
            'name' => $this->name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);


        $this->reset(['name', 'gender', 'phone', 'email']);

        $this->dispatch('reset-modal-sample');
        $this->dispatch('refresh-modal-sampleCollector');
        

    }
    public function render()
    {
        return view('livewire.patient-registration.sample-collector.add');
    }
}
