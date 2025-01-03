<?php

namespace App\Livewire\Center;

use App\Models\Center;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use WithPagination;

    public $searchTerm = '';
    
    protected $paginationTheme = 'bootstrap';

    public function updatingSearchTerm()
    {
  
        $this->resetPage();
    }

    #[On('goOn-Delete-center')]
    public function delete($id)
    {
        Center::findOrFail($id)->delete();
    }

    #[On('refresh-center')]
    public function render()
    {
        $centers = Center::query()
            ->when($this->searchTerm, function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('mobile', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate(10);

        return view('livewire.center.all', [
            'centers' => $centers,
        ]);
    }
}
