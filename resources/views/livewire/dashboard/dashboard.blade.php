<div class="container mt-5">
        <h1 class="mb-4 text-center text-primary">Admin Dashboard</h1>
        <div class="row g-4">
            <!-- Total Patients -->
            <div class="col-md-3">
                <div class="card text-center" style="border: none; border-radius: 10px; background-color: #e9f5ff; transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="card-body">
                        <div class="text-primary" style="font-size: 2.5rem;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h5 class="card-title mt-2">Total Patients</h5>
                        <p class="card-text fs-4">{{ $total_patients }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Test Performed -->
            <div class="col-md-3">
                <div class="card text-center" style="border: none; border-radius: 10px; background-color: #eafbee; transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="card-body">
                        <div class="text-success" style="font-size: 2.5rem;">
                            <i class="bi bi-currency-rupee"></i>
                        </div>
                        <h5 class="card-title mt-2">Total Test Performed</h5>
                        <p class="card-text fs-4">{{ $perform_test }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Tests -->
            <div class="col-md-3">
                <div class="card text-center" style="border: none; border-radius: 10px; background-color: #fff5e6; transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="card-body">
                        <div class="text-warning" style="font-size: 2.5rem;">
                            <i class="bx bx-flask-fill text-black"></i>
                        </div>
                        <h5 class="card-title mt-2">Total Tests</h5>
                        <p class="card-text fs-4">{{ $total_tests }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Packages -->
            <div class="col-md-3">
                <div class="card text-center" style="border: none; border-radius: 10px; background-color: #fdeaea; transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="card-body">
                        <div class="text-danger" style="font-size: 2.5rem;">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5 class="card-title mt-2">Total Packages</h5>
                        <p class="card-text fs-4">{{ $total_packages }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>