<?php

namespace App\Livewire\Lab\Organisation;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class DoctorLogin extends Component
{
    public $organisationId;
    public $username;
    public $password;
    public $mobile;
   

    protected $rules = [
        'username' => 'required|string|min:3',
        'password' => 'required|string|min:6',
        'mobile' => 'required|numeric|digits:10',
    ];

    #[On('doctor-login')]
    public function getData($id)
    {
        $this->organisationId = $id;
        
    }
    public function resetData()
    {
      
        $this->reset([
            'username', 'password', 'mobile'
        ]);
    }

    public function store(){

        $this->validate();

        $doctorLogin=[
            'username' => $this->username,
            'org_id'=>$this->organisationId,
            'password' =>Hash::make($this->password),
            'mobile' => $this->mobile,
        ];
       
        User::updateOrCreate(['org_id'=>$this->organisationId],$doctorLogin);

       

        $this->dispatch('reset-modal-doc');
        $this->dispatch('refresh-Organisation');
        
    }

    public function render()
    {
        return view('livewire.lab.organisation.doctor-login');
    }
}
