<?php

namespace App\Livewire\Report;

use App\Models\PatientBilling;
use App\Models\PatientReport;
use Livewire\Component;

class Report extends Component
{
    public $patientDetails;
    public $storedParameter = [];
    public $observedValues = [];
    public $interpretations = [];
    public $Id;


    public function mount($id)
    {
        //note: here testbill contain 'test_id' and 'package_id' in the table, if patientbill has test than test_id have 'id' of that (test) which we choosen while patient-registration and 'package_id' is null at that time. and when package_id have the id of the 'package' which we choosen at the time of patient-registration then test_id is null.[database:testpackagebill]

        $this->patientDetails = PatientBilling::with([
            'testbill.test.testParameter', //taking relation in the 'test' then 'testParameter' to perform egar loading
            'testbill.package.tests.testParameter' //taking relation of the 'package' then 'test' then 'testParameter'
        ])->findOrFail($id);


        $this->Id = $id;
        $this->observedValues = [];

        // Retrieve existing patient reports
        $existingReports = PatientReport::where('patient_id', $this->patientDetails->patient_id)
            ->where('bill_id', $this->patientDetails->id)
            ->get();

        foreach ($this->patientDetails->testbill as $testbill) {
            if ($testbill->test_id) {
                $this->processTest($testbill->test);
            }

            if ($testbill->package_id) {
                foreach ($testbill->package->tests as $test) {
                    $this->processTest($test);
                }
            }
        }

        // Match existing observed values with stored parameters
        foreach ($this->storedParameter as $index => $parameter) {
            $report = $existingReports->firstWhere('test_parameter', $parameter['test_parameter']);
            $this->observedValues[$index] = $report->observed_value ?? '';
            $interpreteration = $existingReports->firstWhere('title', $parameter['title']);

            $this->interpretations[$index] = $interpreteration->interpretation_status ?? false;
        }
    }
    public function processTest($test): void
    {
        foreach ($test->testParameter as $testParameter) {
            $this->storedParameter[] = [
                'test_id' => $test->id,
                'title' => $test->title,
                'parent_id' => $testParameter->parent_id ?? null,
                'type' => $testParameter->type ?? null,
                'test_parameter' => $testParameter->test_name ?? null,
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

            // Initialize observed values
            $this->observedValues[] = '';
        }
    }
    public function saveValues()
    {
        // Remove existing records for the given patient_id and bill_id
        PatientReport::where('patient_id', $this->patientDetails->patient_id)
            ->where('bill_id', $this->patientDetails->id)
            ->delete();

        // Prepare data for insertion
        $data = [];
        foreach ($this->storedParameter as $index => $parameter) {
            $range_description = null;

            if ($parameter['field'] == 'numeric') {
                $range_description = "{$parameter['range_min']} - {$parameter['range_max']}";
            } elseif ($parameter['field'] == 'numeric-unbound') {
                $range_description = "{$parameter['range_operation']} {$parameter['range_value']}";
            } elseif ($parameter['field'] == 'multiple-range') {
                $range_description = $parameter['multiple_range'];
            } elseif ($parameter['field'] == 'custom') {
                $range_description = $parameter['custom_range'];
            }

            $data[] = [
                'test_id' => $parameter['test_id'],
                'title' => $parameter['title'],
                'patient_id' => $this->patientDetails->patient_id,
                'bill_id' => $this->patientDetails->id,
                'test_parameter' => $parameter['test_parameter'],
                'observed_value' => $this->observedValues[$index] ?? null,
                'interpretation_status' => $this->interpretations[$parameter['title']] ?? false,
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
                'range_description' => $range_description,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the new data
        PatientReport::insert($data);

        // Mark the test bill as completed in the patient billing table
        $this->BillStatus();

        session()->flash('message', 'Report saved successfully!');
        $this->dispatch('success', __('Report saved successfully'));
    }




    public function pdfPreview()
    {
        $data = [
            'patient_id' => $this->patientDetails->patient_id,
            'bill_id' => $this->patientDetails->id,
        ];

        $this->dispatch('patient_details', $data);
    }
    public function BillStatus()
    {

        $patientDetails = PatientBilling::where('id', $this->Id)->update(['status' => 'completed']);
    }



    public function render()
    {
        return view('livewire.report.report');
    }
}
