<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Add extends Component
{
    public $title, $slug, $status, $description;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:departments,slug',
        'status' => 'required',
        'description' => 'nullable|string|max:500',
    ];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }
    public function resetData()
    {
        $this->reset(['title', 'slug', 'status', 'description']);
    }

    public function store()
    {
        $this->validate();

        Department::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->status,
            'description' => $this->description,
            'created_by' => Auth::id(),
        ]);

        $this->resetData();
        $this->dispatch('reset-modal-dept');
        $this->dispatch('refresh-department');

       
    }
    public function render()
    {
        return view('livewire.department.add');
    }
}
