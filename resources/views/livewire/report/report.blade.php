<div class="container mt-5">

    <!-- Patient Information Card -->
    <div class="card mb-4 shadow-sm" style="border: none;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Name:</strong> {{ $patientDetails->patient->user->name }} {{ $patientDetails->patient->user->lastname }}
                </div>
                <div class="col-md-3">
                    <strong>Gender:</strong> {{ $patientDetails->patient->user->gender }}
                </div>
                <div class="col-md-3">
                    <strong>Age:</strong> {{ $patientDetails->patient->age }} {{ $patientDetails->patient->age_type }}
                </div>
                <div class="col-md-3">
                    <strong>Status:</strong> <span class="text-success">{{ $patientDetails->status }}</span>
                </div>
            </div>

            @if (session()->has('message'))
            <div class="alert alert-success mt-3">{{ session('message') }}</div>
            @endif
        </div>
    </div>

    <!-- Report Table -->
    <div class="card shadow-sm" style="border: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-light">
                        <tr>
                            <th>Test</th>
                            <th>Observed Value</th>
                            <th>Units</th>
                            <th>Normal Range</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $groupedTests = collect($storedParameter)->groupBy('title'); //it will collect the data in array by using collect method and it will group it by title which i stored in the array which i comming form the backend component
                        @endphp

                        <!-- it will print the title and after it print the test parameter of it -->
                        @foreach ($groupedTests as $testTitle => $parameters)
                        
                        <!-- Test Title Row -->
                        <tr>
                            <td colspan="5" style="padding: 16px ; white-space: nowrap;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Test Title -->
                                    <strong class="h4">{{ $testTitle }}</strong>
                                      @php
                                      $getdata=$parameters->first();
                                      @endphp              
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <div class="d-flex align-items-center" style="gap: 5px;">
                                        <input type="checkbox" wire:model.defer="interpretations.{{ $loop->index }}">
                                        <span class="text-sm">Show Interpretation</span>
                                        </div>
                                        <a href="{{route('admin.testfeature',$getdata['test_id'])}}" class="btn btn-sm btn-outline-primary">Comment</a>
                                    </div>

                                </div>
                            </td>
                        </tr>


                        <!-- Test Parameters -->
                        @foreach ($parameters as $index => $parameter)
                        <tr>
                            @if ($parameter['type'] != 'multiple-field')
                            <td style="padding: 8px 40px;">{{ $parameter['test_parameter'] }}</td>
                            @else
                            <td style="padding: 16px 15px;"><strong>{{ $parameter['test_parameter'] }}</strong></td>
                            @endif

                            <td style="padding: 7px 15px;">
                                @if ($parameter['type'] != 'multiple-field')
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    wire:model.defer="observedValues.{{ $loop->parent->index * 100 + $index }}"
                                    placeholder="Enter value"
                                    style="border-radius: 8px; height: 38px; background-color: #f7f7f7;">

                                @endif
                            </td>
                            <td style="padding: 5px 15px;">{{ $parameter['unit'] }}</td>
                            <td style="padding: 5px 15px;">
                                @if ($parameter['field'] == 'numeric')
                                {{ $parameter['range_min'] }} - {{ $parameter['range_max'] }}
                                @elseif ($parameter['field'] == 'numeric-unbound')
                                {{ $parameter['range_operation'] }} {{ $parameter['range_value'] }}
                                @elseif ($parameter['field'] == 'multiple-range')
                                {{ $parameter['multiple_range'] }}
                                @elseif ($parameter['field'] == 'custom')
                                {{ $parameter['custom_range'] }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary btn-sm" wire:click="saveValues">Save Observed Values</button>
            </div>
        </div>
    </div>
</div>