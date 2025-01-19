<div class="container my-4">
    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#b2b-labs" data-bs-toggle="tab">B2B Labs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#wallet-history" data-bs-toggle="tab">Wallet History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#settlement-history" data-bs-toggle="tab">Settlement History</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="b2b-labs">
            <!-- Actions Row -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="badge bg-warning text-dark">Trial ends in 3 days!</span>
                </div>
                <div>
                    <button class="btn btn-primary me-2">Razorpay Dashboard</button>
                    <button class="btn btn-success me-2">Add Money</button>
                    <button class="btn btn-secondary">+ New B2B Lab</button>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Search B2B Center">
            </div>

            <!-- Data Table -->
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>B2B Lab</th>
                        <th>Sales Manager</th>
                        <th>Security Amount</th>
                        <th>Booking Limit</th>
                        <th>Credit Limit</th>
                        <th>Rolling Advance</th>
                        <th>Current Balance</th>
                        <th>Active Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>B2B 1</td>
                        <td></td>
                        <td>10000</td>
                        <td>0</td>
                        <td>2000</td>
                        <td></td>
                        <td>1880</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm">Edit</button>
                                <button class="btn btn-outline-primary btn-sm">Price List</button>
                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>ram1</td>
                        <td></td>
                        <td>5000</td>
                        <td>0</td>
                        <td>5000</td>
                        <td></td>
                        <td>-100</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm">Edit</button>
                                <button class="btn btn-outline-primary btn-sm">Price List</button>
                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="wallet-history">
            <p>Wallet History Content</p>
        </div>
        <div class="tab-pane fade" id="settlement-history">
            <p>Settlement History Content</p>
        </div>
    </div>
</div>