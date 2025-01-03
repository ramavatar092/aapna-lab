<div>
<div wire:ignore.self class="modal fade" id="sampleCollectorModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Sample Collector</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form wire:submit.prevent="save">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label"><span class="text-danger">*</span> Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Full Name" wire:model.defer="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Gender Field -->
                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger">*</span> Gender</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" wire:model="gender">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" wire:model="gender">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="other" wire:model="gender">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-3">
                        <label for="phone" class="form-label"><span class="text-danger">*</span> Phone</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Enter 10 Digit Phone Number" maxlength="10" wire:model.defer="phone">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address" wire:model.defer="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:click="save">Save</button>
            </div>
        </div>
    </div>
</div>
@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('reset-modal-sample', () => {
            $('#sampleCollectorModal').modal('hide');
        });
    });
</script>
@endscript

</div>