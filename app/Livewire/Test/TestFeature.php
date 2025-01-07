<?php

namespace App\Livewire\Test;

use App\Models\TestMethod;
use App\Models\TestFeature as TestFeatureModel;
use Livewire\Attributes\On;
use Livewire\Component;

class TestFeature extends Component
{
    
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
    public $custom_range;
    public $dataCollection = [];
    public $tests;
    public $Id;

    protected $rules = [
        'type' => 'required',
        'test_name' => 'required|string|max:255',
        'test_method' => 'required|string',
        'field' => 'required',
    ];
    public function mount($id){

       $this->Id=$id;
      
    }

    public function resetField()
    {
        $this->reset([
            'type', 'test_name', 'test_method', 'field', 'unit',
            'range_min', 'range_max', 'range_operation', 'range_value',
            'multiple_range', 'custom_option', 'custom_default', 'custom_range',
        ]);
    }

    public function saveData(){

        $this->validate();
        
        $testfeature=TestFeatureModel::create([
            'test_id' => $this->Id,
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
            'custom_range' => $this->custom_range,
        ]);

        $this->resetField();
        $this->dispatch('success',__('Test Feature Added Successfully'));
        $this->dispatch('refresh-model-feature');
    }

    public function removeData($id){
        $testfeature = TestFeatureModel::find($id);
        $testfeature->delete();
        $this->dispatch('success',__('Test Feature Deleted Successfully'));
        $this->dispatch('refresh-model-feature');
    }

    #[On('refresh-model-feature')]
    #[On('refresh-testmethod')]
    public function render()
    {    $testmethod = TestMethod::all();
        $testfeature = TestFeatureModel::where('test_id',$this->Id)->where('parent_id',null)->get();
        return view('livewire.test.test-feature',[
            'testfeature' => $testfeature,
           'testmethods' => $testmethod
        ]);
    }
}
