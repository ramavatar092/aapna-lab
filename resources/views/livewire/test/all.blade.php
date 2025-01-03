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
        <a   href="{{route('admin.testadd')}}"
            class="btn btn-primary"
           >
            Add Test
        </a>
    </div>


    <div class="table-responsive text-nowrap p-3">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>{{ trans('cruds.test.fields.title') }}</th>
                    <th>{{ trans('cruds.test.fields.test_name') }}</th>
                    <th>{{ trans('cruds.test.fields.test_method') }}</th>
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
                    <td>{{ $test->test_name }}</td>
                    <td>{{ $test->test_method }}</td>
                    <td>{{ ucwords($test->gender) }}</td>
                    <td>{{ $test->age }}</td>
                    <td>{{ $test->created_at->format('d-m-Y') }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a
                                class="btn btn-sm"
                                href="{{route('admin.testupdate',$test->id)}}"
                                title="Edit">
                                <i class="bx bx-edit-alt"></i>
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
                <tr >
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
