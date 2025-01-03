<div wire:ignore.self class="modal fade" id="addNameModal" tabindex="-1" aria-labelledby="addNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNameModalLabel">Test Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="addTestmethod">
                    <div class="mb-3">
                        <label for="name" class="form-label">Test Method</label>
                        <input type="text" id="name" class="form-control" wire:model="test_method">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('reset-testmethod', () => {
            $('#addNameModal').modal('hide');
        });
    });
</script>