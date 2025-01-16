<div>
    <div wire:ignore.self class="container mt-4">
        <h4>Register New Patient</h4>
        <div class="mb-3">
            <input type="text" wire:model.live="keyword" class="form-control" placeholder="Search patient by phone number or name">
            @if($users)
            <ul class="bg-white border mt-1 rounded">
                @foreach($users as $user)
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                    wire:click="selectUser({{ $user->id }})">
                    {{ $user->name }} | {{'Mobile:'. $user->mobile }} | {{'Email:'.$user->email}}
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="d-flex justify-content-between mb-3">
            <span>Patient ID <strong>241218002</strong></span>
            <!-- Button to trigger the modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quotationModal">
                Quotation
            </button>
        </div>

        <form wire:submit.prevent="submit">
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
                        <input class="form-check-input" type="radio" wire:model="gender" id="other" value="other" checked>
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
                        <option value="year">Year</option>
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
                    <input type="email" wire:model.live="email" class="form-control" id="email" placeholder="Email ID" >
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
                <div class="col-md-3">
                    <label for="sampleCollector" class="form-label">Select Sample Collector</label>
                    <div class="d-flex">
                        <select class="form-select" wire:model="sampleCollector" id="sampleCollector">
                            <option>Select Sample Collector</option>
                            @foreach ($sampleCollectorlist as $sample )
                            <option value="{{$sample->name}}">{{$sample->name}}</option>

                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sampleCollectorModal">
                            +
                        </button>
                    </div>
                    @error('sampleCollector')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="organisation" class="form-label">Select Organisation</label>
                    <div class="d-flex">
                        <select class="form-select" wire:model="organisation" id="organisation">
                            <option value="" selected>Select Organisation</option>
                            @foreach ($organisationlist as $org )
                            <option class="mb-4" value="{{$org->name}}">{{$org->name}}({{$org->ref_type}})</option>

                            @endforeach

                        </select>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addorganisation">
                            +
                        </button>
                    </div>
                    @error('organisation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="collectedAt" class="form-label">Collected at</label>
                    <div class="d-flex">
                        <select class="form-select" wire:model="collectedat" id="collectedAt">
                            <option value="Labs" selected>Select Collected at</option>
                            @foreach ( $collectAt as $collect )
                            <option value="{{$collect->address}}">{{$collect->address}}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#collectedAtModal">
                            +
                        </button>

                    </div>
                    @error('collectedat')
                    <span class="error">{{ $message }}</span>
                    @enderror

                </div>

                <div class="col-md-3">
                    <label for="b2bCenter" wire:model="b2bCenter" class="form-label">Select B2B Center</label>
                    <select class="form-select" id="b2bCenter">
                        <option value="null" selected>Select B2B Center</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal">
                    Go to billing
                </button>


            </div>
        </form>
        <livewire:patient-registration.quotation.add />
        <livewire:patient-registration.sample-collector.add />
        <livewire:patient-registration.organisation.add />
        <livewire:patient-registration.collected-at.add />
        <livewire:patient-registration.billing />
        <livewire:patient-registration.quotation.pdf />
        <livewire:patient-registration.patient-list.bill-preview/>
        <livewire:patient-registration.patient-list.update-bill/>


    </div>
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            $wire.on('open-bill-modal', () => {
                $('#billingModal').modal('show');
            });
        });
        document.addEventListener('livewire:initialized', () => {
            $wire.on('close-bill-modal', () => {
                $('#billingModal').modal('hide');
            });
        });

        document.addEventListener('livewire:initialized', () => {
            $wire.on('open-pdf-quotation', () => {
                $('#pdfModal').modal('show');
            });
        });
        document.addEventListener('livewire:initialized', () => {
            $wire.on('open-pdf-billing', () => {
                $('#invoiceModal').modal('show');
            });
        });
    </script>
    @endscript

</div>