<?php

namespace App\Livewire\Registration;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Add extends Component
{
    public $designation;
    public $firstname;
    public $lastname;
    public $mobile;
    public $gender;
    public $address;
    public $email;
    public $age;
    public $age_type;

    public function rules()
    {
        return [
            'designation'   => 'required',
            'firstname'     => 'required|string',
            'lastname'      => 'required|string',
            'mobile'        => 'required|integer|digits:10|unique:registrations',
            'gender'        => 'required|string',
            'address'       => 'required|string',
            'email'         => 'nullable|string|email|unique:users',
            'age'           => 'required|integer|min:1',
            'age_type'      => 'required|string',
        ];
    }

    public function render()
    {
        return view('livewire.registration.add');
    }

    public function resetData()
    {
        $this->reset(['designation', 'firstname', 'lastname', 'mobile', 'gender', 'address', 'email', 'age', 'age_type']);
    }

    public function store()
    {
        $this->validate();

        $registration = Registration::create([
            'designation'   => $this->designation,
            'firstname'     => $this->firstname,
            'lastname'      => $this->lastname,
            'mobile'        => $this->mobile,
            'gender'        => $this->gender,
            'address'       => $this->address,
            'email'         => $this->email,
            'age'           => $this->age,
            'age_type'      => $this->age_type,
            'created_by'    => Auth::id(),
        ]);

        $this->resetData();
        $this->dispatch('reset-modal-reg');
        $this->dispatch('refresh-Registration');
    }
}
