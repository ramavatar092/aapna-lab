<div>
<div class="card shadow-sm">
    <div class="card-header d-flex flex-column gap-3 col-12 flex-md-row justify-content-between align-items-center p-3">
        <h6 class="text-nowrap fw-semibold text-primary mb-0">Center List</h6>
    </div>

    <div class="d-flex col-12 justify-content-between p-3 gap-3 w-100">
        <input
            type="text"
            wire:model.live="searchTerm"
            placeholder="Search center..."
            class="form-control flex-grow-1"
            style="max-width: 300px;" />
        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addCenterModal"
            @click="$dispatch('add-newCenter')">
            Add Center
        </button>
    </div>

    <div class="table-responsive text-nowrap p-3">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Center Name</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($centers as $cen)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cen->name }}</td>
                    <td>{{ $cen->address }}</td>
                    <td>{{ $cen->mobile }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a
                                class="btn btn-sm"
                                @click="$dispatch('update-center', { id: {{ $cen->id }} })"
                                data-bs-toggle="modal"
                                data-bs-target="#updateCenterModal"
                                title="Edit">
                                <i class="bx bx-edit-alt"></i>
                            </a>
                            <a
                                class="btn btn-sm"
                                wire:click="$dispatch('delete-prompt-cen', { id: {{ $cen->id }} })"
                                title="Delete">
                                <i class="bx bx-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="bi bi-folder2-open"></i> No data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $centers->links('vendor.pagination.bootstrap-5') }}
    </div>

    <livewire:center.add />
    <livewire:center.update />
   
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('delete-prompt-cen', (event) => {
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
                    $wire.dispatch('goOn-Delete-center', {
                        id: event.id
                    });
                    $wire.dispatch('refresh-center');
                }
            });
        });

        $wire.on('reset-modal-cen', () => {
            $('#addCenterModal').modal('hide');
        });
    });
</script>
@endscript

</div>