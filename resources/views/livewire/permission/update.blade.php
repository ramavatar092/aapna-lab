<div wire:ignore.self class="modal fade" id="updatePermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="row g-3">

                          <!-- permission -->
                          <div class="col-md-6">
                            <label for="permission" class="form-label">permission <span class="text-danger"></span></label>
                            <input type="text" id="permission" class="form-control w-full" wire:model="name" placeholder="Enter Permission">
                            @error('name') 
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
        $wire.on('reset-modal-per', () => {
            $('#updatePermissionModal').modal('hide');
        });
    });
</script>
@endscript
