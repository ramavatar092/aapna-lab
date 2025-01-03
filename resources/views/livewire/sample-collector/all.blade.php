<!-- sample-collector.blade.php -->
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h2 class="h4 mb-0 text-center">
                <i class="bi bi-person-bounding-box me-2"></i>Sample Collector
            </h2>
        </div>
        <div class="card-body p-4">
            <!-- Search Section -->
            <div class="row mb-4">
                <div class="col-md-6 mx-auto">
                    <div class="input-group">
                        <input wire:model.live="search" type="text" class="form-control" placeholder="Search by Name">
                        <button class="btn btn-outline-primary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="text-primary">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($collectors as $index => $collector)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-capitalize">{{ $collector->name }}</td>
                                <td>{{ $collector->phone }}</td>
                                <td>{{ $collector->email }}</td>
                                <td class="text-capitalize">{{ $collector->gender }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    <i class="bi bi-folder2-open"></i> No data available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $collectors->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
