<?php

namespace App\Livewire\Test;


use App\Models\TestFeature;
use App\Models\TestMethod;
use Livewire\Attributes\On;
use Livewire\Component;

class SubTestFeature extends Component
{


    public $title;
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
    public $dataCollection = [];
    public $tests;
    public $testId;
    public $parent_id;
    public $custom_range;

  

    protected $rules = [
        
        'test_method' => 'required|string',
        'field' => 'required',
    ];


    #[On('getid')]
    public function gettingId($id){
      
        $this->parent_id=$id;
        $testdetails=TestFeature::find($id);
        $this->testId=$testdetails->test_id;
        $this->title=$testdetails->test_name;

       
    
    }
   
    public function resetFields()
    {
        $this->reset([
            'title', 'test_name', 'test_method', 'field', 'unit',
            'range_min', 'range_max', 'range_operation', 'range_value',
            'multiple_range', 'custom_option', 'custom_default', 'custom_range'
        ]);
    }

    public function changetitle(){
        TestFeature::find($this->parent_id)->update([
            'test_name' => $this->title,
        ]);

        $this->dispatch('refresh-model-feature');
        $this->dispatch('success',__('Test Feature Name Updated'));
    }

   
    public function destroy($id){
        TestFeature::find($id)->delete();
        $this->dispatch('refresh-sub-test-feature');
        $this->dispatch('success',__('Sub Test Feature Deleted'));
    }

    public function saveSubfeature(){
        $this->validate();

        TestFeature::create([
            'test_id' => $this->testId,
            'parent_id' => $this->parent_id,
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
            'custom_range'=>$this->custom_range,
        ]);
        $this->dispatch('refresh-sub-test-feature');
        $this->dispatch('reset-modal-test');
        $this->dispatch('success',__('Sub Test Feature Created'));
        $this->dispatch('reset-sub-test-feature');
        $this->resetFields();
    }
    #[On('reset-sub-test-feature')]
    public function render()
    {
        $subfeature = TestFeature::where('parent_id',$this->parent_id)->get();
        $testmethod = TestMethod::all();
     

        return view('livewire.test.sub-test-feature',[
        
            'testmethods' => $testmethod,

            'subfeature' =>$subfeature
        ]);
    }
}
