<div>
    <div class="card shadow-sm">
        <div class="card-header d-flex flex-column gap-3 col-12 flex-md-row justify-content-between align-items-center p-3">
            <h6 class="text-nowrap fw-semibold text-primary mb-0">{{ trans('cruds.test.title') }} List</h6>
        </div>
        <div class="d-flex col-12 justify-content-between p-3 gap-3 w-100 ">
            <input
                type="text"
                wire:model.live="searchTerm"
                placeholder="Search Test..."
                class="form-control flex-grow-1"
                style="max-width: 300px;" />
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestModal">
                Add Test
            </button>
        </div>


        <div class="table-responsive text-nowrap p-3">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>{{ trans('cruds.test.fields.title') }}</th>
                        <th>{{ trans('cruds.test.fields.gender') }}</th>
                        <th>{{ trans('cruds.test.fields.age') }}</th>
                        <th>{{ trans('cruds.test.fields.created_at') }}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tests as $test)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $test->title }}</td>
                        <td>{{ ucwords($test->gender) }}</td>
                        <td>{{ $test->age }}</td>
                        <td>{{ $test->created_at->format('d-m-Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button
                                    class="btn btn-sm"
                                    type="button" data-bs-toggle="modal" data-bs-target="#UpdateTestModal"
                                    wire:click="$dispatch('update-test',{id : {{ $test->id }} })"
                                    title="update"> <i class="bx bx-edit-alt"></i>
                                </button>

                                <a href={{route('admin.testfeature',$test->id)}} class="btn btn-sm" title="view">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8a13.133 13.133 0 0 1-1.66 2.043C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM8 6.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z"/>
                                    </svg>
                                </a>



                                <a
                                    class="btn btn-sm"
                                    wire:click="$dispatch('delete-prompt',{id : {{ $test->id }} })"
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

        <div class="mt-3 d-flex justify-content-center">
            {{ $tests->links('vendor.pagination.bootstrap-5') }}
        </div>


        <livewire:test.add />
        <livewire:test.update />


    </div>

    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            $wire.on('delete-prompt', (event) => {
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
                        $wire.dispatch('goOn-Delete', {
                            id: event.id
                        });
                        $wire.dispatch('refresh-test');
                    }
                });
            });

            $wire.on('reset-modal', () => {
                $('#modalCenter').modal('hide');
            });
        });
    </script>
    @endscript
</div>
