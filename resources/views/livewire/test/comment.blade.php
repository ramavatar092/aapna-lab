<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    <!-- Livewire Form -->
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea id="comment" class="form-control" wire:model="comment" rows="4" required></textarea>
                            @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Display success message -->
    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            $wire.on('reset-modal-comment', (event) => {
                $('#commentModal').modal('hide');
            });
        });
    </script>
    @endscript
</div>
