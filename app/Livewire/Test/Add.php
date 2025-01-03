<?php

namespace App\Livewire\Test;

use App\Models\Department;
use App\Models\Package;
use App\Models\Test;
use App\Models\TestMethod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

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
    public $type = 'single field';
    public $test_name;
    public $test_method = null;
    public $field = 'numeric';
    public $unit;
    public $range_min;
    public $range_max;
    public $range_operation;
    public $range_value;
    public $multiple_range;
    public $custom_default;
    public $custom_option;
    public $tests;

    //making variables for subtest
  
    public $subTestTitle;
    public $subTest_name;
    public $subTest_method;


    public $openSubTest = false;

    public $dataCollection = [];
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



    public function addDataToArray()
    {
        $this->dataCollection[] = [
            'type' => $this->type,
            'test_name' => $this->test_name,
            'test_method' => $this->test_method,
            'field' => $this->field,
            'unit' => $this->unit,
            'range_min' => $this->range_min,
            'range_max' => $this->range_max,
            'range_operation' => $this->range_operation,
            'range_value' => $this->range_value,
            'multiple_range' => $this->multiple_range,
            'custom_default' => $this->custom_default,
            'custom_option' => $this->custom_option,
            'sub_test' => [],
        ];

        $this->resetTablefield();
        $this->dispatch('success', __('Field added successfully'));
    }
    public function subTest($id)
    {
        $this->openSubTest = !$this->openSubTest;
        $data = $this->dataCollection[$id];

        $this->subTestTitle = $data['test_name'];
       
    }
    public function resetTablefield()
    {
        $this->reset([
            'type',
            'test_name',
            'test_method',
            'field',
            'unit',
            'range_min',
            'range_max',
            'range_operation',
            'range_value',
            'multiple_range',
            'custom_default',
            'custom_option',
            'subTestTitle',
            'subTest_name',
            'subTest_method'

        
        ]);
    }

    public function removeDataFromArray($index)
    {
        unset($this->dataCollection[$index]);
        $this->dispatch('success', __('Field removed successfully'));
    }


    public function store()
    {

        $validatedData = $this->validate();

        $validatedData['created_by'] = Auth::id();

        $test = Test::create($validatedData);


        $this->resetData();
        $this->dispatch('reset-modal');
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
    #[On('refresh-testmethod')]
    public function render()
    {
        $testmethod = TestMethod::all();
        return view('livewire.test.add', [
            'testmethods' => $testmethod
        ]);
    }
}
