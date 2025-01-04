<div class="container my-4">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="incomplete-tab" data-bs-toggle="tab" data-bs-target="#incomplete" type="button" role="tab" aria-controls="incomplete" aria-selected="false">Incomplete</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="partial-tab" data-bs-toggle="tab" data-bs-target="#partial" type="button" role="tab" aria-controls="partial" aria-selected="false">Partial</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete" type="button" role="tab" aria-controls="complete" aria-selected="false">Complete</button>
      </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-4" id="myTabContent">
      <!-- Tab Pane: All -->
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
        <div class="row mt-3">
          <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Search by name or barcode...">
          </div>
          <div class="col-md-4">
            <select class="form-select">
              <option value="">All</option>
            </select>
          </div>
          <div class="col-md-4">
            <input type="date" class="form-control" value="2025-01-04">
          </div>
        </div>
        <div class="table-responsive mt-4">
          <table class="table table-bordered text-center">
            <thead class="table-light">
              <tr>
                <th>Patient ID</th>
                <th>Patient Details</th>
                <th>Ref. Doctor</th>
                <th>Tests</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="7" class="text-center">
                  <div class="py-5">
                    <img src="https://via.placeholder.com/50" alt="No data" class="mb-2">
                    <p>No data</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Tab Pane: Incomplete -->
      <div class="tab-pane fade" id="incomplete" role="tabpanel" aria-labelledby="incomplete-tab">
        <p>Content for Incomplete</p>
      </div>

      <!-- Tab Pane: Partial -->
      <div class="tab-pane fade" id="partial" role="tabpanel" aria-labelledby="partial-tab">
        <p>Content for Partial</p>
      </div>

      <!-- Tab Pane: Complete -->
      <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
        <p>Content for Complete</p>
      </div>
    </div>
  </div>
