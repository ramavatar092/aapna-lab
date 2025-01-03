<div>
    <!-- Update Role Modal -->
<div wire:ignore.self class="modal fade" id="updateRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Role & Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form wire:submit.prevent="update">
                    <!-- Role Name -->
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Role Name</label>
                        <input type="text" id="roleName" class="form-control" wire:model="name" placeholder="Enter role name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Permissions -->
                    <div class="row">
                        <label class="form-label">Assign Permissions</label>
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           wire:model="selectedPermissions" 
                                           value="{{ $permission->name }}" 
                                           id="perm{{ $permission->id }}">
                                    <label class="form-check-label" for="perm{{ $permission->id }}">
                                        {{ ucwords($permission->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Update Role</button>
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
            $('#updateRoleModal').modal('hide');
        });
    });
</script>
@endscript

</div>