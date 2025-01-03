<?php

namespace App\Livewire\LabProfile;

use App\Models\DoctorDetail as ModelsDoctorDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class DoctorDetails extends Component
{
    use WithFileUploads;
    public $doctor_name;
    public $degree;
    public $signature;
    public $position;
    public $doctor_name_font;
    public $degree_font_size;
    public $spacing;
    public $space_name_degree;
    public $alignment;
    public $signature_setting;
    public $end_of_report = false;
    public $department;
    public $user;

    protected $rules = [
        'doctor_name' => 'required|string|max:255',
        'degree' => 'required|string|max:255',
        'signature' => 'nullable|file|image|max:1024',
        'position' => 'required|in:left,middle,right',
        'doctor_name_font' => 'required|integer|min:8|max:72',
        'degree_font_size' => 'required|integer|min:8|max:72',
        'spacing' => 'required|integer|min:0|max:100',
        'space_name_degree' => 'required|integer|min:0|max:100',
        'alignment' => 'required|in:left,center,right',
        'signature_setting' => 'required|in:fixed,select',
        'department' => 'nullable|string',
    ];

    public function store()
    {
       $this->validate();

        $image = $this->signature ? 'sign_' . time() . '.' . $this->signature->getClientOriginalExtension():null;
        $this->signature ? $this->signature->storeAs('image/sign', $image, 'public') : null ;





        ModelsDoctorDetail::create(

            [
                'doctor_name' => $this->doctor_name,
                'degree' => $this->degree,
                'sign' => $image,
                'position' => $this->position,
                'doctor_name_font' => $this->doctor_name_font,
                'degree_font_size' => $this->degree_font_size,
                'spacing' => $this->spacing,
                'space_name_degree' => $this->space_name_degree,
                'alignment' => $this->alignment,
                'signature_setting' => $this->signature_setting,
                'end_of_report' => $this->end_of_report,
                'department' => $this->department,
                'user' => $this->user,
                'user_id' => Auth::id(),'id'=>1
            ],
        );

        // $this->reset();



        session()->flash('success', 'Doctor details saved successfully!');
    }


    public function render()
    {
        return <<<'HTML'
        <div>
        <div class="container p-0 mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Doctor Details</h4>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="row mb-3 col-12">
                                    <div class="col-4">
                                        <label for="doctorName">Doctor Name</label>
                                        <input type="text" class="form-control" id="doctorName" wire:model="doctor_name">
                                        @error('doctor_name')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="degree">Degree</label>
                                        <input type="text" class="form-control" id="degree" wire:model="degree">
                                        @error('degree')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                    <h6>signature</h6>
                                    <label type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" for="sign">
                                        <i class="bi bi-upload"></i> Click to Upload
                                    </label>
                                    <input type="file" id="sign" wire:model="signature" hidden>
                                    <div class="d-flex align-items-center border p-2">
                                        @if ($signature)
                                            <img src="{{ $sign->temporaryUrl() }}" alt="sign" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                        @else
                                            <i class="bi bi-image fs-3 me-2"></i>
                                        @endif
                                        <span>Signature</span>
                                        <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('sign', null)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div wire:loading wire:target="signature" class="text-primary mt-2">
                                        <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                                    </div>
                                    @error('signature')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                                </div>
                                <div class="row mb-3">
                                <div class="col-6">
                                    <label for="position">Position</label>
                                    <div class="btn-group w-100" role="group" aria-label="Position">
                                        <!-- Left -->
                                        <input type="radio" class="btn-check" wire:model="position" id="positionLeft" value="left" autocomplete="off" >
                                        <label class="btn btn-outline-primary" for="positionLeft">Left</label>

                                        <!-- Middle -->
                                        <input type="radio" class="btn-check" wire:model="position" id="positionMiddle" value="middle" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="positionMiddle">Middle</label>

                                        <!-- Right -->
                                        <input type="radio" class="btn-check" wire:model="position" id="positionRight" value="right" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="positionRight">Right</label>
                                    </div>

                                    <!-- Error Message -->
                                    @error('position')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="doctorNameFontSize">Doctor Name font size</label>
                                        <input type="number" class="form-control" id="doctorNameFontSize" wire:model="doctor_name_font">
                                    </div>
                                    <div class="col-4">
                                        <label for="degreeFontSize">Degree font size</label>
                                        <input type="number" class="form-control" id="degreeFontSize" wire:model="degree_font_size">
                                    </div>
                                    <div class="col-4">
                                        <label for="spacing">Spacing</label>
                                        <input type="number" class="form-control" id="spacing" wire:model="spacing">
                                        @error('spacing')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="spacingBwNameDegree">Spacing b/w Doctor name & Degree</label>
                                        <input type="number" class="form-control" id="spacingBwNameDegree" wire:model="space_name_degree">
                                    </div>
                                    <div class="col-6">
                                        <label for="alignment">Alignment</label>
                                    <div class="btn-group" role="group" aria-label="Alignment">
                                        <input type="radio" class="btn-check" wire:model="alignment" id="alignLeft" value="left" autocomplete="off" >
                                        <label class="btn btn-secondary" for="alignLeft">Left</label>

                                        <input type="radio" class="btn-check" wire:model="alignment" id="alignCenter" value="center" autocomplete="off">
                                        <label class="btn btn-secondary" for="alignCenter">Center</label>

                                        <input type="radio" class="btn-check" wire:model="alignment" id="alignRight" value="right" autocomplete="off">
                                        <label class="btn btn-secondary" for="alignRight">Right</label>
                                    </div>

                                    @error('alignment')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="signatureSetting">Signature Setting:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="signature_setting" id="signature_setting" value="fixed" checked>
                                            <label class="form-check-label" for="signature_setting">Fixed</label>

                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="signature_setting" id="signatureSettingSelect" value="select">
                                            <label class="form-check-label" for="signature_setting">Select</label>

                                        </div>
                                        @error('signatureSetting')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="endOfReport">End of Report</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" wire:model="end_of_report" type="checkbox" id="endOfReport">
                                            <label class="form-check-label" for="endOfReport">Yes</label>
                                            @error('end_of_report')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="department">Department</label>
                                        <select class="form-select" wire:model="department" id="department">
                                            <option value="all">All</option>
                                            @error('department')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="user">User</label>
                                        <select class="form-select" id="user">
                                            <option value="all">All</option>
                                        </select>
                                        @error('user')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">

                                        <button wire:click="store" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        HTML;
    }
}
