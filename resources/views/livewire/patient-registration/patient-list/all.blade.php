<div class="container mt-4">
    <h4 class="mb-3">Patient List</h4>
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-light border">Worksheet</button>
        <div class="d-flex gap-2">
            <input type="text" class="form-control" placeholder="Search by name or barcode">
            <select class="form-select">
                <option selected>All</option>
                <option>Option 1</option>
                <option>Option 2</option>
            </select>
        </div>
        <input type="date" class="form-control w-auto">
    </div>
    <div class="card">
        <div class="card-body p-3">
            <!-- Table Header -->
            <div class="row border-bottom pb-2">

                <div class="col"><strong>#</strong></div>
                <div class="col"><strong>Details</strong></div>
                <div class="col"><strong>Ref Doctor</strong></div>
                <div class="col"><strong>Test</strong></div>
                <div class="col"><strong>Amount</strong></div>
                <div class="col"><strong>Date</strong></div>
                <div class="col"><strong>Status</strong></div>
                <div class="col text-end"><strong>Action</strong></div>
            </div>

            @foreach ($patientDetails as $key => $patient)
            <div class="patient-section">
                <!-- Summary Row -->

                <div class="row border-bottom py-2">
                    <div class="col">
                        <button class="btn text-black toggle-details">+</button> {{$key + 1}}
                    </div>
                    <div class="col">{{ $patient->patient->user->name }} {{$patient->patient->user->lastname ? $patient->patient->user->lastname : ''}} , {{ $patient->patient->user->gender }}, {{ $patient->patient->age }} {{ $patient->patient->age_type }}</div>
                    <div class="col">{{ !empty($patient->organisation) ? $patient->organisation : '-' }}</div>
                    <div class="col">
                        @foreach($patient->testbill as $bill)
                        @php
                        $testName = $bill->table_type == 'test' ? $bill->test->title : $bill->package->title;
                        $statusInfo = getStatus($patient->status);
                        @endphp
                        <span class="btn btn-sm btn-warning mb-1" style="font-size: 9px;">{{ $testName }}</span>
                        @endforeach
                    </div>
                    <div class="col">{{ $patient->advanced_payment }}</div>
                    <div class="col">{{ \Carbon\Carbon::parse($patient->date)->format('d/m/Y h:i A') }}</div>
                    @php
                    $statusInfo = getStatus($patient->status);
                    @endphp
                    <div class="col"><span class="badge {{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span></div>
                    <div class="col text-end">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceModal" wire:click="$dispatch('bill-details',{id : {{ $patient->id }} })">Bill</button>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="details-section" style="display: none;">
                    <div class="row border-bottom py-2">
                        <div style="background-color: #F1F5F9;" class="d-flex justify-content-between px-4 py-2 align-items-center">
                            <!-- Left Content -->
                            <div class="d-flex flex-column">
                                <div class="row border-bottom py-2 ms-8">
                                    @php
                                    $class = $patient->created_by != '' ? 'col-6' : 'col-12';
                                    @endphp
                                    @if($patient->created_by)
                                    <div class="{{ $class }} ms-6">
                                        <div class="font-weight-bold"><strong>Created By : </strong>{{ $patient->created_by }}</div>
                                    </div>
                                    @endif

                                    <div class="{{ $class }}">
                                        @if($patient->sampleCollector)
                                        <div class="font-weight-bold"><strong>Sample Collector : </strong>{{ $patient->sampleCollector }}</div>
                                        @endif

                                        @if($patient->collectedat)
                                        <div class="font-weight-bold"><strong>Collected At: </strong>{{ $patient->collectedat }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Right Buttons -->
                            <div class="row gap-2 mt-2">
                                <button class="btn btn-secondary btn-sm">Print Report</button>
                                <a href="{{route('admin.patientdetails',$patient->patient->id)}}" class="btn btn-info btn-sm">Details</a>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" wire:click="$dispatch('update-patient',{id : {{ $patient->id }} })" data-bs-target="#editPatientModal">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    document.querySelectorAll(".toggle-details").forEach(button => {
                        button.addEventListener("click", function() {
                            const detailsSection = this.closest(".patient-section").querySelector(".details-section");
                            if (detailsSection.style.display === "none") {
                                detailsSection.style.display = "block";
                                this.textContent = "-"; // Change button text to "-"
                            } else {
                                detailsSection.style.display = "none";
                                this.textContent = "+"; // Change button text to "+"
                            }
                        });
                    });
                });
            </script>


            <livewire:patient-registration.patient-list.update />
            <livewire:patient-registration.patient-list.bill-preview />
            <livewire:patient-registration.patient-list.update-bill />
        </div>
        

    </div>