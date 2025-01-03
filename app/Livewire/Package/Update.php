<?php

namespace App\Livewire\Package;

use App\Models\Package;
use App\Models\PackageTest;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class Update extends Component
{
    
    public $search = '';
    public $Id;
    public $title;
    public $amount;
    public $code;
    public $results = [];
    public $selectedItems = []; 

    public $currentItems=[];
   
    public $packageName = '';
    public $totalAmount = '';

    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255',
        'amount' => 'required|string|max:255',
        'code' => 'required|string:max:255',
       
    ];

    // Search logic
    public function updatedSearch()
    {
        // Replace with your database query (e.g., Test::where(...)->get())
        $this->results = Test::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->take(6)
            ->get()
            ->toArray();    
    }



    // Handle selection of a search result
    public function selectResult($id)
    {
        $result = Test::find($id); 
        if ($result) {
            // Append the selected item to the table if not already present
            $exists = collect($this->selectedItems)->contains('id', $result->id);
            if (!$exists) {
                $this->selectedItems[] = [
                    'id' => $result->id,
                    'title' => $result->title,
                    'code' => $result->code,
                    'created_at'=> $result->created_at,
                    'amount' => $result->amount,    
                ];
            }
        }

        // Clear search input and results
        $this->search = '';
        $this->results = [];
    }

    // Remove an item from the selected items list
    public function removeItem($index)
    {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems); // reindex the array
    }

    #[On('update-package')]
    public function edit($id){
        $this->Id=$id;
        $edit=Package::find($id);

       
       $this->title=$edit->title;
       $this->amount=$edit->amount;
       $this->code=$edit->code;
       $this->selectedItems = $edit->tests->map(function ($test) {
        return [
            'id' => $test->id,
            'title' => $test->title,
            'code' => $test->code,
            'created_at'=> $test->pivot->created_at,
            'amount' => $test->pivot->amount, 
        ];
    })->toArray();

    }
    public function updatedTitle(){
        $this->generateUniqueCode(); // i am calling function on changing the title on update
    }

    function generateUniqueCode()
    {
        do {
            // Generate a random string code
            $this->code = Str::upper(Str::random(8)); // geneting the 8 characters random code
        } while (Package::where('code', $this->code)->exists() && Test::where('code',$this->code) ); //checking unique in both table because in many places i am checking this two with the unique code(model) data

       
    }
    
    public function updatePackage()
    {
        $this->validate();

        if(!$this->selectedItems==[]){
            
        $package = Package::find($this->Id);

        if ($package) {
            $package->update([
                'title' => $this->title,
                'amount' => $this->amount,
                'code' => $this->code,
                'updated_by' => Auth::id(),
            ]);
        
            $dataToInsert = [];
            foreach ($this->selectedItems as $selected) {
                $dataToInsert[] = [
                    'package_id' => $package->id, // Now accessing the actual model's ID
                    'test_id' => $selected['id'],
                    'amount' => $selected['amount'],
                    'created_at' => $selected['created_at'],
                    'updated_at'=>now(),
                ];
            }
           
        
            // Insert or update tests
            PackageTest::where('package_id', $package->id)->delete(); // Optionally delete old tests
            PackageTest::insert($dataToInsert);

            $this->reset(['amount', 'title', 'code', 'search', 'results','selectedItems']);
            $this->dispatch('reset-modal-package');
            $this->dispatch('success', __('Package Updated Successfully'));
            $this->dispatch('refresh-packages');
        }
        }
        else{
            $this->dispatch('warning', __('Add Test To Make a Package!'));
        }
       
      
    }

   

    public function render()
    {
        return view('livewire.package.update');
    }
}
