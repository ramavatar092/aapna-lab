<div>
    <div wire:ignore.self class="modal fade" id="quotationModal" tabindex="-1" aria-labelledby="quotationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quotationModalLabel">Quotation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row g-3">
                            <!-- Designation -->
                            <div class="col-md-3">
                                <label for="designation" class="form-label">Designation</label>
                                <select class="form-select" wire:model="designation" id="designation">
                                    <option value="Mr.">MR.</option>
                                    <option value="Ms.">MS.</option>
                                    <option value="Dr.">DR.</option>
                                </select>
                            </div>
                            <!-- Name -->
                            <div class="col-md-9">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" wire:model="name" id="name" placeholder="Enter Name">
                            </div>
                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">IN +91</span>
                                    <input type="tel" class="form-control" wire:model="phone" id="phone" maxlength="10" placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" wire:model="email" id="email" placeholder="Enter Email">
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Test / Package</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($selectedItems as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td>
                                        {{$item['amount']}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-black btn-sm" wire:click="removeItem({{ $index }})">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox"></i> No data
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Search and Total -->
                        <div class="row mt-3">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center gap-2">
                                    <input
                                        type="text"
                                        wire:model.live="search"
                                        class="form-control flex-grow-1"
                                        placeholder="Search by test name or test code"
                                        aria-label="Search input">
                                    <select
                                        wire:model="selectSearchType"
                                        id="searchType"
                                        class="form-select flex-shrink-0"
                                        style="width: auto;"
                                        aria-label="Search type">
                                        <option value="1">Test</option>
                                        <option value="2">Package</option>
                                    </select>
                                </div>

                                <!-- Display search results -->
                                @if($results)
                                <ul class="list-group mt-3">
                                    @foreach($results as $result)
                                    <li wire:click="selectResult({{ $result['id'] }})" class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            {{ $result['title'] }} ({{ $result['code'] }})
                                        </div>

                                    </li>
                                    @endforeach
                                </ul>
                                @endif


                            </div>
                            <div class="mt-3 text-end">

                                <div>Total: ₹{{ number_format($totalAmount, 2) }}</div>
                                <div>Discount: ₹{{ number_format($discount_amount, 2) }}</div>
                                <div><strong>Final Amount: ₹{{ number_format($finalAmount, 2) }}</strong></div>
                            </div>
                        </div>

                        <!-- Discounts -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="discountPercent" class="form-label">Discount(%) (Optional)</label>
                                <input type="number" class="form-control" wire:model.live="discount_percent" id="discountPercent" value="{{ (float) $discount_percent }}" min="0" placeholder="0">
                            </div>
                            <div class="col-md-6">
                                <label for="discountAmount" class="form-label">Discount(₹) (Optional)</label>
                                <input type="number" class="form-control" wire:model.live="discount_amount" value="{{ (float) $discount_amount }}" id="discountAmount" placeholder="Add Discount">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Send</button>
                    <button wire:click="pdfPreview" class="btn btn-primary" data-bs-toggle="modal" >
                        Preview PDF Data
                    </button>
                </div>
            </div>
        </div>


    </div>
</div>