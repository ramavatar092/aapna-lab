<?php

namespace App\Livewire\Test;

use App\Models\Department;
use App\Models\Package;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;


class Add extends Component
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

    protected $rules = [
        'dept_id' => 'required|exists:departments,id',
        'title' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'code' => 'required|string|max:255|unique:tests,code',
        'gender' => 'required|in:male,female,other',
        'sample_type' => 'required|string',
        'age' => 'required|in:default,all',
        'suffix' => 'nullable|string|max:50',
    ];

    protected $messages = [
        'dept_id.required' => 'The department is required.',
        'title.required' => 'The title is required.',
        'amount.required' => 'The amount is required.',
        'code.required' => 'The code is required.',
        'sample_type.required' => 'The sample type is required.',
        'age.required' => 'The age selection is required.',
    ];

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
    public function mount()
    {
        $this->departments = Department::get();
    }
    public function store()
    {

        $validatedData = $this->validate();

        $validatedData['created_by'] = Auth::id();

        $test = Test::create($validatedData);


    
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
        $this->dispatch('reset-modal-test');
        $this->dispatch('refresh-test');
        $this->dispatch('success', __('Test created successfully!'));
        return redirect()->route('admin.tests');
    }

    public function updatedTitle()
    {
        $this->generateUniqueCode(); // i am calling function on changing the title on update
    }

    function generateUniqueCode()
    {
        do {
            // Generate a random string code
            $this->code = Str::upper(Str::random(8)); // geneting the 8 characters random code
        } while (Package::where('code', $this->code)->exists() && Test::where('code', $this->code)); //checking unique in both table because in many places i am checking this two with the unique code(model) data


    }

    public function render()
    {
        return view('livewire.test.add');
    }
}
