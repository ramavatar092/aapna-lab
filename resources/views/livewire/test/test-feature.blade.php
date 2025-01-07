<div>
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Details</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Column 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label fw-bold">Type:</label>
                            <select id="type" wire:model.live="type" class="form-select">
                                <option value="" selected>Select Type</option>
                                <option value="single field">Single Field</option>
                                <option value="multiple field">Multiple Field</option>
                                <option value="text editor">Text Editor</option>
                            </select>
                            <span class="text-danger small d-block mt-1">@error('type') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3">
                            <label for="test_name" class="form-label fw-bold">Test Name:</label>
                            <input type="text" class="form-control" wire:model.live="test_name" id="test_name" placeholder="Enter Test Name">
                            <span class="text-danger small d-block mt-1">@error('test_name') {{ $message }} @enderror</span>
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
                                <button type="button" data-bs-toggle="modal" data-bs-target="#addNameModal" class="btn btn-primary btn-sm">+</button>
                            </div>
                            <span class="text-danger small d-block mt-1">@error('test_method') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3">
                            <label for="field" class="form-label fw-bold">Field:</label>
                            <select id="field" wire:model.live="field" class="form-select">
                                <option value="numeric" selected>Numeric</option>
                                @if($type != 'multiple field')
                                <option value="numeric unbound">Numeric Unbound</option>
                                <option value="multiple range">Multiple Range</option>
                                <option value="custom">Custom</option>
                                @endif
                            </select>
                            <span class="text-danger small d-block mt-1">@error('field') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <!-- Column 3 -->
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label for="unit" class="form-label fw-bold">Unit:</label>
                            <input type="text" class="form-control" wire:model.live="unit" id="unit" placeholder="Enter Unit" {{$type == 'multiple field' ? 'readonly' : ''}}>
                            <span class="text-danger small d-block mt-1">@error('unit') {{ $message }} @enderror</span>
                        </div>

                        <!-- Conditional Fields Based on Selected Options -->
                        @if ($field == 'numeric')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Range:</label>
                            <div class="input-group">
                                <input type="number" class="form-control" wire:model.live="range_min" placeholder="Min" {{$type=='multiple field' ? 'readonly' : ''}}>
                                <span class="input-group-text">to</span>
                                <input type="number" class="form-control" wire:model.live="range_max" placeholder="Max" {{$type=='multiple field' ? 'readonly' : ''}}>
                            </div>
                            <span class="text-danger small d-block mt-1">@error('range_min') {{ $message }} @enderror</span>
                            <span class="text-danger small d-block">@error('range_max') {{ $message }} @enderror</span>
                        </div>
                        @elseif($field == 'numeric unbound')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Range:</label>
                            <div class="input-group">
                                <select class="form-control" wire:model.live="range_operation">
                                    <option value="null"  selected> Operation</option>
                                    <option value="<=">less than equal to</option>
                                    <option value="<">less than</option>
                                    <option value=">=">greater than equal to</option>
                                    <option value=">">greater than</option>
                                    <option value="==">equal to</option>
                                </select>

                                <input type="text" class="form-control" wire:model.live="range_value" placeholder="Value">
                            </div>
                            <span class="text-danger small d-block mt-1">@error('range_operation') {{ $message }} @enderror</span>
                            <span class="text-danger small d-block">@error('range_value') {{ $message }} @enderror</span>
                        </div>
                        @elseif($field == 'multiple range')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Range:</label>
                            <textarea class="form-control" wire:model.live="multiple_range" placeholder="Enter Range"></textarea>
                            <span class="text-danger small d-block mt-1">@error('multiple_range') {{ $message }} @enderror</span>
                        </div>
                        @elseif($field == 'custom')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Options:</label>
                            <input type="text" class="form-control" wire:model.live="custom_option" placeholder="Custom Option">
                            <label class="form-label fw-bold mt-2">Default:</label>
                            <input type="text" class="form-control" wire:model.live="custom_default" placeholder="Default Option">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary">Close</button>
                <button type="button" class="btn btn-primary" wire:click="saveData">Save</button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header text-white">
                <h5 class="card-title mb-0">Data Collection</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th></th>
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
                            @foreach ($testfeature as $key=> $test)
                            <tr>
                                <td>
                                    @if ($test->type == 'multiple field')
                                    <button wire:click="$dispatch('getid',{id:{{$test->id}}})" data-bs-toggle="modal" data-bs-target="#subTestModal" class="btn btn-sm" wire:click="resetFields">
                                        <i class="bi bi-arrows-fullscreen"></i>
                                    </button>
                                    @endif
                                </td>
                              
                                <td>{{$key+1}}</td>

                                <td>{{$test->test_name}}</td>
                                <td>{{$test->field}}</td>
                                <td>{{$test->unit}}</td>
                                <td>
                                    @if ($test->field== 'numeric')
                                    {{$test->range_min}}-{{$test->range_max}}
                                    @elseif($test->field == 'numeric unbound')
                                    {{$test->range_operation}} {{$test->range_value}}
                                    @elseif($test->field == 'multiple range')
                                    {{$test->multiple_range}}
                                    @endif
                                </td>
                                <td>-</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <button class="btn btn-sm" wire:click="removeData({{$test->id}})">
                                            <i class="bx bx-trash text-black"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                            @if ($test_name!=null || $test_method!=null )
                            <tr>
                                <td></td>
                                <td>1</td>
                                <td>{{$test_name}}</td>
                                <td>{{$field}}</td>
                                <td>{{$unit}}</td>
                                <td>
                                    @if ($field== 'numeric')
                                    {{$range_min}}-{{$range_max}}
                                    @elseif($field == 'numeric unbound')
                                    {{$range_operation}} {{$range_value}}
                                    @elseif($field == 'multiple range')
                                    {{$multiple_range}}
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
                            <!-- Populate rows dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <livewire:test.testmethod />
        <livewire:test.sub-test-feature />
    </div>
</div>