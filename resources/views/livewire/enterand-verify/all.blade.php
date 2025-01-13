<div class="container my-4">
  <div class="row mb-3">
    <div class="col-md-6">
      <input type="text" class="form-control" placeholder="Search by name or barcode">
    </div>
    <div class="col-md-3">
      <select class="form-select">
        <option selected>All</option>
        <!-- Add more filter options here -->
      </select>
    </div>
    <div class="col-md-3">
      <input type="date" class="form-control">
    </div>
  </div>

  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Details</th>
        <th>Ref</th>
        <th>Tests</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($patientDetails as $key=> $patient)
      <tr>
        <td>{{$key+1}}</td>
        <td>{{ $patient->patient->user->name }} {{ $patient->patient->user->lastname ?? '' }}</td>
        <td>
        {{ $patient->organisation ? $patient->organisation : 'self'}}
        </td>
        <td>
          @php
          $testNames = $patient?->testbill->map(function ($bill) {
          return $bill?->table_type == 'test' ? $bill?->test?->title : $bill?->package?->title;
          })->implode(', ');
          @endphp

          <span class="">{{ $testNames }}</span>

        </td>
        <td>{{ \Carbon\Carbon::parse($patient->date)->format('d/m/Y h:i A') }}</td>
       
        <td>
          @php $statusInfo = getStatus($patient->status); @endphp
          <span class="badge {{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span>
        </td>
        <td>
          <a href="{{route('admin.report',$patient->id)}}" class="btn btn-sm btn-primary">
            Report
          </button>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>