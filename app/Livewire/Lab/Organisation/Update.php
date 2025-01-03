<?php

namespace App\Livewire\Lab\Organisation;

use App\Models\Organisation;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    public $organisationId, $ref_type, $name, $degree, $compliment,$address, $clear_due =0, $financial_analysis=0;
  
    protected $rules = [
        'ref_type' => 'required',
        'name' => 'required|string|max:255',
        'degree' => 'nullable|string|max:255',
        'compliment' => 'required|numeric|min:0|max:100',
        'clear_due' => 'boolean',
        'financial_analysis' => 'boolean',
    ];
    public function resetData()
    {
        $this->reset([
            'ref_type', 'name', 'degree', 'compliment'
        ]);
    }

    #[On('update-organisation')]
    public function edit($id)
    {
        $organisation = Organisation::findOrFail($id);

       
        $this->organisationId = $organisation->id;
        $this->ref_type = $organisation->ref_type;
        $this->name = $organisation->name;
        $this->degree = $organisation->degree;
        $this->compliment = $organisation->compliment;
        $this->address = $organisation->address;  
        $this->clear_due = $organisation->clear_due;
        $this->financial_analysis = $organisation->financial_analysis;

       
    }

    public function update()
    {
        $this->validate();

        $organisation = Organisation::findOrFail($this->organisationId);

        $organisation->update([
            'ref_type' => $this->ref_type,
            'name' => $this->name,
            'degree' => $this->degree,
            'compliment' => $this->compliment,
            'financial_analysis'=>$this->financial_analysis,
            'clear_due'=>$this->clear_due,
        ]);

        $this->resetData();
      
        $this->dispatch('reset-modal-org');
        $this->dispatch('refresh-Organisation'); 
    }

    public function render()
    {
        return view('livewire.lab.organisation.update');
    }
}
