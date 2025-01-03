<?php

namespace App\Livewire\LabProfile;

use Picqer\Barcode\BarcodeGeneratorPNG;
use Livewire\Component;

class PatientDetails extends Component
{
    public $patient = [
        'name' => 'Mr. Ayush',
        'ageGender' => '22/Male',
        'referredBy' => 'Self',
        'phone' => '9876XXXXXX',
        'patientId' => 'PN2',
        'reportId' => 'RE108',
        'collectionDate' => '29/05/2023 09:12 PM',
        'reportDate' => '09/05/2023 07:47 PM'
    ];

    public function render()
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode('PN2', BarcodeGeneratorPNG::TYPE_CODE_128));

        $html = '
            <div class="container my-4 p-0">
                <h3 class="mb-3">Report Layout</h3>
                <div class="row">
                    <!-- Design Section -->
                    <div class="col-md-12">
                        <div class="card border-secondary mb-3">
                            <div class="card-body">
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
                        </div>
                        <livewire:lab-profile.patient-design/>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#designModal">Choose Design</button>
                    </div>

                    <!-- Settings Section -->
                    <div class="col-md-12 mt-5">
                        <h5>Settings</h5>
                        <form>
                            <div class="mb-3">
                                <label for="fontSize" class="form-label">Font Size</label>
                                <input type="number" class="form-control" id="fontSize" value="10">
                            </div>
                            <div class="mb-3">
                                <label for="spacing" class="form-label">Spacing</label>
                                <input type="number" class="form-control" id="spacing" value="4">
                            </div>
                            <div class="mb-3">
                                <label for="qrSize" class="form-label">QR Code Size (px)</label>
                                <input type="number" class="form-control" id="qrSize" value="50">
                            </div>
                            <div class="mb-3">
                                <label for="innerPadding" class="form-label">Inner Padding</label>
                                <input type="number" class="form-control" id="innerPadding" value="10">
                            </div>
                            <div class="mb-3">
                                <label for="bottomMargin" class="form-label">Bottom Margin</label>
                                <input type="number" class="form-control" id="bottomMargin" value="5">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        ';

        return $html;
    }
}
