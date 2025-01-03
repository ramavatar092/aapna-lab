<div>
    <div class="card shadow-sm">
        <!-- Card Header -->
        <div class="card-header d-flex flex-column gap-3 col-12 flex-md-row justify-content-between align-items-center p-3">
            <h6 class="text-nowrap fw-semibold text-primary mb-0">{{ trans('cruds.department.title') }} List</h6>
        </div>

        <!-- Search Input -->
        <div class="d-flex col-12 justify-content-between p-3 gap-3 w-100">
            <input
                type="text"
                wire:model.live="searchTerm"
                placeholder="Search Department..."
                class="form-control flex-grow-1"
                style="max-width: 300px;" />
            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addDepartmentModal"
                @click="$dispatch('add-Department')">
                Add Department
            </button>
        </div>
        <!-- Table -->
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>{{ trans('cruds.department.fields.id') }}</th>
                        <th>{{ trans('cruds.department.fields.title') }}</th>
                        <th>{{ trans('cruds.department.fields.slug') }}</th>
                        <th>{{ trans('cruds.department.fields.description') }}</th>
                        <th>{{ trans('cruds.department.fields.status') }}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($department as $dept)
                    <tr>
                        <td>{{ $dept->id }}</td>
                        <td>{{ $dept->title }}</td>
                        <td>{{ $dept->slug }}</td>
                        <td>{{ $dept->description }}</td>
                        <td>
                            @if ($dept->status)
                            <a wire:click="updateStatus({{ $dept->id }})" class="text-success" title="Active">
                                <i class="bi bi-toggle2-off fs-5"></i>
                            </a>
                            @else
                            <a wire:click="updateStatus({{ $dept->id }})" class="text-danger" title="Inactive">
                                <i class="bi bi-toggle2-on fs-5"></i>
                            </a>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a
                                    class="btn btn-sm "
                                    @click="$dispatch('update-department',{id:{{ $dept->id }}})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateDepartmentModal"
                                    title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <a
                                    class="btn btn-sm"
                                    wire:click="$dispatch('delete-prompt-dept',{id : {{ $dept->id }} })"
                                    title="Delete">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center py-4 text-muted">
                            <i class="bi bi-folder2-open"></i> No data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $department->links('vendor.pagination.bootstrap-5') }}
        </div>

        <!-- Livewire Components -->
        <livewire:department.add />
        <livewire:department.update />
    </div>

    <!-- JavaScript -->
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            $wire.on('delete-prompt-dept', (event) => {
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
                        $wire.dispatch('goOn-Delete-dept', {
                            id: event.id
                        });
                        $wire.dispatch('refresh-department');
                    }
                });
            });

            $wire.on('reset-modal-dept', () => {
                $('#modalCenter').modal('hide');
            });
        });
    </script>
    @endscript
</div>
</div>