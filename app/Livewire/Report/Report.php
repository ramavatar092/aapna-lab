<?php

namespace App\Livewire\Report;

use App\Models\PatientBilling;
use App\Models\PatientReport;
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
            // if ($test->package_id != null) {
            //     foreach ($test->package as $pack) {
            //         dd($pack);
            //     }
            // }

            //if we add test package then it search for it and throw error it store in array when it have test_id !=null while looping
            if ($test->test_id != null) {
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
    }

    public function saveValues()
    {
        // Process and save observed values
        $savedData = [];
        foreach ($this->storedParameter as $index => $parameter) {
            $range_description = null;

            // Determine the range description based on the field type
            if ($parameter['field'] == 'numeric') {
                $range_description = "{$parameter['range_min']} - {$parameter['range_max']}";
            } elseif ($parameter['field'] == 'numeric-unbound') {
                $range_description = "{$parameter['range_operation']} {$parameter['range_value']}";
            } elseif ($parameter['field'] == 'multiple-range') {
                $range_description = $parameter['multiple_range'];
            } elseif ($parameter['field'] == 'custom') {
                $range_description = $parameter['custom_range'];
            }


            $savedData[] = [
                'patient_id' => $this->patientDetails->patient_id,
                'bill_id' => $this->patientDetails->id,
                'test_id' => $parameter['test_id'],
                'test_name' => $parameter['test_name'],
                'observed_value' => $this->observedValues[$index] ?? null,
                'unit' => $parameter['unit'],
                'field' => $parameter['field'],
                'range_operation' => $parameter['range_operation'],
                'range_value' => $parameter['range_value'],
                'range_min' => $parameter['range_min'],
                'range_max' => $parameter['range_max'],
                'multiple_range' => $parameter['multiple_range'],
                'custom_default' => $parameter['custom_default'],
                'custom_option' => $parameter['custom_option'],
                'custom_range' => $parameter['custom_range'],
                'range_description' => $range_description, // Add the calculated range description
            ];
            dd($savedData);
        }



        PatientReport::insert($savedData);

        session()->flash('message', 'Report saved successfully!');
    }

    public function render()
    {
        return view('livewire.report.report');
    }
}
