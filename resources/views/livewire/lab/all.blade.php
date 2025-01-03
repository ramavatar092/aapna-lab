<div>
    <div class="card shadow-sm">
    <div class="card-header d-flex flex-column  col-12 flex-md-row justify-content-between align-items-center p-3">
        <h6 class="text-nowrap fw-semibold text-primary mb-0">{{ trans('cruds.organisation.title') }} List</h6>
        <div class="d-flex mt-6 gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $searchType === 'doctor' ? 'Search Doctor' : 'Search Hospital' }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li>
                        <a class="dropdown-item" wire:click.prevent="setSearchType('doctor')" href="#">Search Doctor</a>
                    </li>
                    <li>
                        <a class="dropdown-item" wire:click.prevent="setSearchType('hospital')" href="#">Search Hospital</a>
                    </li>
                </ul>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrganisation" @click="$dispatch('add-organisation')">Add Organisation</button>
        </div>
    </div>

    <div class="d-flex col-12 justify-content-between p-3 gap-3 w-100">
        <input
            type="text"
            wire:model.live="searchTerm"
            placeholder="Search {{ $searchType === 'doctor' ? 'Doctor' : 'Hospital' }}..."
            class="form-control flex-grow-1"
            style="max-width: 300px;" />
    </div>

    <div class="table-responsive text-nowrap p-3">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>{{ trans('cruds.organisation.fields.id') }}</th>
                    <th>{{ trans('cruds.organisation.fields.ref_type') }}</th>
                    <th>{{ trans('cruds.organisation.fields.name') }}</th>
                    <th>{{ trans('cruds.organisation.fields.compliment') }} %</th>
                    <th>{{ trans('cruds.organisation.fields.username') }}</th>
                    <th>{{ trans('cruds.organisation.fields.mobile') }}</th>
                    <th>{{ trans('cruds.organisation.fields.login_status') }}</th>
                    <th>Test Commission List</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($organisations as $key => $org)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $org->ref_type }}</td>
                    <td>{{ $org->name }}</td>
                    <td>{{ $org->compliment }}</td>
                    <td>{{ $org?->user?->username }}</td>
                    <td>{{ $org?->user?->mobile }}</td>
                    <td>
                        @if ($org?->user?->status)
                        <a wire:click="updateStatus({{ $org?->user?->id }})">
                            <i class="bi bi-toggle2-off text-success"></i>
                        </a>
                        @else
                        <a wire:click="updateStatus({{ $org?->user?->id }})">
                            <i class="bi bi-toggle2-on text-danger"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" @click="$dispatch('getOrg',{id:{{ $org->id }}})" data-bs-toggle="modal" data-bs-target="#addListModal">
                            <i class="bi bi-plus-circle"></i> Add List
                        </button>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm btn-primary" @click="$dispatch('update-organisation',{id:{{ $org->id }}})" data-bs-toggle="modal" data-bs-target="#updateOrganisationModal">Edit</button>
                            <button class="btn btn-sm btn-info" @click="$dispatch('doctor-login',{id:{{ $org->id }}})" data-bs-toggle="modal" data-bs-target="#doctorLoginModal">{{ $org->ref_type }} Login</button>
                            <button class="btn btn-sm btn-danger" wire:click="$dispatch('delete-prompt-org',{id : {{ $org->id }} })">Delete</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-muted">
                        <i class="bi bi-folder2-open"></i> No data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $organisations->links('vendor.pagination.bootstrap-5') }}
    </div>

    <livewire:lab.organisation.add />
    <livewire:lab.organisation.update />
    <livewire:lab.organisation.add-list />
    <livewire:lab.organisation.doctor-login />
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('delete-prompt-org', (event) => {
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
                    $wire.dispatch('goOn-Delete-org', {
                        id: event.id
                    });
                    $wire.dispatch('refresh-organisation');
                }
            });
        });

        $wire.on('reset-modal-org', () => {
            $('#modalCenter').modal('hide');
        });
    });
</script>
@endscript
</div>