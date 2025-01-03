<div>
    <div wire:ignore.self class="modal fade" id="collectedAtModal" tabindex="-1" aria-labelledby="collectedAtModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="collectedAtModalLabel">Add Collected at</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Address</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($addresses as $index => $address)
                                <tr>
                                    <td>
                                        <textarea class="form-control" rows="2" readonly>{{ $address?->address }}</textarea>
                                    </td>
                                    <td class="text-center d-flex items-center justify-content-center ">
                                      
                                        <button class="btn btn-black " wire:click="removeAddress({{ $address?->id }})">
                                            <i class="bx bx-trash text-primary"></i>    
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Add New Row -->
                            <tr class="table-light">
                                <td>
                                    <textarea class="form-control" rows="2" placeholder="Add new address" wire:model="newAddress"></textarea>
                                    @error('newAddress')
                                    <p>{{$message}}</p>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" wire:click="addAddress">
                                        <i class="bi bi-plus-circle"></i> Add New
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
