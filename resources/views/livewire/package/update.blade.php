<div wire:ignore.self class="modal fade" id="updatePackageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{ trans('cruds.package.title_singular') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Input Fields for Package Name and Code -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="packageName" class="form-label">Package Name:</label>
                        <input type="text" id="packageName" wire:model.live="title" class="form-control" placeholder="Enter package name">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="packageCode" class="form-label">Package Code:</label>
                        <input type="text" id="packageCode" wire:model.live="code" class="form-control" readonly >
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Table for Selected Tests/Packages -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Test / Package</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($selectedItems as $index => $item)
                            
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td> <input type="number" class="form-control border" wire:model="selectedItems.{{ $index }}.amount"  value="{{ $item['amount'] }}"></td>
                                    <td>
                                        <button type="button" class="btn btn-black btn-sm" wire:click="removeItem({{ $index }})"> <i class="bx bx-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No Test selected</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Search Field -->
                <div class="input-group mb-4 position-relative">
                    <input type="text" class="form-control rounded-pill px-3 shadow-sm" wire:model.live="search" placeholder="Search by test name or test code">
                    @if(strlen($search) > 1)
                        <div class="position-absolute w-100 bg-white border z-3" style="top: 120%; left: 0;">
                            <ul class="list-group mb-0">
                                @forelse($results as $result)
                                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" style="cursor: pointer;" wire:click="selectResult({{ $result['id'] }})">
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

                <!-- Total Amount Field -->
                <div class="mb-4">
                    <label for="totalAmount" class="form-label">Total Amount:</label>
                    <input type="text" id="totalAmount" class="form-control" wire:model="amount" placeholder="Enter total amount">
                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click="updatePackage">Save</button>
            </div>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        $wire.on('reset-modal-package', (event) => {
            $('#updatePackageModal').modal('hide');
        });
    });
</script>
@endscript
