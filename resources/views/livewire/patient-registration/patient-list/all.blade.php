<div>
    <div class="container mt-4">
        <h4 class="mb-3 text-primary">Patient List</h4>

        <!-- Filters Section -->
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <button class="btn btn-light border">Worksheet</button>

            <!-- Search and Filters -->
            <div class="d-flex gap-2 align-items-center">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Search by name or barcode">
                <select wire:model.live="filterStatus" class="form-select">
                    <option value="">All Status</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="review">Review</option>
                    <option value="issue">Issue</option>
                    <option value="resolved">Resolved</option>
                    <option value="completed">Completed</option>
                    <option value="delivered">Delivered</option>
                    <option value="partial">Partial</option>
                </select>
                <input type="date" wire:model.live="filterDate" class="form-control">
            </div>
        </div>

        <!-- Patient List Card -->
        <div class="card shadow-sm">
            <div class="card-body">
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

                @forelse ($patientDetails as $key => $patient)
                <!-- Patient Summary Row -->
                <div class="row py-3 border-bottom align-items-center patient-section">
                    <div class="col">
                        <div class="d-flex gap-4 align-items-center">
                            <button class="btn btn-sm btn-outline-primary toggle-details">+</button>
                            {{ $key + 1 }}
                        </div>
                    </div>
                    <div class="col">
                        <strong>{{ $patient->patient->user->name }} {{ $patient->patient->user->lastname ?? '' }}</strong>
                        <br>
                        <span class="text-muted small">
                            {{ $patient->patient->user->gender }}, {{ $patient->patient->age }} {{ $patient->patient->age_type }}
                        </span>
                    </div>
                    <div class="col">{{ $patient->organisation ?: '-' }}</div>
                    <div class="col">
                        @foreach ($patient->testbill as $bill)
                        @php
                        $testName = $bill->table_type == 'test' ? $bill->test->title : $bill->package->title;
                        @endphp
                        <span class="badge bg-warning text-dark mb-1">{{ $testName }}</span>
                        @endforeach
                    </div>
                    <div class="col">₹{{ $patient->advanced_payment }}</div>
                    <div class="col">{{ \Carbon\Carbon::parse($patient->date)->format('d/m/Y h:i A') }}</div>
                    <div class="col">
                        @php $statusInfo = getStatus($patient->status); @endphp
                        <span class="badge {{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span>
                    </div>
                    <div class="col text-end">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#invoiceModal"
                            wire:click="$dispatch('bill-details', { id: {{ $patient->id }} })">
                            Bill
                        </button>
                    </div>
                </div>

                <!-- Patient Details Row -->
                <div class="details-section bg-light px-3 py-2 border rounded d-none">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Left Details -->
                        <div>
                            <div><strong>Created By:</strong> {{ $patient->created_by ?? 'N/A' }}</div>
                            <div><strong>Sample Collector:</strong> {{ $patient->sampleCollector ?? 'N/A' }}</div>
                            <div><strong>Collected At:</strong> {{ $patient->collectedat ?? 'N/A' }}</div>
                        </div>
                        <!-- Right Actions -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-secondary btn-sm">Print Report</button>
                            <a href="{{ route('admin.patientdetails', $patient->patient->id) }}"
                                class="btn btn-info btn-sm">Details</a>
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                wire:click="$dispatch('update-patient', { id: {{ $patient->id }} })"
                                data-bs-target="#editPatientModal">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <em>No records found.</em>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Toggle Details Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".toggle-details").forEach(button => {
                button.addEventListener("click", function() {
                    const detailsSection = this.closest(".patient-section").nextElementSibling;
                    if (detailsSection.classList.contains("d-none")) {
                        detailsSection.classList.remove("d-none");
                        this.textContent = "-";
                    } else {
                        detailsSection.classList.add("d-none");
                        this.textContent = "+";
                    }
                });
            });
        });
    </script>
    <livewire:patient-registration.patient-list.update />
    <livewire:patient-registration.patient-list.bill-preview />
    <livewire:patient-registration.patient-list.update-bill />

</div>