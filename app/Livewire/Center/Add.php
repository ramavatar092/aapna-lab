<?php

namespace App\Livewire\Center;

use App\Models\Center;
use Livewire\Component;

class Add extends Component
{

    public $name;
    public $mobile;
    public $address;

    protected $rules = [
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
        'address' => 'required|string|max:1000',
    ];
    public function store()
    {
        $validatedData = $this->validate();

  
        Center::create($validatedData);

      
        $this->reset();

       
        $this->dispatch('reset-modal-cen');
        $this->dispatch('refresh-center');
        $this->dispatch('success',__('center added successfully'));
    }
    public function render()
    {
        return view('livewire.center.add');
    }
}
