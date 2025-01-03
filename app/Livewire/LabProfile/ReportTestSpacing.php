<?php

namespace App\Livewire\LabProfile;

use Illuminate\Support\Facades\Auth;
use App\Models\ReportTestSpacing as ModelsReportTestSpacing;
use Livewire\Component;

class ReportTestSpacing extends Component
{
    public $departmentFontSize, $columnHeadingFontSize, $testNameFontSize;
    public $sampleTypeFontSize, $testParameterFontSize, $testMethodFontSize;
    public $spacingBetweenTests, $barcode, $spacingDepartment, $spacingTestName;
    public $spacingColumnHeader, $spacingTestParameters, $spacingTestMethod;
    public $refRange, $spacingUnit;

    protected $rules = [
        'departmentFontSize'    => 'required|numeric',
        'columnHeadingFontSize' => 'required|numeric',
        'testNameFontSize'      => 'required|numeric',
        'sampleTypeFontSize'    => 'nullable|numeric',
        'testParameterFontSize' => 'required|numeric',
        'testMethodFontSize'    => 'required|numeric',
        'spacingBetweenTests'   => 'required|numeric',
        'barcode'               => 'nullable|boolean',
        'spacingDepartment'     => 'required|numeric',
        'spacingTestName'       => 'required|numeric',
        'spacingColumnHeader'   => 'required|numeric',
        'spacingTestParameters' => 'required|numeric',
        'spacingTestMethod'     => 'required|numeric',
        'refRange'              => 'nullable|string',
        'spacingUnit'           => 'nullable|string',
    ];

    protected $messages = [
        'departmentFontSize.required'    => 'The department font size is required.',
        'departmentFontSize.numeric'     => 'The department font size must be a number.',

        'columnHeadingFontSize.required' => 'The column heading font size is required.',
        'columnHeadingFontSize.numeric'  => 'The column heading font size must be a number.',

        'testNameFontSize.required'      => 'The test name font size is required.',
        'testNameFontSize.numeric'       => 'The test name font size must be a number.',

        'sampleTypeFontSize.numeric'     => 'The sample type font size must be a number.',

        'testParameterFontSize.required' => 'The test parameter font size is required.',
        'testParameterFontSize.numeric'  => 'The test parameter font size must be a number.',

        'testMethodFontSize.required'    => 'The test method font size is required.',
        'testMethodFontSize.numeric'     => 'The test method font size must be a number.',

        'spacingBetweenTests.required'   => 'The spacing between tests is required.',
        'spacingBetweenTests.numeric'    => 'The spacing between tests must be a number.',

        'barcode.boolean'                => 'The barcode field must be true or false.',

        'spacingDepartment.required'     => 'The spacing for the department is required.',
        'spacingDepartment.numeric'      => 'The spacing for the department must be a number.',

        'spacingTestName.required'       => 'The spacing for the test name is required.',
        'spacingTestName.numeric'        => 'The spacing for the test name must be a number.',

        'spacingColumnHeader.required'   => 'The spacing for the column header is required.',
        'spacingColumnHeader.numeric'    => 'The spacing for the column header must be a number.',

        'spacingTestParameters.required' => 'The spacing for test parameters is required.',
        'spacingTestParameters.numeric'  => 'The spacing for test parameters must be a number.',

        'spacingTestMethod.required'     => 'The spacing for the test method is required.',
        'spacingTestMethod.numeric'      => 'The spacing for the test method must be a number.',

        'refRange.string'                => 'The reference range must be a string.',

        'spacingUnit.string'             => 'The spacing unit must be a string.',
    ];

    public function updatedBarcode($value)
    {
        if ($value) {
            $this->rules['refRange'] = 'required|string';
        } else {

            $this->rules['refRange'] = 'nullable|string';
        }

        $this->validateOnly('barcode');
    }

    public function mount()
    {
        $reportTestSpacing = ModelsReportTestSpacing::where('user_id', Auth::id())->first();
        if(!empty($reportTestSpacing)){
            $this->departmentFontSize      = $reportTestSpacing['departmentFontSize'];
            $this->columnHeadingFontSize   = $reportTestSpacing['columnHeadingFontSize'];
            $this->testNameFontSize        = $reportTestSpacing['testNameFontSize'];
            $this->sampleTypeFontSize      = $reportTestSpacing['sampleTypeFontSize'];
            $this->testParameterFontSize   = $reportTestSpacing['testParameterFontSize'];
            $this->testMethodFontSize      = $reportTestSpacing['testMethodFontSize'];
            $this->spacingBetweenTests     = $reportTestSpacing['spacingBetweenTests'];
            $this->barcode                 = $reportTestSpacing['barcode'];
            $this->spacingDepartment       = $reportTestSpacing['spacingDepartment'];
            $this->spacingTestName         = $reportTestSpacing['spacingTestName'];
            $this->spacingColumnHeader     = $reportTestSpacing['spacingColumnHeader'];
            $this->spacingTestParameters   = $reportTestSpacing['spacingTestParameters'];
            $this->spacingTestMethod       = $reportTestSpacing['spacingTestMethod'];
            $this->refRange                = $reportTestSpacing['refRange'];
            $this->spacingUnit             = $reportTestSpacing['spacingUnit'];
        }

    }


