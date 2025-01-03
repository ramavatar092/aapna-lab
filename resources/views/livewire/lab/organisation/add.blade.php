<div>
<div wire:ignore.self class="modal fade" id="addOrganisation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add {{ trans('cruds.organisation.title_singular') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="row g-3">
                        <!-- Referral Type -->
                        <div class="col-12">
                            <label class="form-label">Referral Type <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" id="doctor" wire:model="ref_type" value="Doctor">
                                    <label class="form-check-label" for="doctor">Doctor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="hospital" wire:model="ref_type" value="Hospital">
                                    <label class="form-check-label" for="hospital">Hospital</label>
                                </div>
                            </div>
                            @error('ref_type') 
                                <div class="text-danger mt-1">
                                    <small>{{ $message }}</small>
                                </div> 
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" class="form-control" wire:model="name" placeholder="Name">
                            @error('name') 
                                <div class="text-danger mt-1">
                                    <small>{{ $message }}</small>
                                </div> 
                            @enderror
                        </div>

                        <!-- Degree -->
                        <div class="col-md-6">
                            <label for="degree" class="form-label">Degree</label>
                            <input type="text" id="degree" class="form-control" wire:model="degree" placeholder="Degree">
                            @error('degree') 
                                <div class="text-danger mt-1">
                                    <small>{{ $message }}</small>
                                </div> 
                            @enderror
                        </div>

                        <!-- Compliment% -->
                        <div class="col-md-6">
                            <label for="compliment" class="form-label">Compliment% <span class="text-danger">*</span></label>
                            <input type="number" id="compliment" class="form-control" wire:model="compliment" placeholder="Compliment%">
                            @error('compliment') 
                                <div class="text-danger mt-1">
                                    <small>{{ $message }}</small>
                                </div> 
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" class="form-control" wire:model="address" placeholder="Enter address" rows="3"></textarea>
                            @error('address') 
                                <div class="text-danger mt-1">
                                    <small>{{ $message }}</small>
                                </div> 
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Save
                        </button>
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
            $('#addOrganisation').modal('hide');
        });
    });
</script>
@endscript
</div>