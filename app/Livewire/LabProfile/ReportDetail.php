<?php

namespace App\Livewire\LabProfile;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReportDetail extends Component
{
    use WithFileUploads;

    public $reportHeader;
    public $headerHeight = 100;
    public $reportFooter;
    public $footerHeight = 60;
    public $reportBackground;
    public $font = 'Roboto';

    public $leftMargin = 25;
    public $rightMargin = 25;

    public function mount()
    {
        $report = Report::where('user_id', Auth::id())->first();
        if(!empty($report)){
            $this->reportHeader     = $report->header_image;
            $this->reportFooter     = $report->footer_image;
            $this->reportBackground = $report->background_image;
            $this->headerHeight     = $report->header_height;
            $this->footerHeight     = $report->footer_height;
            $this->font             = $report->font;
            $this->leftMargin       = $report->left_margin;
            $this->rightMargin      = $report->right_margin;
        }
    }

    public function reportStore()
    {
        $this->validate([
            // 'reportHeader'      => 'nullable|mimes:jpg,png',
            // 'reportFooter'      => 'nullable|mimes:jpg,png',
            // 'reportBackground'  => 'nullable|mimes:jpg,png',
            'headerHeight'      => 'required|integer|min:0|max:500',
            'footerHeight'      => 'required|integer|min:0|max:500',
            'font'              => 'required|string',
            'leftMargin'        => 'required|integer|min:0|max:100',
            'rightMargin'       => 'required|integer|min:0|max:100',
        ]);

        $reportData = [
            'header_height' => $this->headerHeight,
            'footer_height' => $this->footerHeight,
            'font'          => $this->font,
            'left_margin'   => $this->leftMargin,
            'right_margin'  => $this->rightMargin,
            'user_id'       => Auth::id(),
        ];

        // Check for uploaded images and handle them
        if ($this->reportHeader && $this->reportHeader instanceof \Illuminate\Http\UploadedFile && $this->reportHeader->isValid()) {
            $imageHeader = 'report_' . time() . '_header.' . $this->reportHeader->getClientOriginalExtension();
            $this->reportHeader->storeAs('images/report', $imageHeader, 'public');
            $reportData['header_image'] = $imageHeader;
        }

        if ($this->reportFooter && $this->reportFooter instanceof \Illuminate\Http\UploadedFile && $this->reportFooter->isValid()) {
            $imageFooter = 'report_' . time() . '_footer.' . $this->reportFooter->getClientOriginalExtension();
            $this->reportFooter->storeAs('images/report', $imageFooter, 'public');
            $reportData['footer_image'] = $imageFooter;
        }

        if ($this->reportBackground && $this->reportBackground instanceof \Illuminate\Http\UploadedFile && $this->reportBackground->isValid()) {
            $imageBackground = 'report_' . time() . '_background.' . $this->reportBackground->getClientOriginalExtension();
            $this->reportBackground->storeAs('images/report', $imageBackground, 'public');
            $reportData['background_image'] = $imageBackground;
        }

        Report::updateOrCreate(
            ['user_id' => Auth::id()],
            $reportData
        );

        $this->dispatch('success', __('Report details saved successfully!'));
    }

    public function render()
    {
        return <<<'HTML'
            <form wire:submit.prevent="reportStore">
            <div class="row g-4 mt-3">
                <!-- Report Header -->
                <div class="col-md-4">
                    <h6>Report Header</h6>
                    <label type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" for="report-header">
                        <i class="bi bi-upload"></i> Click to Upload
                    </label>
                    <input type="file" id="report-header" wire:model="reportHeader" hidden>
                    <div class="d-flex align-items-center border p-2">
                        @if ($reportHeader)
                            <img src="{{ is_string($reportHeader) ? $reportHeader : $reportHeader->temporaryUrl() }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('assets/img/logo/default-image-path.jpg') }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                        @endif
                        <span>Report Header</span>
                        <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('reportHeader', null)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div wire:loading wire:target="reportHeader" class="text-primary mt-2">
                        <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                    </div>
                    <label for="headerHeight" class="form-label mt-3">Header Height</label>
                    <input type="number" class="form-control" id="headerHeight" wire:model="headerHeight">
                </div>

                <!-- Report Footer -->
                <div class="col-md-4">
                    <h6>Report Footer</h6>
                    <label type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" for="report-footer">
                        <i class="bi bi-upload"></i> Click to Upload
                    </label>
                    <input type="file" id="report-footer" wire:model="reportFooter" hidden>
                    <div class="d-flex align-items-center border p-2">
                        @if ($reportFooter)
                            <img src="{{ is_string($reportFooter) ? $reportFooter : $reportFooter->temporaryUrl() }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('assets/img/logo/default-image-path.jpg') }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                        @endif
                        <span>Report Footer</span>
                        <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('reportFooter', null)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div wire:loading wire:target="reportFooter" class="text-primary mt-2">
                        <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                    </div>
                    <label for="footerHeight" class="form-label mt-3">Footer Height</label>
                    <input type="number" class="form-control" id="footerHeight" wire:model="footerHeight">
                </div>

                <!-- Report Background -->
                <div class="col-md-4">
                    <h6>Report Background</h6>
                    <label type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" for="report-background">
                        <i class="bi bi-upload"></i> Click to Upload
                    </label>
                    <input type="file" id="report-background" wire:model="reportBackground" hidden>
                    <div class="d-flex align-items-center border p-2">
                        @if ($reportBackground)
                            <img src="{{ is_string($reportBackground) ? $reportBackground : $reportBackground->temporaryUrl() }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('assets/img/logo/default-image-path.jpg') }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                        @endif
                        <span>Report Background</span>
                        <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('reportBackground', null)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div wire:loading wire:target="reportBackground" class="text-primary mt-2">
                        <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                    </div>
                    <label for="fontSelect" class="form-label mt-3">Select Font</label>
                    <select class="form-select" id="fontSelect" wire:model="font">
                        <option>Roboto</option>
                        <option>Arial</option>
                        <option>Georgia</option>
                        <option>Times New Roman</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Report
                </button>
            </div>
        </form>
        HTML;
    }
}
