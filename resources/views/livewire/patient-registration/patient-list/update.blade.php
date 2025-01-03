<div>
<div wire:ignore.self class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPatientModalLabel">Register New Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Patient ID <strong>241218002</strong></span>
                    </div>

                    <form wire:submit.prevent="updatePatient">
                        <div class="row g-3">
                            <!-- Designation -->
                            <div class="col-md-2">
                                <label for="designation" class="form-label">Designation</label>
                                <select class="form-select" wire:model="designation" id="designation">
                                    <option value="null" disabled>Select</option>
                                    <option value="Mr">MR.</option>
                                    <option value="Ms">MS.</option>
                                    <option value="Mrs">MRS.</option>
                                </select>
                                @error('designation')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- First Name -->
                            <div class="col-md-5">
                                <label for="firstName" class="form-label">* First Name</label>
                                <input type="text" class="form-control" wire:model="firstname" id="firstName" placeholder="First Name">
                                @error('firstname')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-5">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" wire:model="lastname" id="lastName" placeholder="Last Name">
                                @error('lastname')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Phone Number -->
                            <div class="col-md-4">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">IN +91</span>
                                    <input type="number" maxlength="10" wire:model.live="mobile" class="form-control" id="phoneNumber" placeholder="Phone Number">
                                </div>
                                @error('mobile')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Gender -->
                            <div class="col-md-4">
                                <label class="form-label d-block">* Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="gender" id="other" value="other">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                                @error('gender')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Age -->
                            <div class="col-md-2">
                                <label for="age" class="form-label">* Age</label>
                                <input type="number" wire:model="age" class="form-control" id="age" placeholder="Age">
                                @error('age')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Age Type -->
                            <div class="col-md-2">
                                <label for="ageType" class="form-label">* Age Type</label>
                                <select class="form-select" wire:model="age_type" id="ageType">
                                    <option value="null" disabled>Select</option>
                                    <option value="years">Years</option>
                                    <option value="month">Month</option>
                                    <option value="day">Day</option>
                                </select>
                                @error('age_type')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email ID</label>
                                <input type="email" wire:model.live="email" class="form-control" id="email" placeholder="Email ID" readonly>
                                @error('email')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Address -->
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" wire:model="address" id="address" rows="2"></textarea>
                                @error('address')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       

                        <!-- Dropdown Selects -->
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="sampleCollector" class="form-label">Select Sample Collector</label>
                                <div class="d-flex">
                                    <select class="form-select" wire:model="sampleCollector" id="sampleCollector">
                                        <option>Select Sample Collector</option>
                                        @foreach ($sampleCollectorlist as $sample)
                                        <option value="{{$sample->name}}">{{$sample->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('sampleCollector')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="organisation" class="form-label">Select Organisation</label>
                                <div class="d-flex">
                                    <select class="form-select" wire:model="organisation" id="organisation">
                                        <option value="null" selected>Select Organisation</option>
                                        @foreach ($organisationlist as $org)
                                        <option class="mb-4" value="{{$org->name}}">{{$org->name}}({{$org->ref_type}})</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('organisation')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="collectedAt" class="form-label">Collected at</label>
                                <div class="d-flex">
                                    <select class="form-select" wire:model="collectedat" id="collectedAt">
                                        <option value="Labs" selected>Select Collected at</option>
                                        @foreach ($collectAt as $collect)
                                        <option value="{{$collect->address}}">{{$collect->address}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('collectedat')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <!-- Submit Button -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                               save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('reset-modal-patientdetail', () => {
            $('#editPatientModal').modal('hide');
        });
    });
</script>
@endscript
</div>