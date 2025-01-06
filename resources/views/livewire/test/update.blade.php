<div>
    <!-- Add Test Modal -->
<div wire:ignore.self class="modal fade" id="UpdateTestModal" tabindex="-1" aria-labelledby="addTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addTestModalLabel">Add Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row g-3">
                        <!-- Department Selection -->
                        <div class="col-md-4">
                            <label for="dept_id" class="form-label">
                                {{ trans('cruds.test.fields.dept_id') }}<span class="text-danger">*</span>
                            </label>
                            <select class="form-select" wire:model="dept_id" id="dept_id">
                                <option value="null" disabled>Select</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->title }}</option>
                                @endforeach
                            </select>
                            @error('dept_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Title Input -->
                        <div class="col-md-4">
                            <label for="title" class="form-label">
                                {{ trans('cruds.test.fields.title') }}<span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model.live="title" 
                                id="title" 
                                placeholder="Enter {{ trans('cruds.test.fields.title') }}">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Amount Input -->
                        <div class="col-md-4">
                            <label for="amount" class="form-label">
                                {{ trans('cruds.test.fields.amount') }}<span class="text-danger">*</span>
                            </label>
                            <input 
                                type="number" 
                                class="form-control" 
                                wire:model="amount" 
                                id="amount" 
                                placeholder="Cost in ₹">
                            @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Code Input -->
                        <div class="col-md-4">
                            <label for="code" class="form-label">
                                {{ trans('cruds.test.fields.code') }}<span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model.live="code" 
                                id="code" 
                                placeholder="Enter {{ trans('cruds.test.fields.code') }}" 
                                readonly>
                            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Gender Selection -->
                        <div class="col-md-4">
                            <label for="bySex" class="form-label">{{ trans('cruds.test.fields.gender') }}</label>
                            <select id="bySex" wire:model="gender" class="form-select">
                                <option value="null" selected>Select Gender</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Sample Type Selection -->
                        <div class="col-md-4">
                            <label for="sample_type" class="form-label">
                                {{ trans('cruds.test.fields.sample_type') }}<span class="text-danger">*</span>
                            </label>
                            <select class="form-select" wire:model="sample_type" id="sample_type">
                                <option value="null" selected>
                                    Select {{ trans('cruds.test.fields.sample_type') }}
                                </option>
                                @foreach ($sampleTypes as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('sample_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Age Selection -->
                        <div class="col-md-4">
                            <label for="age" class="form-label">
                                {{ trans('cruds.test.fields.age') }}<span class="text-danger">*</span>
                            </label>
                            <select class="form-control" wire:model="age" id="age">
                                <option value="default">Default</option>
                                <option value="all">All</option>
                            </select>
                            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Suffix Input -->
                        <div class="col-md-4">
                            <label for="suffix" class="form-label">
                                {{ trans('cruds.test.fields.suffix') }}
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model="suffix" 
                                id="suffix" 
                                placeholder="Enter Barcode {{ trans('cruds.test.fields.suffix') }}">
                            @error('suffix') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click="update" class="btn btn-primary">Save Test</button>
            </div>
        </div>
    </div>
    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            $wire.on('reset-modal-test', (event) => {
                $('#UpdateTestModal').modal('hide');
            });
        });
    </script>
    @endscript
</div>

</div>