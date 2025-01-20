<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>

<body>



    <!-- Modal Body -->
    <div style="border: 1px solid #ddd; margin: 0; padding: 0; font-family: Arial, sans-serif;">
        <!-- Modal Header -->
        <div style="background-color: #f8f9fa; border-bottom: 1px solid #ddd; padding: 15px; text-align: center;">
            <h5 style="font-weight: bold; margin: 0;">Patient Test Report</h5>
        </div>

        <!-- Modal Body -->
        <div style="padding: 20px; line-height: 1.6;">
            <!-- Patient Details Section -->
            <h6 style="font-weight: bold; margin-bottom: 15px;">Patient Details</h6>
            @if ($user)
            <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9; margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px;">
                    <span><strong>Name:</strong> {{$user->patient->user->name}} {{$user->patient->user?->lastname}}</span>
                    <span><strong>Date:</strong> {{ \Carbon\Carbon::parse($user->date)->format('d-m-Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px;">
                    <span><strong>Age/Gender:</strong> {{$user->patient->age}} {{$user->patient->age_type}}/{{$user->patient->user->gender}}</span>
                    <span><strong>Patient ID:</strong> {{$user->patient->id}}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px;">
                    <span><strong>Referred By:</strong> {{$user->organisation ? $user->organisation : 'self'}}</span>
                    <span><strong>Report Date:</strong> {{ \Carbon\Carbon::parse($user->date)->format('d/m/Y h:i A') }}</span>
                </div>
                <div style="font-size: 14px;">
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
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd; font-size: 14px;">
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
    </div>

</body>

</html>