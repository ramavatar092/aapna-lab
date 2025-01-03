<?php

namespace App\Livewire\Registration;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class Update extends Component
{
    public $id;
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
            'mobile'        => 'required|digits:10|unique:registrations,mobile,' . $this->id,
            'gender'        => 'required|string',
            'address'       => 'required|string',
            'email'         => 'nullable|string|email|unique:users',
            'age'           => 'required|integer|min:1',
            'age_type'      => 'required|string',
        ];
    }

    public function render()
    {
        return view('livewire.registration.update');
    }

    public function resetData()
    {
        $this->reset(['designation', 'firstname', 'lastname', 'mobile', 'gender', 'address', 'email', 'age', 'age_type']);
    }

    #[On('update-registration')]
    public function edit($id)
    {
        $registration = Registration::findOrFail($id);
        $this->id           = $id;
        $this->designation  = $registration->designation;
        $this->firstname    = $registration->firstname;
        $this->lastname     = $registration->lastname;
        $this->mobile       = $registration->mobile;
        $this->gender       = $registration->gender;
        $this->address      = $registration->address;
        $this->email        = $registration->email;
        $this->age          = $registration->age;
        $this->age_type     = $registration->age_type;
    }

    public function update()
    {
        $this->validate();
        Registration::findOrFail($this->id)->update([
            'designation'   => $this->designation,
            'firstname'     => $this->firstname,
            'lastname'      => $this->lastname,
            'mobile'        => $this->mobile,
            'gender'        => $this->gender,
            'address'       => $this->address,
            'email'         => $this->email,
            'age'           => $this->age,
            'age_type'      => $this->age_type,
        ]);

        $this->resetData();
        $this->dispatch('reset-modal-reg');
        $this->dispatch('refresh-Registration');
    }
}
