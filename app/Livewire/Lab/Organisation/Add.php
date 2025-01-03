<?php

namespace App\Livewire\Lab\Organisation;

use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Add extends Component
{
 
    public $ref_type, $name, $degree, $compliment,$address;

  

    protected $rules = [
        'ref_type' => 'required|string|in:Doctor,Hospital',
        'name' => 'required|string|max:255',
        'degree' => 'nullable|string|max:255',
        'compliment' => 'required|numeric|min:0|max:100',
        'address' => 'nullable|string|max:255',
       
    ];

    

    public function resetData()
    {
        $this->reset([
            'ref_type', 'name', 'degree', 'compliment'
        ]);
    }

    public function store()
    {
        $this->validate();

        Organisation::create([
            'ref_type' => $this->ref_type,
            'name' => $this->name,
            'degree' => $this->degree,
            'compliment' => $this->compliment,
            'address'=>$this->address,
            'created_by' => Auth::id(),
        ]);

        $this->resetData();

        $this->dispatch('reset-modal-org');
        $this->dispatch('refresh-Organisation'); 
    }

    public function render()
    {
        return view('livewire.lab.organisation.add');
    }
}
