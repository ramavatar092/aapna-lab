<div>
<div class="container p-0">
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="subTestModal" tabindex="-1" aria-labelledby="subTestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title " id="subTestModalLabel">New Test Sub Parameters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Title Input -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="d-flex align-items-center gap-3 mt-3">
                                <div class="flex-grow-1">
                                    <label for="type" class="form-label mb-1">Title:</label>
                                    <input type="text" wire:model.live="title" class="form-control" placeholder="Enter title" />
                                </div>
                                <button type="submit" wire:click="changetitle" class="btn btn-primary d-flex mt-4 btn-sm align-items-center">Save</button>
                            </div>
                        </div>
                    </div>

                    <!-- Conditional Fields -->
                    <div class="row mt-3 p-0 mt-4 ">
                        <!-- Test Name and Test Method -->
                        <div class="col-md-4">
                            <label for="test_name" class="form-label">
                                {{ trans('cruds.test.fields.test_name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" wire:model.live="test_name" id="test_name" placeholder="Test Name" />
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

                        <!-- Field and Unit -->
                        <div class="col-md-4">
                            <label for="field" class="form-label mt-2">Field:</label>
                            <select id="field" wire:model.live="field" class="form-select">
                                <option value="" Selected>Select</option>
                                <option value="numeric">Numeric</option>
                                <option value="numeric-unbound">Numeric Unbound</option>
                                <option value="multiple-range">Multiple Range</option>
                                <option value="custom">Custom</option>
                            </select>
                            @error('field') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="unit" class="form-label mt-2">Unit:</label>
                            <input type="text" class="form-control" wire:model.live="unit" id="unit" placeholder="Unit" />
                            @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Field Conditions -->
                        @if ($field == 'numeric')
                            <div class="col-md-4">
                                <label for="rangeMin" class="form-label mt-2">Range:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" wire:model.live="range_min" id="range_min" placeholder="Min" />
                                    <span class="input-group-text">to</span>
                                    <input type="number" class="form-control" wire:model.live="range_max" id="range_max" placeholder="Max" />
                                </div>
                                @error('range_min') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('range_max') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @elseif ($field == 'numeric-unbound')
                            <div class="col-md-4">
                                <label for="rangeOperation" class="form-label mt-2">Range:</label>
                                <div class="input-group">
                                    <select class="form-control" wire:model.live="range_operation">
                                        <option value="null" selected>Operation</option>
                                        <option value="<=">less than equal to</option>
                                        <option value="<">less than</option>
                                        <option value=">=">greater than equal to</option>
                                        <option value=">">greater than</option>
                                        <option value="==">equal to</option>
                                    </select>
                                    <input type="text" class="form-control" wire:model.live="range_value" id="value" placeholder="Value" />
                                </div>
                                @error('range_operation') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('range_value') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @elseif ($field == 'multiple range')
                            <div class="col-md-4">
                                <label for="multiple_range" class="form-label mt-2">Range:</label>
                                <textarea class="form-control" wire:model.live="multiple_range" id="multiple_range" placeholder="Enter Range"></textarea>
                                @error('multiple_range') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @elseif ($field == 'custom')
                            <div class="col-md-4">
                                <label for="option" class="form-label mt-2">Option:</label>
                                <select class="form-select" wire:model.live="custom_option" id="option">
                                    <option value="null" selected>Select an Option</option>
                                    <option value="Present">Present</option>
                                    <option value="Reactive">Reactive</option>
                                    <option value="Non-Reactive">Non-Reactive</option>
                                    <option value="Sensitive">Sensitive</option>
                                    <option value="Resistant">Resistant</option>
                                    <option value="Intermediate">Intermediate</option>
                                </select>
                                @error('custom_option') <span class="text-danger">{{ $message }}</span> @enderror

                                <label for="default" class="form-label mt-2">Default</label>
                                <input type="text" class="form-control" wire:model.live="custom_default" id="default" placeholder="Default Option" />
                                @error('custom_default') <span class="text-danger">{{ $message }}</span> @enderror

                                <label for="custom_range" class="form-label mt-2">Custom Range:</label>
                                <textarea class="form-control" wire:model.live="custom_range" id="custom_range" placeholder="Enter Custom Range"></textarea>
                                @error('custom_range') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                        @endif
                    </div>
                    <div class="mt-4 p-0">
                    <strong>
                        <h5 class=" mt-4">Test Sub Parameters</h5>
                    </strong>
                    <table class="table table-bordered mt-2 table-hover">
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
                                        @elseif ($test->field == 'numeric-unbound')
                                            {{ $test->range_operation }} {{ $test->range_value }}
                                        @elseif ($test->field == 'multiple range')
                                            {{ $test->multiple_range }}
                                            @elseif($test->field== 'custom')
                                            {{$test->custom_range}}
                                        @endif
                                    </td>
                                    <td>-</td>
                                    <td>
                                        <button class="btn btn-sm" wire:click="destroy({{ $test->id }})">
                                            <i class="bx bx-trash text-black"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($test_name != null || $test_method != null)
                                <tr>
                                    <td>{{ $subfeature->count() + 1 }}</td>
                                    <td>{{ $test_name }}</td>
                                    <td>{{ $field }}</td>
                                    <td>{{ $unit }}</td>
                                    <td>
                                        @if ($field == 'numeric')
                                            {{ $range_min }}-{{ $range_max }}
                                        @elseif ($field == 'numeric-unbound')
                                            {{ $range_operation }} {{ $range_value }}
                                        @elseif ($field == 'multiple range')
                                            {{ $multiple_range }}
                                            @elseif($field== 'custom')
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

                <!-- Sub Fields Table -->


                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="saveSubfeature">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
