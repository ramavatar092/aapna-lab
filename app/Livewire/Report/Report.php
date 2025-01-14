<?php

namespace App\Livewire\Report;

use App\Models\PatientBilling;
use Livewire\Component;

class Report extends Component
{
    public $patientDetails;
    public $storedParameter = [];
    public $observedValues = []; // Array to store observed values for input fields

    public function mount($id)
    {
        // Fetch patient billing details
        $this->patientDetails = PatientBilling::findOrFail($id);

        // Populate the storedParameter array
        foreach ($this->patientDetails->testbill as $test) {
            foreach ($test->test->testParameter as $testParameter) {
                $this->storedParameter[] = [
                    'test_id' => $test->id,
                    'parent_id' => $testParameter->parent_id ?? null,
                    'type' => $testParameter->type ?? null,
                    'test_name' => $testParameter->test_name ?? null,
                    'test_method' => $testParameter->test_method ?? null,
                    'field' => $testParameter->field ?? null,
                    'unit' => $testParameter->unit ?? null,
                    'range_min' => $testParameter->range_min ?? null,
                    'range_max' => $testParameter->range_max ?? null,
                    'range_operation' => $testParameter->range_operation ?? null,
                    'range_value' => $testParameter->range_value ?? null,
                    'multiple_range' => $testParameter->multiple_range ?? null,
                    'custom_default' => $testParameter->custom_default ?? null,
                    'custom_option' => $testParameter->custom_option ?? null,
                    'custom_range' => $testParameter->custom_range ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Initialize observed values for each parameter
                $this->observedValues[] = '';
            }
        }
    }

    public function saveValues()
    {
        // Process and save observed values
        $savedData = [];
        foreach ($this->storedParameter as $index => $parameter) {
            $savedData[] = [
                'test_name' => $parameter['test_name'],
                'observed_value' => $this->observedValues[$index],
                'unit' => $parameter['unit'],
                'field' => $parameter['field'],
            ];
        }
        dd($savedData);

        // Perform your save logic here (e.g., database insertion)
        // Example: Save $savedData into a database table
        session()->flash('message', 'Observed values saved successfully!');
    }

    public function render()
    {
        return view('livewire.report.report');
    }
}
