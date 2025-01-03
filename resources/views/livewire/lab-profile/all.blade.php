<div class="container mt-5">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="lab-tab" data-bs-toggle="tab" data-bs-target="#lab" type="button" role="tab" aria-controls="lab" aria-selected="true">Lab Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="report-tab" data-bs-toggle="tab" data-bs-target="#report" type="button" role="tab" aria-controls="report" aria-selected="false">Report Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bill-tab" data-bs-toggle="tab" data-bs-target="#bill" type="button" role="tab" aria-controls="bill" aria-selected="false">Bill Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="doctor-tab" data-bs-toggle="tab" data-bs-target="#doctor" type="button" role="tab" aria-controls="doctor" aria-selected="false">Doctor Details</button>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content p-0" id="myTabContent">
        <div class="tab-pane fade show active" id="lab" role="tabpanel" aria-labelledby="lab-tab">
            <div class="mt-4">
                <!-- Form -->

                    <div class="row g-3">
                        <!-- Lab Name -->
                        <div class="col-md-6">
                            <label for="labName" class="form-label"><span class="text-danger">*</span> Lab Name</label>
                            <input type="text" class="form-control" id="labName" value="{{$user->name}}" placeholder="Lab Name">
                        </div>
                        <!-- Owner Name -->
                        <div class="col-md-6">
                            <label for="ownerName" class="form-label"><span class="text-danger">*</span> Owner Name</label>
                            <input type="text" class="form-control" id="ownerName" value="{{$user->name}}" placeholder="Owner Name">
                        </div>
                        <!-- Contact -->
                        <div class="col-md-6">
                            <label for="contact" class="form-label"><span class="text-danger">*</span> Contact</label>
                            <div class="input-group">
                                <select class="form-select" value="{{$user->mobile}}" style="max-width: 80px;">
                                    <option selected>IN +91</option>
                                </select>
                                <input type="text" class="form-control" id="contact" placeholder="Contact">
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Id</label>
                            <input type="email" value="{{$user->email}}" class="form-control" id="email" placeholder="Email Id">
                        </div>
                        <!-- City -->
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" placeholder="City">
                        </div>
                        <!-- Website -->
                        <div class="col-md-6">
                            <label for="website" class="form-label">Website</label>
                            <div class="input-group">
                                <span class="input-group-text">https://</span>
                                <input type="text" class="form-control" id="website" placeholder="Website">
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="2" placeholder="Address"></textarea>
                            <div class="form-text text-end"></div>
                        </div>
                    </div>

                    <!-- Login Password Section -->
                    <div class="mt-4">
                        <h6>Set Login Password</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label"><span class="text-danger">*</span> Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Username">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="mt-5">
                <!-- Card for Razorpay Integration -->
                <div class="card">
                    <div class="card-header bg-light d-flex align-items-center">
                        <span class="fw-bold">Razorpay Integration</span>
                        <span class="ms-2 text-muted" data-bs-toggle="tooltip" title="Provide Razorpay details for integration.">
                            <i class="bi bi-info-circle"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <!-- Account Number -->
                                <div class="col-md-4">
                                    <label for="accountNumber" class="form-label fw-bold">* Account Number</label>
                                    <input type="text" class="form-control" id="accountNumber" placeholder="Enter account number" required>
                                </div>
                                <!-- Holder Name -->
                                <div class="col-md-4">
                                    <label for="holderName" class="form-label fw-bold">* Holder Name</label>
                                    <input type="text" class="form-control" id="holderName" placeholder="Enter holder name" required>
                                </div>
                                <!-- IFSC Code -->
                                <div class="col-md-4">
                                    <label for="ifscCode" class="form-label fw-bold">* IFSC Code</label>
                                    <input type="text" class="form-control" id="ifscCode" placeholder="Enter IFSC code" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Email ID -->
                                <div class="col-md-4">
                                    <label for="emailId" class="form-label fw-bold">* Email ID</label>
                                    <input type="email" class="form-control" id="emailId" placeholder="Enter email ID" required>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- patient detals -->
        <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
            <!-- here i used inline component -->
            <livewire:lab-profile.report-detail />
            <livewire:lab-profile.patient-details />
            <livewire:lab-profile.report-test-spacing />

            <livewire:lab-profile.report-interpretation />




        </div>
        <div class="tab-pane fade" id="bill" role="tabpanel" aria-labelledby="bill-tab">
        <livewire:lab-profile.bill-details />
        </div>
        <div class="tab-pane fade" id="doctor" role="tabpanel" aria-labelledby="doctor-tab">

        <livewire:lab-profile.doctor-details />

        </div>
    </div>
</div>
