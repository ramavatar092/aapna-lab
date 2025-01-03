<?php

namespace App\Livewire\Package;

use App\Models\Package;
use App\Models\PackageTest;
use Livewire\Attributes\On;
use Livewire\Component;

class All extends Component
{
    public $packages;

    #[On('refresh-packages')]
    public function mount(){
        $this->packages=Package::with('tests')->get();
    }

    #[On('goOn-Delete')]

    public function delete($id){
        
    
        Package::find($id)?->delete();
        
        
        
        $this->dispatch('deleted');
        $this->dispatch('success', __(trans('panel.message.delete')));
    }

    public function render()
    {
        return view('livewire.package.all');
    }
}
