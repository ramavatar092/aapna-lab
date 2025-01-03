<div class="card">
    <div class="d-flex justify-content-between align-items-center p-2">
        <div>
            <h6 class="card-header-title tx-20 mb-0">User List</h6>
        </div>
        <div class="text-right">
            <div class="d-flex">
                <!-- Button to Trigger User Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    Add User
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <div class="mb-3">
            <input
                type="text"
                wire:model.live="searchTerm"
                placeholder="Search user..."
                class="form-control" />
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->roles->pluck('name')->implode(',')}}</td>
                    <td>
                        <a class="dropdown-item p-0" @click="$dispatch('update-user',{id:{{$user->id}}})" data-bs-toggle="modal" data-bs-target="#updateUserModal"><i class="bx bx-edit-alt me-1"></i></a>
                        <a class="dropdown-item p-0" wire:click="$dispatch('delete-prompt-user',{id :{{$user->id}} })"><i class="bx bx-trash me-1"></i></a>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>
        <div class="mt-3 d-flex justify-content-center">

        </div>
        <livewire:manage-user.add />
        <livewire:manage-user.update />


    </div>
</div>
@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('delete-prompt-user', (event) => {
            swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this record, this action is irreversible',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                showCancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('goOn-Delete-user', {
                        id: event.id
                    })
                    $wire.dispatch('refresh-user');
                }
            })
        });

        document.addEventListener('livewire:initialized', () => {
            $wire.on('reset-modal-user', (event) => {
                $('#addRoleModal').modal('hide');
            })
        });
    })
</script>
@endscript