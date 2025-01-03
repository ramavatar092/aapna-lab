
    <style>
        .card {
            text-align: center;
        }
        .icon-loading {
            font-size: 2rem;
            color: #6c757d;
        }
    </style>

    <div class="container my-4">
        <!-- Stock Stats Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">In Stock</h6>
                        <div class="icon-loading">⏳</div>
                        <a href="#" class="btn btn-link">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Out of Stock</h6>
                        <div class="icon-loading">⏳</div>
                        <a href="#" class="btn btn-link">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Expired Stock</h6>
                        <div class="icon-loading">⏳</div>
                        <a href="#" class="btn btn-link">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Today's Total Expenditure</h6>
                        <div class="icon-loading">⏳</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="d-flex justify-content-between mb-4">
            <div>
                <a href="#" class="btn btn-primary">Items</a>
                <a href="#" class="btn btn-success">Suppliers</a>
                <a href="#" class="btn btn-warning">Stock Mapping</a>
                <a href="#" class="btn btn-danger">Manual Consumption</a>
            </div>
            <a href="#" class="btn btn-outline-primary position-relative">
                Go to Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                </span>
            </a>
        </div>

        <!-- Orders Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <ul class="nav nav-tabs" id="orderTabs">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#placedOrders">Placed Orders</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#receivedOrders">Received Orders</button>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="placedOrders">
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-box2"></i>
                            <p>No data</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="receivedOrders">
                        <!-- Add received orders content here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Expenditure -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h6>Expenditure</h6>
            <div>
                <input type="date" class="form-control d-inline-block w-auto" value="2024-11-21">
                <span class="mx-2">to</span>
                <input type="date" class="form-control d-inline-block w-auto" value="2024-11-28">
            </div>
        </div>
    </div>


