<div>
<div wire:ignore.self class="modal fade" id="addListModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Commission List</h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Search and Action Buttons -->
                <div class="row mb-3 position-relative">
                    <div class="col-md-4 position-relative">
                        <input type="text" class="form-control" placeholder="Search" wire:model.live="search">

                        @if(strlen($search) > 1)
                        <div class="position-absolute w-100 bg-white border shadow-sm rounded-3" style="top: calc(100% + 5px); z-index: 1050;">
                            <ul class="list-group mb-0">
                                @forelse($results as $result)
                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action"
                                    style="cursor: pointer;"
                                    wire:click="selectResult({{ $result['id'] }})">
                                    <span>
                                        <strong>{{ $result['title'] }}</strong>
                                        <small class="text-muted d-block">{{ $result['code'] }}</small>
                                    </span>
                                    <i class="bi bi-arrow-right text-muted"></i>
                                </li>
                                @empty
                                <li class="list-group-item text-muted text-center">No results found.</li>
                                @endforelse
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" wire:model="selectedDepartment">
                            <option value="">Select Department</option>
                            <option value="MOLECULAR BIOLOGY">MOLECULAR BIOLOGY</option>
                            <option value="RADIOLOGY">RADIOLOGY</option>
                            <option value="HAEMATOLOGY">HAEMATOLOGY</option>
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-outline-primary">Download List</button>
                       
                    </div>
                </div>

                <!-- Table for Test Details -->
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Test Name</th>

                                <th>Bill Price</th>
                                <th>Commission Price (₹)</th>
                                <th>Commission Percentage (%)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($selectedItems as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>

                                <td>
                                    <input type="number" wire:model.live="selectedItems.{{ $index }}.bill_price" class="form-control border">
                                </td>
                                <td>
                                    <input type="number" wire:model.live="selectedItems.{{ $index }}.commission_price" class="form-control border">
                                </td>
                                <td>
                                    <input type="number" wire:model.live="selectedItems.{{ $index }}.commission_percent" class="form-control border">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" wire:click="removeItem({{ $index }})"> <i class="bx bx-trash"></i></button>
                                </td>
                            </tr>


                            @endforeach
                        </tbody>
                        <tbody>
                            @foreach($commission as $index => $list)
                            <tr>
                               
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$list->test->title}}</td>
                                <td>{{$list->bill_price}}</td>
                                <td>{{$list->commission_price}}</td>
                                <td>{{$list->commission_percent}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" wire:click="deleteList({{ $list->id }})">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            

                        </tbody>
                    </table>
                </div>





            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click="addCommission">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Livewire Script -->
@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('reset-modal-list', () => {
            $('#addListModal').modal('hide');
        });
    });
</script>
@endscript
</div>