<div class="container mt-5">
    <!-- Patient Information Card -->
    <div class="card mb-4 shadow-sm" style="border: none;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3"><strong>Name:</strong> {{ $patientDetails->name }}</div>
                <div class="col-md-3"><strong>Gender:</strong> {{ $patientDetails->gender }}</div>
                <div class="col-md-3"><strong>Age:</strong> {{ $patientDetails->age }} years</div>
                <div class="col-md-3"><strong>Status:</strong> <span class="text-success">Completed</span></div>
            </div>
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
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    wire:model.defer="observedValues.{{ $index }}"
                                    placeholder="Enter value"
                                    style="border-radius: 8px; height: 38px; border: none; background-color: #f7f7f7;">
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
            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary btn-sm" wire:click="saveValues" style="border-radius: 20px; padding: 10px 20px; background-color: #4CAF50; color: white;">
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
