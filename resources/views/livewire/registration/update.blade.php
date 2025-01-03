<div wire:ignore.self class="modal fade" id="updateRegistrationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Edit {{ trans('cruds.patient_registration.title_singular') }}</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="row g-4">
                        <!-- Designation -->
                        <div class="col-md-4">
                            <label for="designation" class="form-label">{{ trans('cruds.patient_registration.fields.designation') }}</label>
                            <select class="form-select" wire:model="designation"  id="designation">
                            <option value="null" disabled>select</option>
                                <option value="Mr" >MR.</option>
                                <option value="Ms">MS.</option>
                                <option value="Mrs">MRS.</option>
                            </select>
                            @error('designation') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <!-- First Name -->
                        <div class="col-md-4">
                            <label for="firstName" class="form-label">{{ trans('cruds.patient_registration.fields.first_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="firstname" id="firstName" placeholder="{{ trans('cruds.patient_registration.fields.first_name') }}" >
                            @error('firstname') <span class="error">{{ $message }}</span> @enderror

                        </div>

                        <!-- Last Name -->
                        <div class="col-md-4">
                            <label for="lastName" class="form-label">{{ trans('cruds.patient_registration.fields.last_name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="lastname" id="lastName" placeholder="{{ trans('cruds.patient_registration.fields.last_name') }}">
                            @error('lastname') <span class="error">{{ $message }}</span> @enderror

                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <label for="email" class="form-label">{{ trans('cruds.patient_registration.fields.email') }}</label>
                            <input type="email" wire:model="email" class="form-control" id="email" placeholder="{{ trans('cruds.patient_registration.fields.email') }}">
                            @error('email') <span class="error">{{ $message }}</span> @enderror

                        </div>

                        <!-- Age -->
                        <div class="col-md-4">
                            <label for="age" class="form-label">{{ trans('cruds.patient_registration.fields.age') }} <span class="text-danger">*</span></label>
                            <input type="number" wire:model="age" class="form-control" id="age" placeholder="{{ trans('cruds.patient_registration.fields.age') }}" >
                            @error('age') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <!-- Age Type -->
                        <div class="col-md-4">
                            <label for="ageType" class="form-label">{{ trans('cruds.patient_registration.fields.age_type') }} <span class="text-danger">*</span></label>
                            <select class="form-select" wire:model="age_type"  id="ageType">
                                <option value="null" disabled>select</option>
                                <option  value="year" >Year</option>
                                <option  value="month">Month</option>
                                <option value="day">Day</option>
                            </select>
                            @error('age_type') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <!-- mobile Number -->
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">{{ trans('cruds.patient_registration.fields.mobile') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="tel"  wire:model="mobile" class="form-control" id="mobile" placeholder="{{ trans('cruds.patient_registration.fields.mobile') }}">
                            </div>
                            @error('mobile') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('cruds.patient_registration.fields.gender') }} <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input"  wire:model="gender" type="radio" name="gender" id="male" value="male" >
                                    <label class="form-check-label" for="male">Male</label>

                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input"  wire:model="gender" type="radio" name="gender" id="female" value="female" >
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"  wire:model="gender" type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>
                            @error('gender') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-md-12">
                            <label for="address" class="form-label">{{ trans('cruds.patient_registration.fields.address') }}</label>
                            <textarea class="form-control" wire:model="address" id="address" rows="3" placeholder="{{ trans('cruds.patient_registration.fields.address') }}"></textarea>
                            @error('address') <span class="error">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@script
<script>
    document.addEventListener('livewire:initialized',()=>{
        $wire.on('reset-modal-reg',(event)=>{
            $('#updateRegistrationModal').modal('hide');
        })
    })
</script>
@endscript
