<?php

namespace App\Livewire\Test;

use App\Models\TestMethod as ModelsTestMethod;
use Livewire\Component;

class Testmethod extends Component
{
    public $test_method;

    public function addTestmethod(){
        $validated=$this->validate([
            'test_method' => 'required|string|max:255',
        ]);

        ModelsTestMethod::create($validated);

        $this->dispatch('refresh-testmethod');
        $this->dispatch('reset-testmethod');
       
    }
    

    public function render()
    {
        return view('livewire.test.testmethod');
    }
}
