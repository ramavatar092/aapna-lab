<div class="container mt-5">

    <!-- Patient Information Card -->
    <div class="card mb-4 shadow-sm" style="border: none;">
        <div class="card-body">
            <!-- Patient Information -->
            <div class="row">
                <div class="col-md-3"><strong>Name:</strong> {{ $patientDetails->patient->user->name }} {{ $patientDetails->patient->user->lastname }}</div>
                <div class="col-md-3"><strong>Gender:</strong> {{ $patientDetails->patient->user->gender }}</div>
                <div class="col-md-3"><strong>Age:</strong> {{ $patientDetails->patient->age }} {{ $patientDetails->patient->age_type }}</div>
                <div class="col-md-3"><strong>Status:</strong> <span class="text-success">{{$patientDetails->status}}</span></div>
            </div>

            <!-- Session Message -->
            @if (session()->has('message'))
            <div
                class="alert alert-success d-flex align-items-center mt-3"
                role="alert"
                style="border-radius: 10px; padding: 10px 20px; background-color: #D4EDDA; color: #155724; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); animation: fadeIn 0.5s;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2 bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 011.07 1.05l-3.992 5a.75.75 0 01-1.08.02L5.324 9.384a.75.75 0 011.06-1.06L8 9.94l2.97-3.97z" />
                    <path d="M16 8a8 8 0 11-16 0 8 8 0 0116 0zm-8 7a7 7 0 100-14 7 7 0 000 14z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
            @endif
        </div>
    </div>


    <!-- Report Table -->
    <div class="card shadow-sm" style="border: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="bg-light">
                        <tr>
                            <th>Tests</th>
                            <th>Observed Value</th>
                            <th>Units</th>
                            <th>Normal Range</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storedParameter as $index => $data)
                        <tr>
                            <td>{{ $data['test_name'] }}</td>
                            <td>
                                @if ($data['type'] != 'multiple-field')
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    wire:model.defer="observedValues.{{ $index }}"
                                    placeholder="Enter value"
                                    style="border-radius: 8px; height: 38px; border: none; background-color: #f7f7f7;">
                                @endif
                            </td>
                            <td>{{ $data['unit'] }}</td>
                            <td>
                                @if ($data['field'] == 'numeric')
                                {{ $data['range_min'] }} - {{ $data['range_max'] }}
                                @elseif ($data['field'] == 'numeric-unbound')
                                {{ $data['range_operation'] }} {{ $data['range_value'] }}
                                @elseif ($data['field'] == 'multiple-range')
                                {{ $data['multiple_range'] }}
                                @elseif ($data['field'] == 'custom')
                                {{ $data['custom_range'] }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Save Button -->
            <div class="d-flex justify-content-end mt-4 align-items-center">
                <!-- Save Button -->
                <button
                    class="btn btn-primary btn-sm"
                    wire:click="saveValues"
                    style="border-radius: 20px; padding: 10px 20px; background-color: #4CAF50; color: white;">
                    Save Observed Values
                </button>



            </div>



        </div>
    </div>

    <!-- Footer Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <button class="btn btn-link text-decoration-none text-muted">+ Note on Report</button>
        <button class="btn btn-link text-decoration-none text-danger">+ Add Issue for Technician</button>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-end mt-3">
        <button class="btn btn-outline-primary btn-sm me-2" style="border-radius: 20px; padding: 8px 16px; border-color: #007BFF; color: #007BFF;">
            Print
        </button>
        <button class="btn btn-primary btn-sm me-2" style="border-radius: 20px; padding: 8px 16px; background-color: #007BFF; color: white;">
            Save
        </button>
        <button class="btn btn-success btn-sm" style="border-radius: 20px; padding: 8px 16px; background-color: #28a745; color: white;">
            Approve & Print
        </button>
    </div>
</div>