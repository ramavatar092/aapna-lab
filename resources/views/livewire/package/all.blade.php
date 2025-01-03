<div>

    <div class="d-flex justify-content-between align-items-center p-2">


        <div>
            <h6 class="card-header-title tx-20 mb-0">{{ trans('cruds.package.title_singular') }} List</h6>
        </div>
        <div class="text-right">
            <div class="d-flex">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPackageModal" @click="$dispatch('add-package')">Add</button>
            </div>
        </div>
    </div>
    <div class="p-2 mt-2">
        <!-- Row for Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Card Item (Loop Start) -->

            @forelse ($packages as $pack )
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <!-- Package Title and Code -->
                            <h5 class="card-title text-capitalize d-flex justify-content-between align-items-center">
                                <strong>{{$pack->title}}</strong>
                                <span class="text-muted text-sm"><small>Code: {{$pack->code}}</small></span>
                            </h5>

                            <!-- Package Amount -->
                            <p class="h5 mt-2"><strong>₹{{$pack->amount}}</strong></p>

                            <!-- Subtitle -->
                            <h6 class="card-subtitle mt-3 mb-2 text-muted">Tests</h6>

                            <!-- Tests Loop -->
                            @foreach($pack->tests as $test)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{$test->title}}</strong>
                                    <span class="text-black">₹{{$test->pivot->amount}}</span>
                                </div>
                                <p class="text-muted mb-1"><small>{{$test->code}}</small></p>
                            </div>
                            @endforeach

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <button
                                    @click="$dispatch('update-package',{id:{{$pack->id}}})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updatePackageModal"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-pencil"></i> Edit
                                </button>
                                <button
                                    class="btn btn-outline-primary btn-sm"
                                    wire:click="$dispatch('delete-prompt',{id : {{ $pack->id }} })">
                                    <i class="bx bx-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @empty
            <div class="d-flex justify-content-center w-100 align-items-center p-5" style="margin-top: 150px;">
                <i class="bi bi-folder2-open fs-3 text-muted me-2"></i>
                <span class="text-muted fs-4">No data</span>
            </div>





            @endforelse


        </div>
    </div>
    <livewire:package.add />
    <livewire:package.update />

</div>


@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('delete-prompt', (event) => {
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
                    $wire.dispatch('goOn-Delete', {
                        id: event.id,

                    });

                    $wire.dispatch('refresh-packages');
                }
            })
        });

        document.addEventListener('livewire:initialized', () => {
            $wire.on('reset-modal-package', (event) => {
                $('#modalCenter').modal('hide');
            })
        });
    })
</script>
@endscript