<?php

namespace App\Livewire\LabProfile;

use App\Models\BillDetails as ModelsBillDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BillDetails extends Component
{
    use WithFileUploads;

    public $sign;
    public $bill_size;
    public $bill_heading;
    public $gst;
    public $name;
    public $billHeader;
    public $billFooter;
    public $headerHeight = null; // Nullable
    public $footerHeight = null; // Nullable
    public $showGST = 0;
    public $isVisible = false;

    protected $rules = [
        'bill_size' => 'required',
        'bill_heading' => 'nullable|string|min:0|max:500',
        'sign' => 'nullable|image|max:1024', // Max 1MB
        'name' => 'nullable|string',
        'gst' => 'nullable|string',
        'billHeader' => 'nullable|image|max:1024',
        'billFooter' => 'nullable|image|max:1024',
        'headerHeight' => 'nullable|integer|min:0|max:500',
        'footerHeight' => 'nullable|integer|min:0|max:500',
    ];

    public function mount()
    {
        $billDetails = ModelsBillDetails::where('user_id', Auth::id())->first();
        if ($billDetails) {
            $this->bill_size = $billDetails->bill_size;
            $this->bill_heading = $billDetails->bill_heading;
            $this->gst = $billDetails->gst;
            $this->name = $billDetails->name;
            $this->showGST = $billDetails->show_gst;
            $this->headerHeight = $billDetails->header_height;
            $this->footerHeight = $billDetails->footer_height;
            $this->billHeader = $billDetails->bill_header;
            $this->billFooter = $billDetails->bill_footer;
        }
    }

    public function toggleVisibility()
    {
        $this->isVisible = !$this->isVisible;
    }

    public function storeBill(): void
    {
        $this->validate();

        $userId = Auth::id();


        $billHeaderPath = $this->billHeader ? 'billHeader' . time() . '.' . $this->billHeader->getClientOriginalExtension() : null;
        $this->billHeader ? $this->billHeader->storeAs('image/header', $billHeaderPath, 'public') : null;

        $billFooterPath = $this->billFooter ? 'billFooter' . time() . '.' . $this->billFooter->getClientOriginalExtension() : null;
        $this->billFooter ? $this->billFooter->storeAs('image/footer', $billFooterPath, 'public') : null;




        $billDetails = ModelsBillDetails::updateOrCreate(
            ['user_id' => $userId], // Matching condition
            [
                'bill_size' => $this->bill_size,
                'bill_heading' => $this->bill_heading,
                'name' => $this->name,
                'gst' => $this->gst,
                'show_gst' => $this->showGST,
                'header_height' => $this->headerHeight,
                'footer_height' => $this->footerHeight,
                'bill_header' => $billHeaderPath,
                'bill_footer' => $billFooterPath,

            ]
        );


        session()->flash('message', 'Bill details saved successfully.');
    }
    public function updateSignature()
    {


        $image = $this->sign ? 'sign_' . time() . '.' . $this->sign->getClientOriginalExtension() : null;
        $this->sign ? $this->sign->storeAs('image/sign', $image, 'public') : null;

        ModelsBillDetails::where('user_id', Auth::id())->update(['name' => $this->name, 'sign' => $image]);
        $this->dispatch('reset-modal-sign');
    }

    public function removeSignature()
    {
        $billDetails = ModelsBillDetails::where('user_id', Auth::id())->first();


        if ($this->sign && $billDetails && $billDetails->sign) {
            ModelsBillDetails::where('user_id', Auth::id())->update(['name' => $this->name, 'sign' => null]);
            Storage::disk('public')->delete('image/sign/' . $billDetails->sign);
        
        }
        $this->dispatch('reset-modal-sign');
    }
    public function toggleShowGst()
    {
        if ($this->showGST == 1) {
            $this->showGST = 0;
        } else {
            $this->showGST = 1;
        }
    }

    public function render()
    {
        return <<<'HTML'
        <div>
        <div class="container p-0 mt-4">
            <div class="row">
                <div class="col-md-12">
                    <h4>Bill Settings</h4>
                    <div class="card">
                        <div class="card-body">
                            <!-- Default/Custom Toggle -->
                            <div class="row mb-3">
                                <div class="col-6 d-flex align-items-center gap-2">
                                    <label for="" class="mb-0">Default</label>
                                    <a wire:click="toggleVisibility" class="cursor-pointer">
                                        @if($isVisible)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#0092FF"  class="bi bi-toggle-on " viewBox="0 0 16 16">
                                                <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8" />
                                            </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                                        <path d="M11 4a4 4 0 0 1 0 8H8a5 5 0 0 0 2-4 5 5 0 0 0-2-4zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8M0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5"/>
                                        </svg>
                                        @endif
                                    
                                    </a>
                                    <label for="" class="mb-0">Custom</label>
                                </div>
                            </div>

                            <!-- Toggleable Section -->
                            @if ($isVisible)
                            <div class="row mb-4">
                                <!-- Bill Header -->
                                <div class="col-md-6">
                                    <h6>Bill Header</h6>
                                    <label class="btn btn-outline-primary btn-sm w-100 mb-2" for="bill-header">
                                        <i class="bi bi-upload"></i> Click to Upload
                                    </label>
                                    <input type="file" id="bill-header" wire:model="billHeader" hidden>
                                    <div class="d-flex align-items-center border p-2">
                                        @if ($billHeader)
                                            <img src="{{ is_string($billHeader) ? $billHeader : $billHeader->temporaryUrl() }}" alt="Header Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                        @else
                                            <img src="{{ asset('assets/img/logo/default-image-path.jpg') }}" alt="Header Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                        @endif
                                        <span>Bill Header</span>
                                        <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('billHeader', null)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div wire:loading wire:target="billHeader" class="text-primary mt-2">
                                        <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                                    </div>
                                    <label for="headerHeight" class="form-label mt-3">Header Height</label>
                                    <input type="number" class="form-control" id="headerHeight" wire:model="headerHeight">
                                </div>

                                <!-- Bill Footer -->
                                <div class="col-md-6">
                                    <h6>Bill Footer</h6>
                                    <label class="btn btn-outline-primary btn-sm w-100 mb-2" for="bill-footer">
                                        <i class="bi bi-upload"></i> Click to Upload
                                    </label>
                                    <input type="file" id="bill-footer" wire:model="billFooter" hidden>
                                    <div class="d-flex align-items-center border p-2">
                                        @if ($billFooter)
                                            <img src="{{ is_string($billFooter) ? $billFooter : $billFooter->temporaryUrl() }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                        @else
                                            <img src="{{ asset('assets/img/logo/default-image-path.jpg') }}" alt="Footer Preview" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                        @endif
                                        <span>Bill Footer</span>
                                        <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('billFooter', null)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div wire:loading wire:target="billFooter" class="text-primary mt-2">
                                        <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                                    </div>
                                    <label for="footerHeight" class="form-label mt-3">Footer Height</label>
                                    <input type="number" class="form-control" id="footerHeight" wire:model="footerHeight">
                                </div>
                            </div>
                            @endif

                            <!-- Additional Settings -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="billHeading" class="form-label">Bill Heading</label>
                                    <input type="text" class="form-control" id="billHeading" wire:model="bill_heading" value="Invoice-cum-receipt">
                                    @error('bill_heading')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="billSize" class="form-label">Bill Size</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model="bill_size" id="billSizeA4" value="A4" checked>
                                        <label class="form-check-label" for="billSizeA4">A4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model="bill_size" id="billSizeA5" value="A5">
                                        <label class="form-check-label" for="billSizeA5">A5</label>
                                    </div>
                                </div>
                            </div>

                            <!-- GST Section -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="gstNumber" class="form-label">GST Number</label>
                                    <input type="text" class="form-control" wire:model="gst" id="gstNumber">
                                    @error('gst')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="col-6 d-flex align-items-center gap-2">
                                    <label for="" class="mb-0">Show GST on Bill</label>
                                    <a wire:click="toggleShowGst" class="cursor-pointer">
                                    @if($showGST == 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                                    <path d="M11 4a4 4 0 0 1 0 8H8a5 5 0 0 0 2-4 5 5 0 0 0-2-4zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8M0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5"/>
                                    </svg>
                
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#0092FF" class="bi bi-toggle-on" viewBox="0 0 16 16">
                                            <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8" />
                                        </svg>
                                      
                                    @endif
                                </a>

                                </div>
                            </div>

                            <!-- Footer Buttons -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSignature">
                                        <i class="bi bi-plus"></i> Add Signature
                                    </button>
                                    <button wire:click="storeBill" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>

            <div wire:ignore.self class="modal fade" id="addSignature" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Add Signature</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">

                            <div class="row g-3">

                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name <span class="text-danger"></span></label>
                                    <input type="text" id="name" class="form-control" wire:model="name" placeholder="Name">
                                    @error('name')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Signature -->
                                <div class="col-md-4">
                                    <h6>Signature</h6>
                                    <label type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" for="sign">
                                        <i class="bi bi-upload"></i> Click to Upload
                                    </label>
                                    <input type="file" id="sign" wire:model="sign" hidden>
                                    <div class="d-flex align-items-center border p-2">
                                        @if ($sign)
                                            <img src="{{ $sign->temporaryUrl() }}" alt="sign" class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                        @else
                                            <i class="bi bi-image fs-3 me-2"></i>
                                        @endif
                                        <span>Signature</span>
                                        <button type="button" class="btn btn-sm btn-danger ms-auto" wire:click="$set('sign', null)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div wire:loading wire:target="sign" class="text-primary mt-2">
                                        <i class="bi bi-arrow-repeat animate-spin"></i> Uploading...
                                    </div>
                                    @error('sign')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    <div class="mt-3">
                                @if($sign)
                                    <button type="button" wire:click="removeSignature" class="btn btn-black">
                                        <i class="bi bi-trash">remove sign</i>
                                    </button>
                                @endif
                            </div>
                                </div>

                            </div>
                           

                            <!-- Submit Button -->
                            <div class="text-end mt-4">
                                <button wire:click="updateSignature" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Save
                                </button>
                            </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Livewire Script -->
        @script
        <script>
            document.addEventListener('livewire:initialized', () => {
                $wire.on('reset-modal-sign', () => {
                    $('#addSignature').modal('hide');
                });
            });
        </script>
        @endscript


        </div>
        HTML;
    }
}