    public function submit()
    {
        $validatedData = $this->validate();

        ModelsReportTestSpacing::updateOrCreate(
            [
                'user_id' => Auth::id(),
            ],
            [
                'departmentFontSize'      => $validatedData['departmentFontSize'],
                'columnHeadingFontSize'   => $validatedData['columnHeadingFontSize'],
                'testNameFontSize'        => $validatedData['testNameFontSize'],
                'sampleTypeFontSize'      => $validatedData['sampleTypeFontSize'],
                'testParameterFontSize'   => $validatedData['testParameterFontSize'],
                'testMethodFontSize'      => $validatedData['testMethodFontSize'],
                'spacingBetweenTests'     => $validatedData['spacingBetweenTests'],
                'barcode'                 => $validatedData['barcode'],
                'spacingDepartment'       => $validatedData['spacingDepartment'],
                'spacingTestName'         => $validatedData['spacingTestName'],
                'spacingColumnHeader'     => $validatedData['spacingColumnHeader'],
                'spacingTestParameters'   => $validatedData['spacingTestParameters'],
                'spacingTestMethod'       => $validatedData['spacingTestMethod'],
                'refRange'                => $validatedData['refRange'],
                'spacingUnit'             => $validatedData['spacingUnit'],
            ]
        );

        $this->dispatch('success', __('Report test spacing saved successfully!'));
    }

    public function render()
    {
        return <<<'HTML'
        <div class="mt-4">
          <h4 class="mb-3">Tests</h4>
            <form wire:submit.prevent="submit">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="departmentFontSize" class="form-label">Department font size</label>
                        <input type="number" class="form-control" id="departmentFontSize" wire:model="departmentFontSize" placeholder="11">
                        @error('departmentFontSize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="columnHeadingFontSize" class="form-label">Column Heading font size</label>
                        <input type="number" class="form-control" id="columnHeadingFontSize" wire:model="columnHeadingFontSize" placeholder="10">
                        @error('columnHeadingFontSize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="testNameFontSize" class="form-label">Test Name font size</label>
                        <input type="number" class="form-control" id="testNameFontSize" wire:model="testNameFontSize" placeholder="11">
                        @error('testNameFontSize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="sampleTypeFontSize" class="form-label">Sample Type font size</label>
                        <input type="number" class="form-control mt-1" id="sampleTypeFontSize" wire:model="sampleTypeFontSize" >
                        @error('sampleTypeFontSize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="testParameterFontSize" class="form-label">Test Parameter font size</label>
                        <input type="number" class="form-control" id="testParameterFontSize" wire:model="testParameterFontSize" placeholder="10">
                        @error('testParameterFontSize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="testMethodFontSize" class="form-label">Test Method font size</label>
                        <input type="number" class="form-control" id="testMethodFontSize" wire:model="testMethodFontSize" placeholder="8">
                        @error('testMethodFontSize') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="spacingBetweenTests" class="form-label">Spacing Between Tests</label>
                        <input type="number" class="form-control" id="spacingBetweenTests" wire:model="spacingBetweenTests" placeholder="2">
                        @error('spacingBetweenTests') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="barcodeCheck" class="form-label">Barcode</label>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="barcodeCheck" wire:model="barcode">
                        </div>
                        @error('barcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Spacing</h5>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="spacingDepartment" class="form-label">Department</label>
                        <input type="number" class="form-control" id="spacingDepartment" wire:model="spacingDepartment" placeholder="2">
                        @error('spacingDepartment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="spacingTestName" class="form-label">Test Name</label>
                        <input type="number" class="form-control" id="spacingTestName" wire:model="spacingTestName" placeholder="4">
                        @error('spacingTestName') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="spacingColumnHeader" class="form-label">Column Header</label>
                        <input type="number" class="form-control" id="spacingColumnHeader" wire:model="spacingColumnHeader" placeholder="4">
                        @error('spacingColumnHeader') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="spacingTestParameters" class="form-label">Test Parameters</label>
                        <input type="number" class="form-control" id="spacingTestParameters" wire:model="spacingTestParameters" placeholder="0">
                        @error('spacingTestParameters') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label for="spacingTestMethod" class="form-label">Test Method</label>
                        <input type="number" class="form-control" id="spacingTestMethod" wire:model="spacingTestMethod" placeholder="-0.5">
                        @error('spacingTestMethod') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="refRange" class="form-label">Ref. Range</label>
                        <input type="text" class="form-control" id="refRange" wire:model="refRange" placeholder="↔">
                        @error('refRange') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="spacingUnit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="spacingUnit" wire:model="spacingUnit" placeholder="Unit">
                        @error('spacingUnit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        HTML;
    }
}
