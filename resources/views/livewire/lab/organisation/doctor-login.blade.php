<div>
<div wire:ignore.self class="modal fade" id="doctorLoginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Doctor Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <span class="text-danger">*</span> Username:
                        </label>
                        <input type="text" id="username" class="form-control" placeholder="Username" wire:model="username">
                        @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <span class="text-danger">*</span> Password:
                        </label>
                        <input type="password" id="password" class="form-control" placeholder="Password" wire:model="password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Contact -->
                    <div class="mb-3">
                        <label for="contact" class="form-label">
                            <span class="text-danger">*</span> Contact:
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">IN +91</span>
                            <input type="text" id="contact" class="form-control" maxlength="10" placeholder="mobile" wire:model="mobile">
                        </div>
                        @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
              
                  
                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" wire:click="store" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('reset-modal-doc', (event) => {
            $('#doctorLoginModal').modal('hide');
        });
    });
</script>
@endscript

</div>