<div>
    <!-- Fullscreen Modal -->
    <div wire:ignore.self class="modal fade" id="billingModal" tabindex="-1" aria-labelledby="billingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="billingModalLabel">Billing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">

                                <!-- Header -->
                                <h4 class="card-title mb-3">Billing</h4>
                                <div class="row">
                                    <!-- Left: Patient Details -->
                                    <div class="col-md-3">
                                        <h6 class="fw-bold">Patient Details</h6>
                                        <p><strong>{{$firstname}} {{$lastname}}</strong></p>
                                        <p>241206001</p>
                                        <p>Gender: <span class="text-capitalize">{{$gender}}</span></p>
                                        <p>Age: <span>{{$age}} {{$age_type}}</span></p>
                                        <p>Contact Number:<br> <strong>{{$mobile}}</strong></p>
                                        <p>Billing Date:<br>
                                            <input type="datetime-local" class="form-control form-control-sm" value="{{ $DateandTime }}">
                                        </p>

                                        <p>Sample Collector:<br>{{$sampleCollector ? $sampleCollector : '-'}}</p>
                                        <p>Collected at:<br>{{$collectedat ? $collectedat :'-'}}</p>
                                        <p>Organisation: <span class="fw-bold">{{$organisation ? $organisation : 'self'}}</span></p>
                                    </div>

                                    <!-- Right: Billing Table & Summary -->
                                    <div class="col-md-9">
                                        <!-- Billing Table -->

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
                                            <div class="col-md-12">
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

                                        </div>





                                        <!-- Discounts and Payments -->
                                        <div class="mt-4"> <!-- Added margin from the top to the main container -->
                                            <div class="row g-4">
                                                <!-- Discount Section -->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Discount (%) (Optional)</label>
                                                        <input type="number" wire:model.live="discount_percent" class="form-control form-control-sm" placeholder="0">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Discount (₹) (Optional)</label>
                                                        <input type="number" wire:model.live="discount_amount" class="form-control form-control-sm" placeholder="0">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Discounted By (Optional)</label>
                                                        <select class="form-select form-select-sm">
                                                            <option selected>Select a person</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Reason of Discount (Optional)</label>
                                                        <textarea rows="3" wire:model="reason_of_discount" class="form-control form-control-sm" placeholder="Enter Reason of Discount"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Summary Section -->
                                                <div class="col-md-6 mt-4 ml-3">
                                                    <div class="p-3 border rounded">
                                                        <h6 class="fw-bold mb-3">Summary</h6>
                                                        <p>Total Amount: <strong>₹{{ array_sum(array_column($selectedItems, 'amount')) + $home_collection_charge }}</strong></p>
                                                        <p>Due Amount: <strong>₹{{ $due_payment }}</strong></p>
                                                        <p>Payment Mode: <strong>{{ ucfirst($payment_mode) }}</strong></p>
                                                        @if ($discount_amount)
                                                        <p>Discount: <strong>₹{{ $discount_amount }}</strong></p>
                                                        @endif
                                                        @if ($advanced_payment)
                                                        <p>Paid Amount: <strong>₹{{ $advanced_payment }}</strong></p>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-4"> <!-- Added top margin here as well -->

                                                <div class="mb-2">
                                                    <label>Advance Paid(₹)</label>
                                                    <input type="number" wire:model.live="advanced_payment" class="form-control form-control-sm" value="110">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Due Amount</label>
                                                    <input type="number" wire:model.live="due_payment" class="form-control form-control-sm" value="0">
                                                </div>
                                                <h6 class="fw-bold">Payment Modes</h6>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="payment_mode" value="cash" wire:model.live="payment_mode" class="form-check-input">
                                                    <label class="form-check-label">Cash</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="payment_mode" value="upi" wire:model.live="payment_mode" class="form-check-input">
                                                    <label class="form-check-label">UPI</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="payment_mode" value="card" wire:model.live="payment_mode" class="form-check-input">
                                                    <label class="form-check-label">Card</label>
                                                </div>

                                            </div>
                                        </div>




                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <button wire:click="register" class="btn btn-outline-primary">Register and Print Bill</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
