<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="subTestModal" tabindex="-1" aria-labelledby="subTestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subTestModalLabel">Add Sub Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-4">
                            <label for="type" class="form-label">Title:</label>
                            <input type="text" wire:model.live="title" class="form-control" style="max-width: 300px;" />
                            <div class="d-flex mt-2 justify-content-end">
                                <button type="submit" wire:click="changetitle" class="btn btn-primary btn-sm d-flex align-items-center">
                                    <i class="bx bx-pencil me-2"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Conditional fields -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="test_name" class="form-label">{{ trans('cruds.test.fields.test_name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model.live="test_name" id="test_name" placeholder="Test Name">
                            @error('test_name') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="testMethod" class="form-label mt-2">Test Method:</label>
                            <select id="testMethod" wire:model.live="test_method" class="form-select">
                                <option value="null" selected>Select</option>
                                @foreach ($testmethods as $testmethod)
                                <option value="{{ $testmethod->test_method }}">{{ $testmethod->test_method }}</option>
                                @endforeach
                            </select>
                            @error('test_method') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Third Column -->
                        <div class="col-md-4">
                            <label for="field" class="form-label mt-2">Field:</label>
                            <select id="field" wire:model.live="field" class="form-select">
                                <option value="numeric" selected>numeric</option>
                                <option value="numeric unbound">numeric unbound</option>
                                <option value="multiple range">multiple range</option>
                                <option value="custom">custom</option>
                            </select>
                            @error('field') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="unit" class="form-label mt-2">Unit:</label>
                            <input type="text" class="form-control" wire:model.live="unit" id="unit" placeholder="Unit">
                            @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        @if ($field == 'numeric')
                        <div class="col-md-4">
                            <label for="rangeMin" class="form-label mt-2">Range:</label>
                            <div class="input-group">
                                <input type="number" class="form-control" wire:model.live="range_min" id="range_min" placeholder="Min">
                                <span class="input-group-text">to</span>
                                <input type="number" class="form-control" wire:model.live="range_max" id="range_max" placeholder="Max">
                            </div>
                            @error('range_min') <span class="text-danger">{{ $message }}</span> @enderror
                            @error('range_max') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @elseif ($field == 'numeric unbound')
                        <div class="col-md-4">
                            <label for="rangeMin" class="form-label mt-2">Range:</label>
                            <div class="input-group">
                                <select class="form-control" wire:model.live="range_operation">
                                    <option value="null" selected> Operation</option>
                                    <option value="<=">less than equal to</option>
                                    <option value="<">less than </option>
                                    <option value=">=">greater than equal to</option>
                                    <option value=">">greater than</option>
                                    <option value="==">equal to</option>
                                </select>
                                <input type="text" class="form-control" wire:model.live="range_value" id="value" placeholder="Value">
                            </div>
                            @error('range_operation') <span class="text-danger">{{ $message }}</span> @enderror
                            @error('range_value') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @elseif ($field == 'multiple range')
                        <div class="col-md-4">
                            <label for="rangeMin" class="form-label mt-2">Range:</label>
                            <div class="input-group">
                                <textarea class="form-control" wire:model.live="multiple_range" id="multiple_range" placeholder="Enter Range"></textarea>
                            </div>
                            @error('multiple_range') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @elseif ($field == 'custom')
                        <div class="col-md-4">
                            <label for="option" class="form-label mt-2">Option</label>
                            <input type="text" class="form-control" wire:model.live="custom_option" id="option" placeholder="Create Option">
                            <label for="default" class="form-label mt-2">Default</label>
                            <input type="text" class="form-control" wire:model.live="custom_default" id="option" placeholder="Default Option">
                        </div>
                        @endif
                    </div>

                    <div class="mt-2">
                        <button type="button" class="btn btn-primary" wire:click="saveSubTest">Add Sub Field</button>
                    </div>

                    <!-- Table inside Modal -->
                    <div class="mt-4">
                        <h6 class="mb-3">Sub Fields</h6>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
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
                                @foreach ($subfeature as $key => $test)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $test->test_name }}</td>
                                    <td>{{ $test->field }}</td>
                                    <td>{{ $test->unit }}</td>
                                    <td>
                                        @if ($test->field == 'numeric')
                                        {{ $test->range_min }}-{{ $test->range_max }}
                                        @elseif($field == 'numeric unbound')
                                         {{ $test->field }} {{ $test->range_value }}
                                        @elseif($field == 'multiple range')
                                        {{ $test->multiple_range }}
                                        @endif
                                    </td>
                                    <td>-</td>
                                    <td>
                                        <button class="btn btn-sm " wire:click="destroy({{ $test->id }})">
                                            <i class="bx bx-trash text-black"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @if ($test_name != null || $test_method != null )
                                <tr>
                                    <td></td>
                                    <td>{{ $test_name }}</td>
                                    <td>{{ $field }}</td>
                                    <td>{{ $unit }}</td>
                                    <td>
                                        @if ($field == 'numeric')
                                        {{ $range_min }}-{{ $range_max }}
                                        @elseif($field == 'numeric unbound')
                                         {{ $range_operation }}  {{ $range_value }}
                                        @elseif($field == 'multiple range')
                                        {{ $multiple_range }}
                                        @endif
                                    </td>
                                    <td>-</td>
                                    <td>
                                        <button class="btn btn-sm " wire:click="resetFields">
                                            <i class="bx bx-trash text-black"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            $wire.on('reset-modal-test', (event) => {
                $('#subTestModal').modal('hide');
            });
        });
    </script>
    @endscript
</div>