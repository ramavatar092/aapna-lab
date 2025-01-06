<div>
    <div class="container mt-5">
        <div class="d-flex mb-4 justify-content-between gap-2">
            <h3 class="mb-4">New Test</h3>
            <div class="mb-3 text-end">
                <button class="btn btn-outline-primary me-2">Reset Test</button>
                <button class="btn btn-outline-primary me-2">Report Preview</button>
                <button wire:click="store" class="btn btn-primary">Save</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="dept_id" class="form-label">{{ trans('cruds.test.fields.dept_id') }}<span class="text-danger">*</span></label>
                <select class="form-select" wire:model="dept_id" id="dept_id">
                    <option value="null" disabled>Select</option>
                    @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->title }}</option>
                    @endforeach
                </select>
                @error('dept_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                <label for="title" class="form-label">{{ trans('cruds.test.fields.title') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" wire:model.live="title" id="title" placeholder="Enter {{ trans('cruds.test.fields.title') }}">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                <label for="amount" class="form-label">{{ trans('cruds.test.fields.amount') }}<span class="text-danger">*</span></label>
                <input type="number" class="form-control" wire:model="amount" id="amount" placeholder="Cost in ₹">
                @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                <label for="code" class="form-label">{{ trans('cruds.test.fields.code') }}<span class="text-danger">*</span></label>
                <input type="text" class="form-control" wire:model.live="code" id="code" placeholder="Enter {{ trans('cruds.test.fields.code') }}" readonly>
                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="bySex" class="form-label">By Sex:</label>
                <select id="bySex" wire:model="gender" class="form-select">
                    <option value="null" selected>Select Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="sample_type" class="form-label">{{ trans('cruds.test.fields.sample_type') }}<span class="text-danger">*</span></label>
                <select class="form-select" wire:model="sample_type" id="sample_type">
                    <option value="null" selected>Select {{ trans('cruds.test.fields.sample_type') }}</option>
                    @foreach ($sampleTypes as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach

                    
                </select>
                @error('sample_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                <label for="age" class="form-label">{{ trans('cruds.test.fields.age') }}<span class="text-danger">*</span></label>
                <select class="form-control" wire:model="age" id="age">
                    <option value="default">Default</option>
                    <option value="all">All</option>
                </select>
                @error('age') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                <label for="suffix" class="form-label">{{ trans('cruds.test.fields.suffix') }}</label>
                <input type="text" class="form-control" wire:model="suffix" id="suffix" placeholder="Enter Barcode {{ trans('cruds.test.fields.suffix') }}">
                @error('suffix') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="d-flex justify-content-between align-items-start w-100">
                <!-- Left Section -->
                <div class="left-section mt-2 col-md-9 me-4">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Field</th>
                                <th>Units</th>
                                <th>Range</th>
                                <th>Formula</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataCollection as $index => $data )
                            <tr>

                                @if ($data['type']=='multiple field')
                                <td>
                                    <input type="checkbox" wire:click="subTest({{$index}})">
                                </td>
                                @else
                                <td>
                                    <input type="checkbox">
                                </td>

                                @endif

                                <td>
                                    @if ($data['type']=='multiple field')
                                    <button class="btn btn-sm btn-black" data-bs-toggle="collapse" data-bs-target="#row1">
                                        <i class="bx bx-chevron-down"></i>
                                    </button>
                                    @endif
                                    {{ $data['test_name'] ? $data['test_name'] : ''}}
                                </td>
                                <td>{{$data['field']}}</td>
                                <td>{{$data['unit']}}</td>
                                <td>
                                    @if ($data['field']== 'numeric')
                                    {{$data['range_min']}}-{{$data['range_max']}}
                                    @elseif($data['field'] == 'numeric unbound')
                                    opertation:{{$data['range_operation']}} value:{{$data['range_value']}}
                                    @elseif($data['field'] == 'multiple range')
                                    {{$data['multiple_range']}}
                                    @endif
                                </td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-sm" wire:click="removeDataFromArray({{$index}})">
                                        <i class="bx bx-trash text-black"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No data</td>
                            </tr>
                            @endforelse

                            <!-- live data adding data -->


                            @if ($test_name !=null || $test_method != null )
                            <tr>
                                <td>
                                    <input type="checkbox" wire:model="">
                                </td>

                                <td>
                                    @if ($type=='multiple field')
                                    <button class="btn btn-sm btn-black" data-bs-toggle="collapse" data-bs-target="#row1">
                                        <i class="bx bx-chevron-down"></i>
                                    </button>
                                    @endif
                                    {{ $test_name ? $test_name : ''}}
                                </td>
                                <td>{{ $field }}</td>
                                <td>{{$unit}}</td>
                                <td>
                                    @if ($field== 'numeric')
                                    {{$range_min}}-{{$range_max}}
                                    @elseif($field == 'numeric unbound')
                                    opertation:{{$range_operation}} value:{{$range_value}}
                                    @elseif($field == 'multiple range')
                                    {{$multiple_range}}
                                    @endif
                                </td>
                                <td>-</td>

                                <td>
                                    <button wire:click="resetTablefield" class="btn btn-sm ">
                                        <i class="bx bx-trash text-black"></i>
                                    </button>
                                </td>

                            </tr>
                            @endif




                            <tr class="collapse" id="row1">
                                <td colspan="7">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Field</th>
                                                <th>Units</th>
                                                <th>Range</th>
                                                <th>Formula</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- loop for sub array -->
                                          
                                            <tr>
                                                <td>{{$subTest_name}}</td>
                                                <td>{{$field}}</td>
                                                <td>{{$unit}}</td>
                                                <td>
                                                    @if ($field== 'numeric')
                                                    {{$range_min}}-{{$range_max}}
                                                    @elseif($field == 'numeric unbound')
                                                    opertation:{{$range_operation}} value:{{$range_value}}
                                                    @elseif($field == 'multiple range')
                                                    {{$multiple_range}}
                                                    @endif
                                                </td>
                                                <td>-</td>
                                                <td>
                                                    <button class="btn btn-sm" wire:click="resetTablefield">
                                                        <i class="bx bx-trash text-black"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>



                        </tbody>
                    </table>
                </div>


                <!-- Right Section -->
                @if (!$openSubTest)
                <div class="col">
                    <div class="d-flex col-md-12 flex-column">
                        <label for="type" class="form-label">Type:</label>
                        <select id="type" wire:model.live="type" class="form-select mt-2">
                            <option value="" selected>select type</option>
                            <option value="single field">single field</option>
                            <option value="multiple field">multiple field</option>
                            <option value="text editor">text editor</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="test_name" class="form-label mt-2">{{ trans('cruds.test.fields.test_name') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" wire:model.live="test_name" id="test_name" placeholder="Test Name">
                        @error('test_name') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="testMethod" class="form-label mt-2">Test Method:</label>
                        <div class="d-flex align-items-center">
                            <select id="testMethod" wire:model.live="test_method" class="form-select me-2">
                                <option value="null" selected>Select</option>
                                @foreach ($testmethods as $testmethod)
                                <option value="{{ $testmethod->test_method }}">{{ $testmethod->test_method }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNameModal">+</button>
                        </div>
                        @error('test_method') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="field" class="form-label mt-2">Field:</label>
                        <select id="field" wire:model.live="field" class="form-select">
                            <option value="numeric" selected disabled>numeric</option>
                            @if($type !='multiple field')
                            <option value="numeric unbound">numeric unbound</option>
                            <option value="multiple range">multiple range</option>
                            <option value="custom">custom</option>
                            @endif

                        </select>
                        @error('field') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="unit" class="form-label mt-2">Unit:</label>
                        <input type="text" class="form-control" wire:model.live="unit" id="unit" placeholder="Unit" {{$type=='multiple field' ? 'readonly' : ''}}>
                        @error('unit') <span class="text-danger">{{ $message }}</span> @enderror


                        @if ($field=='numeric')

                        <label for="rangeMin" class="form-label mt-2">Range:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" wire:model.live="range_min" id="range_min" {{$type=='multiple field' ? 'readonly' : ''}} placeholder="Min">
                            <span class="input-group-text">to</span>
                            <input type="number" class="form-control" wire:model.live="range_max" id="range_max" {{$type=='multiple field' ? 'readonly' : ''}} placeholder="Max">
                        </div>
                        @error('range_min') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('range_max') <span class="text-danger">{{ $message }}</span> @enderror

                        @elseif($field=='numeric unbound')

                        <label for="rangeMin" class="form-label mt-2">Range:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model.live="range_operation" id="operation" placeholder="Opertation">
                            <input type="text" class="form-control" wire:model.live="range_value" id="value" placeholder="value">
                        </div>
                        @error('range_operation') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('range_value') <span class="text-danger">{{ $message }}</span> @enderror

                        @elseif($field=='multiple range')

                        <label for="rangeMin" class="form-label mt-2">Range:</label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model.live="multiple_range" id="multiple_range" placeholder="Enter Range"></textarea>
                        </div>
                        @error('multiple_range') <span class="text-danger">{{ $message }}</span> @enderror


                        @elseif($field=='custom')

                        <div>
                            <label for="option" class="form-label mt-2">option</label>
                            <input type="text" class="form-control" wire:model.live="custom_option" id="option" placeholder="create option">
                            <label for="default" class="form-label mt-2">default</label>
                            <input type="text" class="form-control" wire:model.live="custom_default" id="option" placeholder="default option">

                        </div>
                        @endif

                        <button type="button" class="btn btn-primary mt-2" wire:click="addDataToArray">add field</button>

                    </div>
                </div>
                @else
                <div class="col">
                    <div class="d-flex col-md-12 flex-column">
                        <div class="d-flex-column flex-col align-items-center">
                            <label for="type" class="form-label me-2">Title:</label>
                            <input
                                type="text"
                                wire:model.live="subTestTitle"
                                class="form-control me-2"
                                style="max-width: 300px;" />

                                <div class="d-flex mt-2 justify-content-end">
                                    <button class="btn btn-primary btn-sm d-flex align-items-center">
                                        <i class="bx bx-pencil me-6"></i> Save
                                    </button>
                                </div>
                        </div>


                        <label for="test_name" class="form-label mt-2">{{ trans('cruds.test.fields.test_name') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" wire:model.live="subTest_name" id="test_name" placeholder="Test Name">
                        @error('test_name') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="testMethod" class="form-label mt-2">Test Method:</label>
                        <div class="d-flex align-items-center">
                            <select id="testMethod" wire:model.live="subTest_method" class="form-select me-2">
                                <option value="null" selected>Select</option>
                                @foreach ($testmethods as $testmethod)
                                <option value="{{ $testmethod->test_method }}">{{ $testmethod->test_method }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNameModal">+</button>
                        </div>
                        @error('test_method') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="field" class="form-label mt-2">Field:</label>
                        <select id="field" wire:model.live="field" class="form-select">
                            <option value="numeric" selected disabled>numeric</option>
                            @if($type !='multiple field')
                            <option value="numeric unbound">numeric unbound</option>
                            <option value="multiple range">multiple range</option>
                            <option value="custom">custom</option>
                            @endif

                        </select>
                        @error('field') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="unit" class="form-label mt-2">Unit:</label>
                        <input type="text" class="form-control" wire:model.live="unit" id="unit" placeholder="Unit" {{$type=='multiple field' ? 'readonly' : ''}}>
                        @error('unit') <span class="text-danger">{{ $message }}</span> @enderror


                        @if ($field=='numeric')

                        <label for="rangeMin" class="form-label mt-2">Range:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" wire:model.live="range_min" id="range_min" {{$type=='multiple field' ? 'readonly' : ''}} placeholder="Min">
                            <span class="input-group-text">to</span>
                            <input type="number" class="form-control" wire:model.live="range_max" id="range_max" {{$type=='multiple field' ? 'readonly' : ''}} placeholder="Max">
                        </div>
                        @error('range_min') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('range_max') <span class="text-danger">{{ $message }}</span> @enderror

                        @elseif($field=='numeric unbound')

                        <label for="rangeMin" class="form-label mt-2">Range:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model.live="range_operation" id="operation" placeholder="Opertation">
                            <input type="text" class="form-control" wire:model.live="range_value" id="value" placeholder="value">
                        </div>
                        @error('range_operation') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('range_value') <span class="text-danger">{{ $message }}</span> @enderror

                        @elseif($field=='multiple range')

                        <label for="rangeMin" class="form-label mt-2">Range:</label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model.live="multiple_range" id="multiple_range" placeholder="Enter Range"></textarea>
                        </div>
                        @error('multiple_range') <span class="text-danger">{{ $message }}</span> @enderror


                        @elseif($field=='custom')

                        <div>
                            <label for="option" class="form-label mt-2">option</label>
                            <input type="text" class="form-control" wire:model.live="custom_option" id="option" placeholder="create option">
                            <label for="default" class="form-label mt-2">default</label>
                            <input type="text" class="form-control" wire:model.live="custom_default" id="option" placeholder="default option">

                        </div>
                        @endif

                        <button type="button" class="btn btn-primary mt-2" wire:click="dataSubTest">Add Sub Field</button>

                    </div>
                </div>
                @endif

            </div>
        </div>




        <livewire:test.testmethod />

        <script>
            // Toggle plus/minus icon on collapse
            document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
                button.addEventListener('click', () => {
                    const isExpanded = button.getAttribute('aria-expanded') === 'true';
                    button.querySelector('.collapsed').classList.toggle('d-none', isExpanded);
                    button.querySelector('.expanded').classList.toggle('d-none', !isExpanded);
                });
            });
        </script>
    </div>
</div>