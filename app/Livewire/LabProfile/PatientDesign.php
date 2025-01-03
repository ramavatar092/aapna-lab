<?php

namespace App\Livewire\LabProfile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PatientDesign extends Component
{
    public $patient = [
        'name'           => 'Mr. Ayush',
        'ageGender'      => '22/Male',
        'referredBy'     => 'Self',
        'phone'          => '9876XXXXXX',
        'patientId'      => 'PN2',
        'reportId'       => 'RE108',
        'collectionDate' => '29/05/2023 09:12 PM',
        'reportDate'     => '09/05/2023 07:47 PM'
    ];

    public function render()
    {
        $barcode = generatorBarcode(Auth::id(), 'TYPE_EAN_13');

        $html = '<div class="modal fade" id="designModal" tabindex="-1" aria-labelledby="designModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="designModalLabel">Report Design Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Design Options -->
                        <form wire:submit.prevent="saveSelection">
                            <!-- First Design -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="designOption" id="design1" checked>
                                <label class="form-check-label w-100" for="design1">
                                    <div class="card p-3 border-secondary">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-1"><strong>Name :</strong> ' . $this->patient['name'] . '</p>
                                                <p class="mb-1"><strong>Age/Gender :</strong> ' . $this->patient['ageGender'] . '</p>
                                                <p class="mb-1"><strong>Referred By :</strong> ' . $this->patient['referredBy'] . '</p>
                                                <p class="mb-1"><strong>Phone No. :</strong> ' . $this->patient['phone'] . '</p>
                                            </div>
                                            <div>
                                                <p class="mb-1"><strong>Patient ID :</strong> ' . $this->patient['patientId'] . '</p>
                                                <p class="mb-1"><strong>Report ID :</strong> ' . $this->patient['reportId'] . '</p>
                                                <p class="mb-1"><strong>Collection Date :</strong> ' . $this->patient['collectionDate'] . '</p>
                                                <p class="mb-1"><strong>Report Date :</strong> ' . $this->patient['reportDate'] . '</p>
                                            </div>
                                            <div>
                                                <img src="data:image/png;base64,' . $barcode . '" alt="Barcode">
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <!-- Second Design -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="designOption" id="design2">
                                <label class="form-check-label w-100" for="design2">
                                    <div class="card p-3 border-secondary">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-1"><strong>Name :</strong> ' . $this->patient['name'] . '</p>
                                                <p class="mb-1"><strong>Age/Gender :</strong> ' . $this->patient['ageGender'] . '</p>
                                                <p class="mb-1"><strong>Referred By :</strong> ' . $this->patient['referredBy'] . '</p>
                                                <p class="mb-1"><strong>Phone No. :</strong> ' . $this->patient['phone'] . '</p>
                                            </div>
                                            <div>
                                                <p class="mb-1"><strong>Patient ID :</strong> ' . $this->patient['patientId'] . '</p>
                                                <p class="mb-1"><strong>Report ID :</strong> ' . $this->patient['reportId'] . '</p>
                                                <p class="mb-1"><strong>Collection Date :</strong> ' . $this->patient['collectionDate'] . '</p>
                                                <p class="mb-1"><strong>Report Date :</strong> ' . $this->patient['reportDate'] . '</p>
                                            </div>
                                            <div>
                                                <img src="data:image/png;base64,' . $barcode . '" alt="Barcode">
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Repeat for more designs as needed -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Selection</button>
                    </div>
                </div>
            </div>
        </div>';

        return $html;
    }

    public function saveSelection()
    {
        dd('ooo');
    }
}
