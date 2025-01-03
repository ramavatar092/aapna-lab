<?php

namespace App\Livewire\Center;

use App\Models\Center;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{

    public $centerId;
    public $name;
    public $address;
    public $mobile;
    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
    ];
    #[On('update-center')]
    public function edit($id)
    {
        $center = Center::findOrFail($id);
        $this->centerId = $center->id;
        $this->name = $center->name;
        $this->address = $center->address;
        $this->mobile = $center->mobile;
    }

    
    public function update()
    {
        $this->validate();

        $center = Center::findOrFail($this->centerId);
        $center->update([
            'name' => $this->name,
            'address' => $this->address,
            'mobile' => $this->mobile,
        ]);

        $this->dispatch('reset-modal-cen');
        $this->dispatch('refresh-center');
        $this->dispatch('success',__('center updated successfully'));
       
    }
    public function render()
    {
        return view('livewire.center.update');
    }
}
