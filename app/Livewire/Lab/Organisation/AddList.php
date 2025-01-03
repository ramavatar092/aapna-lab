<?php

namespace App\Livewire\Lab\Organisation;

use App\Models\Test;
use App\Models\TestCommission;
use Livewire\Attributes\On;
use Livewire\Component;

class AddList extends Component
{
    public $testDetails;

    public $searchTerm;
    public $selectedItems = [];
    public $search = '';
    public $results = [];
    public $commission = [];
    public $orgId;

    #[On('getOrg')]
    public function getOrg($id)
    {

        $this->orgId = $id;
    }
    public function deleteList($id)
    {

        TestCommission::find($id)?->delete();
        $this->dispatch('success', __(trans('panel.message.delete')));
        $this->dispatch('refresh-commission');
    }

    public function updatedSearch()
    {


        $this->results = Test::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->take(6)
            ->get()
            ->toArray();
    }
    public function doctorlist()
    {
        $this->dispatch('Doctor-id', id: $this->orgId);
    }

    // Handle selection of a search result
    public function selectResult($id)
    {
        $result = Test::find($id); // Replace `Test` with your model name


        $uniqueTest = $uniqueTest = TestCommission::where('test_id', $result->id)
            ->where('org_id', $this->orgId)
            ->exists();




        if ($uniqueTest) {
            $this->dispatch('warning', __('You already have this Test'));
            $this->dispatch('refresh-commission');
            return;
        } else {
            if ($result) {
                // Append the selected item to the table if not already present
                $exists = collect($this->selectedItems)->contains('id', $result->id);
                if (!$exists) {
                    $this->selectedItems[] = [
                        'id' => $result->id,
                        'title' => $result->title,
                        'code' => $result->code,
                        'bill_price' => $result->amount,
                        'commission_price' => 0,
                        'commission_percent' => 0,

                    ];
                }
            }
        }




        // Clear search input and results
        $this->search = '';
        $this->results = [];
    }



    public function addCommission()
    {
        $dataToInsert = [];
        foreach ($this->selectedItems as $selected) {
            $dataToInsert[] = [

                'test_id' => $selected['id'],
                'org_id' => $this->orgId,
                'bill_price' => $selected['bill_price'],
                'commission_price' => $selected['commission_price'],
                'commission_percent' => $selected['commission_percent'],
                'created_at' => now(),



            ];

          
        }

        if(!empty($dataToInsert))
        {
            TestCommission::insert($dataToInsert);
            $this->reset(['results', 'selectedItems']);
            // $this->dispatch('reset-modal-list');
            $this->dispatch('refresh-commission');
            $this->dispatch('success', __('Test Commission Successfully'));
        }

       

      
    }
    public function removeItem($index)
    {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems); // Reindex the array
    }

    #[On('refresh-commission')]
    public function render()
    {
        $this->commission = TestCommission::where('org_id', $this->orgId)->with('test')->get();
        return view('livewire.lab.organisation.add-list');
    }
}
