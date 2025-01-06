<?php

namespace App\Livewire\Test;

use App\Models\TestMethod;
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
    public $dataCollection = [];
    public $tests;
    public function render()
    {    $testmethod = TestMethod::all();
        return view('livewire.test.test-feature',[
            'testmethods' => $testmethod
        ]);
    }
}
