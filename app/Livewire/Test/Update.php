<?php

namespace App\Livewire\Test;

use App\Models\Department;
use App\Models\Package;
use App\Models\Test;
use App\Models\TestMethod;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class Update extends Component
{
    public $departments;
    public $dept_id;
    public $title;
    public $amount;
    public $code;
    public $gender;
    public $sample_type;
    public $age;
    public $suffix;
    public $id;
 
   
    public $sampleTypes = [
        'Blood' => 'Blood',
        'Urine' => 'Urine',
        'Saliva' => 'Saliva',
        'Tissue' => 'Tissue',
        'Sputum' => 'Sputum',
        'Serum' => 'Serum',
        'Plasma' => 'Plasma',
        'Swab' => 'Swab',
        'Stool' => 'Stool',
        'CSF' => 'Cerebrospinal Fluid (CSF)',
        'Biopsy' => 'Biopsy',
        'Other' => 'Other'
    ];
    public function mount(){
        $this->departments = Department::get();
    }

    #[On('update-test')]
    public function edit($id)
    {
       
        $test = Test::findOrFail($id);
   
        $this->id           = $id;
        $this->dept_id      = $test->dept_id;
        $this->title        = $test->title;
        $this->amount         = $test->amount;
        $this->code         = $test->code;
        $this->gender       = $test->gender;
        $this->sample_type  = $test->sample_type;
        $this->age          = $test->age;
        $this->suffix       = $test->suffix;
       
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

    protected $rules = [
    'dept_id'       => 'required',
        'title'         => 'required|string|max:255',
        'amount'          => 'required|numeric|min:0',
        'code'          => 'required|string|max:50',
        'gender'        => 'required|string',
        'sample_type'   => 'required|string|max:100',
        'age'           => 'required|string',
        'suffix'        => 'nullable|string|max:20',
        'type'          => 'nullable|string|max:100',
        'test_name'     => 'required|string|max:255',
        'test_method'   => 'required|string|max:100',
        'field'         => 'required|string|max:100',
        'unit'          => 'required|string|max:50',
        'range_min'     => 'nullable|numeric',
        'range_max'     => 'nullable|numeric',
        'range_operation' => 'nullable',
        'range_value' => 'nullable',
        'multiple_range' => 'nullable',
        'custom_default' => 'nullable',
        'custom_option' => 'nullable',
    ];

    public function resetData()
    {
        $this->reset([
            'dept_id',
            'title',
            'amount',
            'code',
            'gender',
            'sample_type',
            'age',
            'suffix',
            
        ]);
    }

    
    public function update()
    {
        Test::findOrFail($this->id)->update([
            'dept_id'      => $this->dept_id,
            'title'        => $this->title,
            'amount'         => $this->amount,
            'code'         => $this->code,
            'gender'       => $this->gender,
            'sample_type'  => $this->sample_type,
            'age'          => $this->age,
            'suffix'       => $this->suffix,
            'updated_by'   => Auth::id(),
        ]);

        $this->resetData();
        $this->dispatch('reset-modal-test');
        $this->dispatch('refresh-test');
        $this->dispatch('success', __('Test updated successfully!'));
       
    }

    public function render()
    {     $testmethod=TestMethod::all();
        return view('livewire.test.update',[
            
                'testmethods'=>$testmethod
            
        ]);
    }
}
