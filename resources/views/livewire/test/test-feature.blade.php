<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header ">
            <h5 class="card-title mb-0">Form Details</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <!-- Column 1 -->
                <div class="col-md-4">
                    <label for="type" class="form-label fw-bold">Type:</label>
                    <select id="type" wire:model.live="type" class="form-select">
                        <option value="" selected>Select Type</option>
                        <option value="single field">Single Field</option>
                        <option value="multiple field">Multiple Field</option>
                        <option value="text editor">Text Editor</option>
                    </select>
                    @error('type') <span class="text-danger">{{ $message }}</span> @enderror

                    <label for="test_name" class="form-label mt-3 fw-bold">Test Name:</label>
                    <input type="text" class="form-control" wire:model.live="test_name" id="test_name" placeholder="Enter Test Name">
                    @error('test_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Column 2 -->
                <div class="col-md-4">
                    <label for="testMethod" class="form-label fw-bold">Test Method:</label>
                    <div class="d-flex align-items-center gap-2">
                        <select id="testMethod" wire:model.live="test_method" class="form-select">
                            <option value="null" selected>Select</option>
                            @foreach ($testmethods as $testmethod)
                                <option value="{{ $testmethod->test_method }}">{{ $testmethod->test_method }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm">+</button>
                    </div>
                    @error('test_method') <span class="text-danger">{{ $message }}</span> @enderror

                    <label for="field" class="form-label mt-3 fw-bold">Field:</label>
                    <select id="field" wire:model.live="field" class="form-select">
                        <option value="numeric" selected disabled>Numeric</option>
                        @if($type != 'multiple field')
                            <option value="numeric unbound">Numeric Unbound</option>
                            <option value="multiple range">Multiple Range</option>
                            <option value="custom">Custom</option>
                        @endif
                    </select>
                    @error('field') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Column 3 -->
                <div class="col-md-4">
                    <label for="unit" class="form-label fw-bold">Unit:</label>
                    <input type="text" class="form-control" wire:model.live="unit" id="unit" placeholder="Enter Unit" {{$type == 'multiple field' ? 'readonly' : ''}}>
                    @error('unit') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Conditional Fields Based on Selected Options -->
                    @if ($field == 'numeric')
                        <label class="form-label mt-3 fw-bold">Range:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" wire:model.live="range_min" placeholder="Min">
                            <span class="input-group-text">to</span>
                            <input type="number" class="form-control" wire:model.live="range_max" placeholder="Max">
                        </div>
                        @error('range_min') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('range_max') <span class="text-danger">{{ $message }}</span> @enderror
                    @elseif($field == 'numeric unbound')
                        <label class="form-label mt-3 fw-bold">Range:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model.live="range_operation" placeholder="Operation">
                            <input type="text" class="form-control" wire:model.live="range_value" placeholder="Value">
                        </div>
                        @error('range_operation') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('range_value') <span class="text-danger">{{ $message }}</span> @enderror
                    @elseif($field == 'multiple range')
                        <label class="form-label mt-3 fw-bold">Range:</label>
                        <textarea class="form-control" wire:model.live="multiple_range" placeholder="Enter Range"></textarea>
                        @error('multiple_range') <span class="text-danger">{{ $message }}</span> @enderror
                    @elseif($field == 'custom')
                        <label class="form-label mt-3 fw-bold">Options:</label>
                        <input type="text" class="form-control" wire:model.live="custom_option" placeholder="Custom Option">
                        <label class="form-label mt-3 fw-bold">Default:</label>
                        <input type="text" class="form-control" wire:model.live="custom_default" placeholder="Default Option">
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
        <div class="card-header  text-white">
            <h5 class="card-title mb-0">Data Collection</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead >
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Field</th>
                            <th>Units</th>
                            <th>Range</th>
                            <th>Formula</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataCollection as $index => $data)
                            <tr>
                                <td>
                                    <input type="checkbox" wire:click="subTest({{ $index }})">
                                </td>
                                <td>
                                    @if ($data['type'] == 'multiple field')
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="collapse" data-bs-target="#row1">
                                            <i class="bx bx-chevron-down"></i>
                                        </button>
                                    @endif
                                    {{ $data['test_name'] }}
                                </td>
                                <td>{{ $data['field'] }}</td>
                                <td>{{ $data['unit'] }}</td>
                                <td>
                                    @if ($data['field'] == 'numeric')
                                        {{ $data['range_min'] }}-{{ $data['range_max'] }}
                                    @elseif($data['field'] == 'numeric unbound')
                                        Operation: {{ $data['range_operation'] }} Value: {{ $data['range_value'] }}
                                    @elseif($data['field'] == 'multiple range')
                                        {{ $data['multiple_range'] }}
                                    @endif
                                </td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" wire:click="removeDataFromArray({{ $index }})">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
