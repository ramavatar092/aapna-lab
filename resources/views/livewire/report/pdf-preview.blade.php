<div wire:ignore.self class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="thyroidModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="thyroidModalLabel">Patient Test Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Patient Details Section -->
        <h6 class="fw-bold mb-3">Patient Details</h6>
        @if ($user)
        <div class="border p-3 rounded mb-4 bg-light">
          <div class="d-flex mb-2">
            <span class="fw-bold me-2">Name:</span>
            <span>{{$user->patient->user->name}} {{$user->patient->user?->lastname}}</span>
            <span class="fw-bold ms-auto me-2">Date:</span>
            <span>{{ \Carbon\Carbon::parse($user->date)->format('d-m-Y') }}</span>
          </div>
          <div class="d-flex mb-2">
            <span class="fw-bold me-2">Age/Gender:</span>
            <span>{{$user->patient->age}} {{$user->patient->age_type}}/{{$user->patient->user->gender}}</span>
            <span class="fw-bold ms-auto me-2">Patient ID:</span>
            <span>{{$user->patient->id}}</span>
          </div>
          <div class="d-flex mb-2">
            <span class="fw-bold me-2">Referred By:</span>
            <span>{{$user->organisation ? $user->organisation : 'self'}}</span>
            <span class="fw-bold ms-auto me-2">Report Date:</span>
            <span>{{ \Carbon\Carbon::parse($user->date)->format('d/m/Y h:i A') }}</span>
          </div>
          <div class="d-flex">
            <span class="fw-bold me-2">Report ID:</span>
            <span>RE1504</span>
          </div>
        </div>
        @endif


        @if ($patientDetialsPdf)
        @php
        $groupedTestOnTitle = collect($patientDetialsPdf)->groupBy('title');
        @endphp

        @foreach ($groupedTestOnTitle as $title => $tests)
        <!-- Section Title -->
        <h5 class="text-primary fw-bold mt-4 mb-3">{{ $title }}</h5>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Test Parameter</th>
              <th>Result</th>
              <th>Flag</th>
              <th>Reference Range</th>
              <th>Unit</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tests as $test)
            <tr>
              <td>{{ $test->test_parameter }}</td>
              <td>{{ $test->observed_value }}</td>
              <td>{{ $test->flag ?? 'N/A' }}</td>
              <td>{{ $test->range_description }}</td>
              <td>{{ $test->unit }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endforeach

        @endif

        <!-- Interpretation Section -->
        <h6 class="fw-bold mb-3 mt-4">Interpretation</h6>
        <p class="mb-2"><strong>Pregnancy Reference Range:</strong></p>
        <ul class="mb-4">
          <li>1st Trimester: 0.10-2.50 uIU/mL</li>
          <li>2nd Trimester: 0.20-3.00 uIU/mL</li>
          <li>3rd Trimester: 0.30-3.00 uIU/mL</li>
        </ul>
        <ol>
          <li>Primary hypothyroidism is accompanied by elevated serum T3 & T4 values along with depressed TSH level.</li>
          <li>Secondary hypothyroidism is accompanied by depressed serum T3 and T4 values & elevated serum TSH levels.</li>
          <li>Normal T4 levels accompanied by high T3 levels and low TSH are seen in patients with T3 thyrotoxicosis.</li>
          <li>Normal or low T3 & high T4 levels indicate T4 thyrotoxicosis.</li>
          <li>Normal T3 & T4 along with low TSH indicate mild/subclinical HYPERTHYROIDISM.</li>
          <li>Normal T3 & T4 levels along with high TSH indicate mild/subclinical HYPOTHYROIDISM.</li>
          <li>
            Slightly elevated TSH levels may be found in pregnancy and estrogen therapy, while depressed levels may be
            encountered in severe illness, malnutrition, renal failure, and during therapy with drugs like propranolol.
          </li>
          <li>
            Elevated TSH levels are nearly always indicative of primary hypothyroidism, but rarely they can result from
            TSH secretion by TSH INSENSITIVE 4TH GENERATION CHEMILUMINESCENT ASSAY.
          </li>
        </ol>

        <!-- Comments Section -->
        <h6 class="fw-bold mb-3 mt-4">Comments</h6>
        <p>
          Test results should be interpreted in context with clinical condition and associated results of other
          investigations. Previous assay levels should be considered to detect trends. TSH levels within provided
          reference intervals are normal.
        </p>
        <p><strong>Note:</strong> TSH levels are subject to circadian variations peaking between 6-10 PM.</p>
      </div>
    </div>
  </div>
</div>