<div class="card shadow-sm">
    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center p-3  text-black">
        <h5 class="mb-0">Permission List</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
            <i class="bx bx-plus"></i> Add Permission
        </button>
    </div>

    <!-- Search Bar -->
    <div class="p-3 bg-light border-bottom">
        <input
            type="text"
            wire:model.live="searchTerm"
            placeholder="Search Permission..."
            class="form-control"
            style="max-width: 300px;" />
    </div>

    <!-- Table -->
    <div class="table-responsive p-3">
        <table class="table table-hover  align-middle mb-0">
            <thead class="table-primary">
                <tr>
                    <th>id</th>
                    <th>Permission</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissionlist as $key=> $per)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $per->name }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <!-- Edit Button -->
                            <button
                                class="btn btn-sm btn-black"
                                data-bs-toggle="modal"
                                data-bs-target="#updatePermissionModal"
                                @click="$dispatch('update-permission', { id: {{ $per->id }} })">
                                <i class="bx bx-edit-alt"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="btn btn-sm btn-black "
                                wire:click="$dispatch('delete-prompt-per', { id: {{ $per->id }} })">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">
                        <i class="bx bx-folder-open"></i> No permissions found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $permissionlist->links('vendor.pagination.bootstrap-5') }}
    </div>

    <!-- Modals -->
    <livewire:permission.add />
    <livewire:permission.update />
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('delete-prompt-per', (event) => {
            swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this record, this action is irreversible.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('goOn-Delete-per', { id: event.id });
                }
            });
        });

        $wire.on('reset-modal-per', () => {
            $('#addPermissionModal').modal('hide');
            $('#updatePermissionModal').modal('hide');
        });
    });
</script>
@endscript
