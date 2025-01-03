<?php

namespace App\Livewire\Registration;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Component;

class All extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $perPage = 2;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    #[On('goOn-Delete')]
    public function delete($id)
    {
        Registration::find($id)?->delete();
        $this->dispatch('deleted');
    }

    #[On('refresh-Registration')]
    public function refreshRegistration()
    {
        $this->resetPage(); 
    }

    public function render()
    {
        // $registrations = Registration::where('firstname', 'like', '%' . $this->searchTerm . '%')->paginate($this->perPage);

        // return view('livewire.registration.all', [
        //     'registrations' => $registrations,
        // ]);

        $registrations = Registration::query()
            ->when($this->searchTerm, function ($query) {
                $query->where('firstname', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('lastname', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('mobile', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate($this->perPage);

            $this->dispatch('reset-modal-reg');

        return view('livewire.registration.all', compact('registrations'));
    }
}
