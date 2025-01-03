<?php

namespace App\Livewire\LabProfile;

use Illuminate\Support\Facades\Auth;
use App\Models\ReportInterpretation as ModelsReportInterpretation;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReportInterpretation extends Component
{
    use WithFileUploads;

    public $interpretationHeadingFontSize, $interpretationContentFontSize;
    public $noteHeadingFontSize, $noteContentFontSize;
    public $logo, $logoSize, $logoMargin;
    public $topMargin;

    protected $rules = [
        'interpretationHeadingFontSize' => 'required|integer|min:1|max:100',
        'interpretationContentFontSize' => 'required|integer|min:1|max:100',
        'noteHeadingFontSize'           => 'required|integer|min:1|max:100',
        'noteContentFontSize'           => 'required|integer|min:1|max:100',
        'logo'                          => 'nullable|image|max:2048',
        'logoSize'                      => 'required|integer|min:1|max:500',
        'logoMargin'                    => 'required|integer|min:0|max:100',
        'topMargin'                     => 'required|integer|min:0|max:100',
    ];

    protected $messages = [
        'interpretationHeadingFontSize.required' => 'The interpretation heading font size is required.',
        'interpretationHeadingFontSize.integer'  => 'The interpretation heading font size must be a number.',
        'interpretationHeadingFontSize.min'      => 'The interpretation heading font size must be at least 1.',
        'interpretationHeadingFontSize.max'      => 'The interpretation heading font size must not exceed 100.',

        'interpretationContentFontSize.required' => 'The interpretation content font size is required.',
        'interpretationContentFontSize.integer'  => 'The interpretation content font size must be a number.',
        'interpretationContentFontSize.min'      => 'The interpretation content font size must be at least 1.',
        'interpretationContentFontSize.max'      => 'The interpretation content font size must not exceed 100.',

        'noteHeadingFontSize.required' => 'The note heading font size is required.',
        'noteHeadingFontSize.integer'  => 'The note heading font size must be a number.',
        'noteHeadingFontSize.min'      => 'The note heading font size must be at least 1.',
        'noteHeadingFontSize.max'      => 'The note heading font size must not exceed 100.',

        'noteContentFontSize.required' => 'The note content font size is required.',
        'noteContentFontSize.integer'  => 'The note content font size must be a number.',
        'noteContentFontSize.min'      => 'The note content font size must be at least 1.',
        'noteContentFontSize.max'      => 'The note content font size must not exceed 100.',

        'logo.image'                   => 'The logo must be a valid image file.',
        'logo.max'                     => 'The logo must not exceed 2 MB.',

        'logoSize.required'            => 'The logo size is required.',
        'logoSize.integer'             => 'The logo size must be a number.',
        'logoSize.min'                 => 'The logo size must be at least 1.',
        'logoSize.max'                 => 'The logo size must not exceed 500.',

        'logoMargin.required'          => 'The logo margin is required.',
        'logoMargin.integer'           => 'The logo margin must be a number.',
        'logoMargin.min'               => 'The logo margin must be at least 0.',
        'logoMargin.max'               => 'The logo margin must not exceed 100.',

        'topMargin.required'           => 'The top margin is required.',
        'topMargin.integer'            => 'The top margin must be a number.',
        'topMargin.min'                => 'The top margin must be at least 0.',
        'topMargin.max'                => 'The top margin must not exceed 100.',
    ];

    public function mount()
    {
        $reportInterpretation = ModelsReportInterpretation::where('user_id', Auth::id())->first();
        if(!empty($reportInterpretation)){
            $this->interpretationHeadingFontSize = $reportInterpretation->interpretation_heading_font_size;
            $this->interpretationContentFontSize = $reportInterpretation->interpretation_content_font_size;
            $this->noteHeadingFontSize           = $reportInterpretation->note_heading_font_size;
            $this->noteContentFontSize           = $reportInterpretation->note_content_font_size;
            $this->logo                          = $reportInterpretation->logo;
            $this->logoSize                      = $reportInterpretation->logo_size;
            $this->logoMargin                    = $reportInterpretation->logo_margin;
            $this->topMargin                     = $reportInterpretation->top_margin;
        }
    }

    public function saveData()
    {
        $imageLogo = $this->logo ? 'logo_' . time() . '.' . $this->logo->getClientOriginalExtension() : null;
        $this->logo ? $this->logo->storeAs('images/report', $imageLogo, 'public') : null;

        $this->validate();

        ModelsReportInterpretation::updateOrCreate(
            [
                'user_id' => Auth::id(),
            ],
            [
                'interpretation_heading_font_size' => $this->interpretationHeadingFontSize,
                'interpretation_content_font_size' => $this->interpretationContentFontSize,
                'note_heading_font_size'           => $this->noteHeadingFontSize,
                'note_content_font_size'           => $this->noteContentFontSize,
                'logo'                             => $imageLogo,
                'logo_size'                        => $this->logoSize,
                'logo_margin'                      => $this->logoMargin,
                'top_margin'                       => $this->topMargin,
            ]
        );

        $this->dispatch('success', __('Report Interpretation saved successfully!'));
    }

    public function render()
    {
        return <<<'HTML'
        <div class="col-md-12">
            <h4 class="mb-3 mt-5">Interpretation</h4>
            <form wire:submit.prevent="saveData">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Font Size Settings -->
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="interpretation_heading_font_size" class="form-label">Heading Font Size</label>
                                <input type="number" class="form-control" id="interpretation_heading_font_size"
                                    wire:model="interpretationHeadingFontSize">
                                @error('interpretationHeadingFontSize')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="interpretation_content_font_size" class="form-label">Content Font Size</label>
                                <input type="number" class="form-control" id="interpretation_content_font_size"
                                    wire:model="interpretationContentFontSize">
                                @error('interpretationContentFontSize')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Note/Comment Section -->
                        <div class="row mb-4">
                            <h6>Note/Comment</h6>
                            <div class="col-6">
                                <label for="note_heading_font_size" class="form-label">Heading Font Size</label>
                                <input type="number" class="form-control" id="note_heading_font_size"
                                    wire:model="noteHeadingFontSize">
                                @error('noteHeadingFontSize')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="note_content_font_size" class="form-label">Content Font Size</label>
                                <input type="number" class="form-control" id="note_content_font_size"
                                    wire:model="noteContentFontSize">
                                @error('noteContentFontSize')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Logo Upload -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <p>Logo</p>
                                <label type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" for="logo">
                                    <i class="bi bi-upload"></i> Click to Upload
                                </label>
                                <input type="file" id="logo" wire:model="logo" hidden>
                                <div class="d-flex align-items-center border p-2">
                                    @if ($logo)
                                        <img src="{{ is_string($logo) ? $logo : $logo->temporaryUrl() }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                    @else
                                        <img src="{{ asset('assets/img/logo/default-image-path.jpg') }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                    @endif

                                    <span>Logo</span>
                                    <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('logo', null)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <div wire:loading wire:target="logo" class="text-primary mt-2">
                                <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                            </div>
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Logo Settings -->
                            <div class="col-6">
                                <label for="logo_size" class="form-label">Logo Size (Height)</label>
                                <input type="number" class="form-control" id="logo_size" wire:model="logoSize">
                                @error('logoSize')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="logo_margin" class="form-label">Left Margin</label>
                                <input type="number" class="form-control" id="logo_margin" wire:model="logoMargin">
                                @error('logoMargin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Top Margin and Submit -->
                        <div class="mt-4 d-flex justify-content-between">
                            <div class="col-4 shadow-sm p-3">
                                <h5 class="mb-3 mt-5">Top Margin</h5>
                                <input type="number" class="form-control mb-3" wire:model="topMargin">
                                @error('topMargin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <button class="btn btn-primary w-20">Mapping</button>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        HTML;
    }
}
