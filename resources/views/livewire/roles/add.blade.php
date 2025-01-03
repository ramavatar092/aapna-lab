<div>
    <!-- Add Permission Modal -->
<div wire:ignore.self class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Role & Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form wire:submit.prevent="store">
                    <!-- Role Name -->
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Role Name</label>
                        <input type="text" id="roleName" class="form-control" placeholder="Enter role name" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Permissions -->
                    <div class="row">
                        <label class="form-label">Assign Permissions</label>
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" wire:model="selectedPermissions" value="{{ $permission->name }}" id="perm{{ $permission->id }}">
                                    <label class="form-check-label" for="perm{{ $permission->id }}">
                                        {{ ucwords($permission->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Role</button>
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
        $wire.on('reset-modal-role', () => {
            $('#addRoleModal').modal('hide');
        });
    });
</script>
@endscript
</div>