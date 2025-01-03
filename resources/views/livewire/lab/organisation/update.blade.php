<div>
<div wire:ignore.self class="modal fade" id="updateOrganisationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header  text-white">
                <h5 class="modal-title">Edit {{ trans('cruds.organisation.title_singular') }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="row g-4">
                        <!-- Referral Type -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Referral Type <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input" wire:model="ref_type" type="radio" id="doctor" value="Doctor">
                                    <label class="form-check-label" for="doctor">Doctor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" wire:model="ref_type" type="radio" id="hospital" value="Hospital">
                                    <label class="form-check-label" for="hospital">Hospital</label>
                                </div>
                            </div>
                            @error('ref_type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="name" id="name" placeholder="Enter name">
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Degree -->
                        <div class="col-md-6">
                            <label for="degree" class="form-label fw-bold">Degree</label>
                            <input type="text" class="form-control" wire:model="degree" id="degree" placeholder="Enter degree">
                            @error('degree') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Compliment% -->
                        <div class="col-md-6">
                            <label for="compliment" class="form-label fw-bold">Compliment% <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="compliment" id="compliment" placeholder="Enter compliment percentage">
                            @error('compliment') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" class="form-control" wire:model="address" placeholder="Enter address" rows="3"></textarea>
                            @error('address') 
                                <div class="text-danger mt-1">
                                    <small>{{ $message }}</small>
                                </div> 
                            @enderror
                        </div>

                    <!-- Toggles -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="clearDue" wire:model="clear_due">
                                <label class="form-check-label fw-bold" for="clearDue">Clear Due</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="financialAnalysis" wire:model="financial_analysis">
                                <label class="form-check-label fw-bold" for="financialAnalysis">Financial Analysis</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Livewire Script -->
@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('reset-modal-org', () => {
            $('#updateOrganisationModal').modal('hide');
        });
    });
</script>
@endscript
</div>