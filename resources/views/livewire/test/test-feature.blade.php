<div class="container p-0">
    <!-- Form Section -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Add New Parameter</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <!-- Column 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Type:</label>
                        <select id="type" wire:model.live="type" class="form-select">
                            <option value="" selected>Select Type</option>
                            <option value="single-field">Single Field</option>
                            <option value="multiple-field">Multiple Field</option>
                            <option value="text-editor">Text Editor</option>
                        </select>
                        <span class="text-danger small mt-1">@error('type') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-3">
                        <label for="test_name" class="form-label fw-bold">Test Name:</label>
                        <input type="text" class="form-control" wire:model.live="test_name" id="test_name" placeholder="Enter Test Name">
                        <span class="text-danger small mt-1">@error('test_name') {{ $message }} @enderror</span>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <label for="testMethod" class="form-label fw-bold">Test Method:</label>
                        <div class="d-flex align-items-center gap-2">
                            <select id="testMethod" wire:model.live="test_method" class="form-select">
                                <option value="null" selected>Select</option>
                                @foreach ($testmethods as $testmethod)
                                <option value="{{ $testmethod->test_method }}">{{ $testmethod->test_method }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNameModal">+</button>
                        </div>
                        <span class="text-danger small mt-1">@error('test_method') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-3">
                        <label for="field" class="form-label fw-bold">Field:</label>
                        <select id="field" wire:model.live="field" class="form-select">
                            <option value="">Select</option>
                            <option value="numeric">Numeric</option>
                            @if($type != 'multiple-field')
                            <option value="numeric-unbound">Numeric Unbound</option>
                            <option value="multiple-range">Multiple Range</option>
                            <option value="custom">Custom</option>
                            @endif
                        </select>
                        <span class="text-danger small mt-1">@error('field') {{ $message }} @enderror</span>
                    </div>
                </div>

                <!-- Column 3 -->
                <div class="col-lg-4 col-md-12">
                    <div class="mb-3">
                        <label for="unit" class="form-label fw-bold">Unit:</label>
                        <input type="text" class="form-control" wire:model.live="unit" id="unit" placeholder="Enter Unit" {{$type == 'multiple-field' ? 'readonly' : ''}}>
                        <span class="text-danger small mt-1">@error('unit') {{ $message }} @enderror</span>
                    </div>

                    <!-- Conditional Fields Based on Selected Options -->
                    @if ($field == 'numeric')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Range:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" wire:model.live="range_min" placeholder="Min" {{$type=='multiple-field' ? 'readonly' : ''}}>
                            <span class="input-group-text">to</span>
                            <input type="number" class="form-control" wire:model.live="range_max" placeholder="Max" {{$type=='multiple-field' ? 'readonly' : ''}}>
                        </div>
                        <span class="text-danger small mt-1">@error('range_min') {{ $message }} @enderror</span>
                        <span class="text-danger small">@error('range_max') {{ $message }} @enderror</span>
                    </div>
                    @elseif($field == 'numeric-unbound')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Range:</label>
                        <div class="input-group">
                            <select class="form-control" wire:model.live="range_operation">
                                <option value="null" selected>Operation</option>
                                <option value="<=">less than equal to</option>
                                <option value="<">less than</option>
                                <option value=">=">greater than equal to</option>
                                <option value=">">greater than</option>
                                <option value="==">equal to</option>
                            </select>
                            <input type="text" class="form-control" wire:model.live="range_value" placeholder="Value">
                        </div>
                        <span class="text-danger small mt-1">@error('range_operation') {{ $message }} @enderror</span>
                        <span class="text-danger small">@error('range_value') {{ $message }} @enderror</span>
                    </div>
                    @elseif($field == 'multiple-range')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Range:</label>
                        <textarea class="form-control" wire:model.live="multiple_range" placeholder="Enter Range"></textarea>
                        <span class="text-danger small mt-1">@error('multiple_range') {{ $message }} @enderror</span>
                    </div>
                    @elseif($field == 'custom')
                    <div class="mb-3">
                        <label for="option" class="form-label fw-bold">Option:</label>
                        <select class="form-select" wire:model.live="custom_option" id="option">
                            <option value="null" selected>Select an Option</option>
                            <option value="Present">Present</option>
                            <option value="Reactive">Reactive</option>
                            <option value="Non-Reactive">Non-Reactive</option>
                            <option value="Sensitive">Sensitive</option>
                            <option value="Resistant">Resistant</option>
                            <option value="Intermediate">Intermediate</option>
                        </select>
                        <span class="text-danger small mt-1">@error('custom_option') {{ $message }} @enderror</span>

                        <label for="default" class="form-label fw-bold mt-2">Default:</label>
                        <input type="text" class="form-control" wire:model.live="custom_default" id="default" placeholder="Default Option">
                        <span class="text-danger small mt-1">@error('custom_default') {{ $message }} @enderror</span>

                        <label for="custom_range" class="form-label fw-bold mt-2">Custom Range:</label>
                        <textarea class="form-control" wire:model.live="custom_range" id="custom_range" placeholder="Enter Custom Range"></textarea>
                        <span class="text-danger small mt-1">@error('custom_range') {{ $message }} @enderror</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between text-end">
            <div class="d-flex gap-2">
                <button type="button" class="btn  btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ViewCommentModal">
                    View Comments
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal">Add Comment</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ckeditorModal">
                    Interpretation
                </button>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-secondary">Close</button>
                <button type="button" class="btn btn-primary" wire:click="saveData">Save</button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Test Parameters</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th width="5px"></th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Field</th>
                            <th>Units</th>
                            <th>Range</th>
                            <th>Formula</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testfeature as $key => $test)
                        <tr>
                            <td>
                                @if ($test->type == 'multiple-field')
                                <button wire:click="$dispatch('getid', {id: {{$test->id}}})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#subTestModal"
                                    class="btn btn-sm"
                                    title="Multiple Parameter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </button>
                                @endif
                            </td>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $test->test_name }}</td>
                            <td>{{ $test->field }}</td>
                            <td>{{ $test->unit }}</td>
                            <td>
                                @if ($test->field == 'numeric')
                                {{ $test->range_min }}-{{ $test->range_max }}
                                @elseif($test->field == 'numeric-unbound')
                                {{ $test->range_operation }} {{ $test->range_value }}
                                @elseif($test->field == 'multiple-range')
                                {{ $test->multiple_range }}
                                @elseif($test->field == 'custom')
                                {{$test->custom_range}}
                                @endif
                            </td>
                            <td>-</td>
                            <td>
                                <button class="btn btn-sm" wire:click="removeData({{ $test->id }})">
                                    <i class="bx bx-trash text-black"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @if ($test_name || $test_method)
                        <tr>
                            <td>
                                @if ($type == 'multiple-field')
                                <button
                                    data-bs-toggle="modal"
                                    data-bs-target="#subTestModal"
                                    class="btn btn-sm"
                                    title="Multiple Parameter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </button>
                                @endif
                            </td>
                            <td>{{ $testfeature->count() + 1 }}</td>
                            <td>{{ $test_name }}</td>
                            <td>{{ $field }}</td>
                            <td>{{ $unit }}</td>
                            <td>
                                @if ($field == 'numeric')
                                {{ $range_min }}-{{ $range_max }}
                                @elseif($field == 'numeric-unbound')
                                {{ $range_operation }} {{ $range_value }}
                                @elseif($field == 'multiple-range')
                                {{ $multiple_range }}
                                @elseif($field == 'custom')
                                {{$custom_range}}
                                @endif
                            </td>
                            <td>-</td>
                            <td>
                                <button class="btn btn-sm" wire:click="resetFields">
                                    <i class="bx bx-trash text-black"></i>
                                </button>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <livewire:test.testmethod />
    <livewire:test.view-comment />
    <livewire:test.sub-test-feature />
    <livewire:test.interpretation />
    <livewire:test.comment :id="$Id" />
</div>