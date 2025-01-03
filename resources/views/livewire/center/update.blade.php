<div>
<div wire:ignore.self class="modal fade" id="updateCenterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-name text-white"><i class="bi bi-building-fill"></i> Add New  Center</h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form wire:submit.prevent="update">
                    <!-- Department name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">
                            <i class="bi bi-tag-fill text-primary"></i> Add New center <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" wire:model.live="name" id="name" placeholder="Enter center name">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <!-- Department mobile -->
                    <div class="mb-3">
                        <label for="mobile" class="form-label fw-bold">
                            <i class="bi bi-link-45deg"></i>contact
                        </label>
                        <input type="number" maxlength="10" class="form-control" wire:model.live="mobile" id="mobile" placeholder="Enter contact number">
                        @error('mobile') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>


                   

          
                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">
                            <i class="bi bi-textarea-t"></i> address
                        </label>
                        <textarea class="form-control" wire:model.live="address" id="address" rows="3" placeholder="Enter center address"></textarea>
                        @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('reset-modal-cen', (event) => {
            $('#updateCenterModal').modal('hide');
        });
    });
</script>
@endscript
</div>