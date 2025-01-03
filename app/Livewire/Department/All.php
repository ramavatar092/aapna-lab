<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class All extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $perPage = 4; // Number of items per page

    #[On('refresh-department')]
    public function refreshDepartments()
    {
        $this->resetPage(); // Reset pagination when data is refreshed
    }

    #[On('goOn-Delete-dept')]
    public function delete($id)
    {
        Department::find($id)?->delete();
        $this->dispatch('deleted');
        $this->dispatch('success', __(trans('panel.message.delete')));
        $this->dispatch('refresh-department');
    }

    public function updateStatus($id)
    {
        $dept = Department::find($id);
        $dept->status = !$dept->status;
        $dept->save();
        $this->dispatch('success', __(trans('panel.message.status')));
        $this->dispatch('refresh-department');
    }

    public function render()
    {
        $department = Department::query()
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('slug', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate($this->perPage);
            $this->dispatch('reset-modal-dept');

        return view('livewire.department.all', compact('department'));
    }
}
