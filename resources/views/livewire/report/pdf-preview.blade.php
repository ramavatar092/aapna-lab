<div wire:ignore.self class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="thyroidModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #ddd; padding: 15px;">
        <h5 class="modal-title" id="thyroidModalLabel" style="font-weight: bold;">Patient Test Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body" id="printableContent" style="padding: 20px; font-family: Arial, sans-serif; line-height: 1.6;">
        <!-- Patient Details Section -->
        <h6 style="font-weight: bold; margin-bottom: 15px;">Patient Details</h6>
        @if ($user)
        <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9; margin-bottom: 20px;">
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span><strong>Name:</strong> {{$user->patient->user->name}} {{$user->patient->user?->lastname}}</span>
            <span><strong>Date:</strong> {{ \Carbon\Carbon::parse($user->date)->format('d-m-Y') }}</span>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span><strong>Age/Gender:</strong> {{$user->patient->age}} {{$user->patient->age_type}}/{{$user->patient->user->gender}}</span>
            <span><strong>Patient ID:</strong> {{$user->patient->id}}</span>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span><strong>Referred By:</strong> {{$user->organisation ? $user->organisation : 'self'}}</span>
            <span><strong>Report Date:</strong> {{ \Carbon\Carbon::parse($user->date)->format('d/m/Y h:i A') }}</span>
          </div>
          <div>
            <span><strong>Report ID:</strong> RE1504</span>
          </div>
        </div>
        @endif

        @if ($patientDetialsPdf)
        @php
        $groupedTestOnTitle = collect($patientDetialsPdf)->groupBy('title');
        @endphp

        @foreach ($groupedTestOnTitle as $title => $tests)
        <!-- Section Title -->
        <h5 style="color: #007bff; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">{{ $title }}</h5>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
          <thead>
            <tr>
              <th style="border: 1px solid #ddd; padding: 8px; background-color: #f8f9fa; text-align: left;">Test Parameter</th>
              <th style="border: 1px solid #ddd; padding: 8px; background-color: #f8f9fa; text-align: left;">Result</th>
              <th style="border: 1px solid #ddd; padding: 8px; background-color: #f8f9fa; text-align: left;">Flag</th>
              <th style="border: 1px solid #ddd; padding: 8px; background-color: #f8f9fa; text-align: left;">Reference Range</th>
              <th style="border: 1px solid #ddd; padding: 8px; background-color: #f8f9fa; text-align: left;">Unit</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tests as $test)
            <tr>
              <td style="border: 1px solid #ddd; padding: 8px;">{{ $test->test_parameter }}</td>
              <td style="border: 1px solid #ddd; padding: 8px;">{{ $test->observed_value }}</td>
              <td style="border: 1px solid #ddd; padding: 8px;">{{ $test->flag ?? 'N/A' }}</td>
              <td style="border: 1px solid #ddd; padding: 8px;">{{ $test->range_description }}</td>
              <td style="border: 1px solid #ddd; padding: 8px;">{{ $test->unit }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endforeach

        @endif
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 10px; padding: 15px;">
        <button class="btn btn-primary" onclick="printReport()">Print</button>
        <button class="btn btn-success">Send</button>
      </div>
    </div>
  </div>
</div>

<script>
  function printReport() {
    const content = document.getElementById('printableContent').innerHTML;

    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.open();
    printWindow.document.write(`
      <html>
        <head>
          <title>Print Report</title>
          <style>
            body {
              font-family: Arial, sans-serif;
              line-height: 1.6;
              padding: 20px;
            }
            .modal-header, .modal-footer {
              background-color: #f8f9fa;
              padding: 15px;
            }
            table {
              width: 100%;
              border-collapse: collapse;
              margin-bottom: 20px;
            }
            th, td {
              border: 1px solid #ddd;
              padding: 8px;
              text-align: left;
            }
            th {
              background-color: #f8f9fa;
            }
          </style>
        </head>
        <body>
          ${content}
        </body>
      </html>
    `);
    printWindow.document.close();
    printWindow.print();
    printWindow.onafterprint = () => printWindow.close();
  }
</script>
