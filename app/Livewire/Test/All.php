<?php

namespace App\Livewire\Test;

use App\Models\Department;
use App\Models\Test;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Component;

class All extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 8;
    public $searchTerm = '';

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    #[On('goOn-Delete')]
    public function delete($id)
    {
        Test::find($id)?->delete();
        $this->dispatch('deleted');
        $this->dispatch('success', __(trans('panel.message.delete')));
    }

    #[On('refresh-test')]
    public function render()
    {
      $tests = Test::query()
        ->where('title', 'like', '%' . $this->searchTerm . '%')
        ->paginate($this->perPage);

        return view('livewire.test.all', compact('tests'));
    }
}
