<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    public $id;
    public $title;
    public $description;
    public $slug;
    public $status;

    // Validation rules
    public function rules()
    {
        return [
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:departments,slug,' . $this->id,
            'status'       => 'required|boolean',
            'description'  => 'nullable|string',
        ];
    }

   

    public function resetData()
    {
        $this->reset(['title', 'description', 'slug', 'status']);
    }

    #[On('update-department')]
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $this->id          = $id;
        $this->title       = $department->title;
        $this->description = $department->description;
        $this->slug        = $department->slug;
        $this->status      = $department->status;
    }

    public function update()
    {
        $this->validate();
        
        Department::findOrFail($this->id)->update([
            'title'       => $this->title,
            'slug'        => $this->slug,
            'status'      => $this->status,
            'description' => $this->description,
            'updated_by'  => Auth::id(),
        ]);

        $this->resetData();
        $this->dispatch('reset-modal-dept');
        $this->dispatch('refresh-department');
    }
    public function render()
    {
        return view('livewire.department.update');
    }
}
