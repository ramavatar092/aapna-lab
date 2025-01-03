<div  class="card">
    <div class="d-flex justify-content-between align-items-center p-2">
        <div>
            <h6 class="card-header-title tx-20 mb-0">{{ trans('cruds.patient_registration.title') }} List</h6>
        </div>
        <div class="text-right">
            <div class="d-flex">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRegistrationModal" @click="$dispatch('add-registration')">Add</button>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <div class="mb-3">
            <input
                type="text"
                wire:model.live="searchTerm"
                placeholder="Search patient..."
                class="form-control"
            />
        </div>

        {{-- <div class="mb-3">
            <select wire:model="perPage" class="form-control w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>--}}

        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('cruds.patient_registration.fields.id') }}</th>
                    <th>{{ trans('cruds.patient_registration.fields.name') }}</th>
                    <th>{{ trans('cruds.patient_registration.fields.mobile') }}</th>
                    <th>{{ trans('cruds.patient_registration.fields.email') }}</th>
                    <th>{{ trans('cruds.patient_registration.fields.gender') }}</th>
                    <th>{{ trans('cruds.patient_registration.fields.age') }}</th>
                    <th>{{ trans('cruds.patient_registration.fields.created_at') }}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($registrations as $reg)
                    <tr>
                        <td>{{ $loop->iteration ++ }}</td>
                        <td>{{ $reg->firstname }} {{ $reg->lastname }}</td>
                        <td>{{ $reg->mobile }}</td>
                        <td>{{ $reg->email }}</td>
                        <td>{{ $reg->gender }}</td>
                        <td>{{ $reg->age }}</td>
                        <td>{{ $reg->created_at->format('d-m-Y') }}</td>

                        <td>
                            <div class="d-flex ">
                                <a class="dropdown-item p-0" @click="$dispatch('update-registration',{id:{{$reg->id}}})" data-bs-toggle="modal" data-bs-target="#updateRegistrationModal"><i class="bx bx-edit-alt me-1"></i></a>
                                <a class="dropdown-item p-0" wire:click="$dispatch('delete-prompt',{id : {{$reg->id}} })"><i class="bx bx-trash me-1"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No record found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{ $registrations->links() }}
        </div>
        <livewire:registration.add/>
        <livewire:registration.update/>
    </div>
</div>
@script
<script>
     document.addEventListener('livewire:initialized',()=>{
        $wire.on('delete-prompt',(event)=>{
            swal.fire({
                title:'Are you sure?',
                text:'You are about to delete this record, this action is irreversible',
                icon:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                showCancelButtonColor:'#d33',
                confirmButtonText:'Yes, Delete it!',
            }).then((result)=>{
                if(result.isConfirmed){
                    $wire.dispatch('goOn-Delete' , {
                        id : event.id
                    })

                    $wire.on('deleted',(event)=>{
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Deleted , Your record has been deleted",
                            showConfirmButton: false,
                            timer: 1000
                        });
                    })
                    $wire.dispatch('refresh-registrations');
                }
            })
        });

        document.addEventListener('livewire:initialized',()=>{
            $wire.on('reset-modal-reg',(event)=>{
                $('#modalCenter').modal('hide');
            })
        });
     })
 </script>
@endscript
