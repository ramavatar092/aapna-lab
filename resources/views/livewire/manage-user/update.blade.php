<div>
<div class="container mt-5 d-flex justify-content-center">


<div wire:ignore.self  class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" wire:model="name">
                        @error('name') 
                        <div class="text-danger"><small>{{ $message }}</small></div> 
                        @enderror
                    </div>

                    <!-- Contact -->
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="text" class="form-control" id="contact" placeholder="Contact" wire:model="contact">
                        </div>
                        @error('contact') 
                        <div class="text-danger"><small>{{ $message }}</small></div> 
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" wire:model="gender">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" wire:model="gender">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="Other" wire:model="gender">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                        @error('gender') 
                        <div class="text-danger"><small>{{ $message }}</small></div> 
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" wire:model="email">
                        @error('email') 
                        <div class="text-danger"><small>{{ $message }}</small></div> 
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" wire:model="username">
                        @error('username') 
                        <div class="text-danger"><small>{{ $message }}</small></div> 
                        @enderror
                    </div>

                 
                    

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select wire:model="role" id="role" class="form-select">
                            <option value="null" selected>Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role') 
                        <div class="text-danger"><small>{{ $message }}</small></div> 
                        @enderror
                    </div>
                </form>
            </div>

            <!-- Save Button -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click="saveUser">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Livewire Script -->
@script
<script>
document.addEventListener('livewire:initialized', () => {
    $wire.on('reset-modal-user', () => {
        $('#updateUserModal').modal('hide');
    });
});
</script>
@endscript

</div>