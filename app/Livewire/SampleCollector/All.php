<?php

namespace App\Livewire\SampleCollector;

use App\Models\SampleCollector as Collector;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $collectors = Collector::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('gender', 'like', '%' . $this->search . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(2);

        return view('livewire.sample-collector.all', [
            'collectors' => $collectors
        ]);
    }
}
