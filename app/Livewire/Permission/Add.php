<?php

namespace App\Livewire\Permission;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Add extends Component
{
    public $name;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function store()
    {

        Permission::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        $this->reset('name');

        $this->dispatch('reset-modal-per');
        $this->dispatch('refresh-Permission');
        $this->dispatch('success', __("Permission added successfully!"));

    }

    public function render()
    {
        return view('livewire.permission.add');
    }
}
