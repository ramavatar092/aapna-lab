<div>
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
            <h6 class="fw-semibold text-primary mb-0">Role List</h6>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">Add Role</button>
        </div>

        <!-- Search -->
        <div class="d-flex justify-content-between p-3 gap-3">
            <input 
                type="text" 
                wire:model.live="searchTerm" 
                placeholder="Search Role..." 
                class="form-control flex-grow-1" 
                style="max-width: 300px;">
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roless as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button 
                                    class="btn btn-sm btn-black"
                                    @click="$dispatch('update-role', { id: {{ $role->id }} })" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#updateRoleModal" 
                                    title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <button 
                                    class="btn btn-sm btn-black" 
                                    wire:click="$dispatch('delete-prompt-role', { id: {{ $role->id }} })" 
                                    title="Delete">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <i class="bi bi-folder2-open"></i> No roles found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $roless->links('vendor.pagination.bootstrap-5') }}
        </div>

        <!-- Livewire Modals -->
        <livewire:roles.add />
        <livewire:roles.update />
    </div>

    <!-- Scripts -->
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            $wire.on('delete-prompt-role', (event) => {
                swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete this role. This action is irreversible.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.dispatch('goOn-Delete-role', { id: event.id });
                        $wire.dispatch('refresh-roles');
                    }
                });
            });

            $wire.on('reset-modal-role', () => {
                $('#addRoleModal').modal('hide');
                $('#updateRoleModal').modal('hide');
            });
        });
    </script>
    @endscript
</div>
