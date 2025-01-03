<?php

namespace App\Livewire\Lab;

use App\Livewire\Categories\Update;
use App\Models\Organisation;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class All extends Component
{
    use WithPagination;

    public $searchTerm='';
    
    public $searchType = 'doctor'; // Default to searching for doctors
    
    protected $paginationTheme = 'bootstrap';
    public $getOrgId;


   
  
    #[On('getOrg')]
    public function getOrg($id)
    {

        $this->getOrgId = $id;
    }

    public function setSearchType($type)
    {
        $this->searchType = $type;
        $this->resetPage(); // Reset pagination when changing search type
    }

    #[On('goOn-Delete-org')]
    public function delete($id)
    {
        Organisation::find($id)?->delete();
        $this->dispatch('deleted');
        $this->dispatch('success', __(trans('panel.message.delete')));
        $this->dispatch('refresh-Organisation');
    }
  
    public function updateStatus($id=null)
    {
        if(!$id==null)
        {
            $org = User::find($id);

        $org->status == 1 ? $org->status = 0 :  $org->status = 1;

        $org->save();
        $this->dispatch('success', __(trans('panel.message.update')));
        $this->dispatch('refresh-Organisation');
        }
        else
        {
            $this->dispatch('error', __('Add Login Details first.'));
        }
        
    }
    #[On('refresh-Organisation')]
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $organisations = Organisation::with('user')
            ->where('ref_type', $this->searchType)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('username', 'like', $searchTerm)
                            ->orWhere('mobile', 'like', $searchTerm);
                    });
            })
            ->paginate(10);
        

        return view('livewire.lab.all', compact('organisations'));
    }
}
