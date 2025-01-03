<div>
    <style>
        .patient-details {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 5px;
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #6c757d;
            margin-right: 15px;
        }

        .medical-history {
            margin-top: 20px;
        }

        .action-btn {
            text-align: right;
        }
    </style>
    <div class="container mt-4">
        <div class="patient-details">
            <h4>Patient Details</h4>
            <div class="profile-info">
                <div class="profile-pic">S</div>
                <div>
                    <h5>{{$patientDetail->user->name}} <span class="text-muted">#{{$patientDetail->user->id}}</span></h5>
                    <p class="mb-1"><strong>Gender:</strong> {{$patientDetail->user->gender}}</p>
                    <p class="mb-1"><strong>Age:</strong> {{$patientDetail->age}} {{$patientDetail->age_type}}</p>
                </div>
            </div>
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mt-4">Medical History</h5>
                <div class="d-flex">
                    <input
                        type="text"
                        class="form-control me-2"
                        placeholder="Search by Test or Doctor"
                        style="width: 250px;">
                </div>
            </div>

            <div class="table-responsive medical-history">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Tests</th>
                            <th>Rf. Doctors</th>
                            <th>Due (in ₹)</th>
                            <th>Amount (in ₹)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($patientbillingDetails as $billList)
                       <tr>
                            <td>{{ \Carbon\Carbon::parse($billList->date)->format('d/m/Y h:i A') }}</td>
                            <td>
                                @foreach($billList->testbill as $bill)
                                    @php
                                        $test = $bill->table_type == 'test' ? $bill->test->title : $bill->package->title;
                                        $statusInfo = getStatus($billList->status);
                                    @endphp
                                    <span class="btn btn-sm btn-warning mb-1" style="font-size: 11px;">{{ $test }}</span>
                                @endforeach
                            </td>
                            <td>{{ $billList->organisation }}</td>
                            <td>{{ $billList->due_payment }}</td>
                            <td>{{ $billList->due_payment+$billList->advanced_payment }}</td>
                            @php
                                $statusInfo = getStatus($billList->status);
                            @endphp
                            <td><span class="badge {{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span></td>
                            <td><button class="btn btn-primary btn-sm">View Report</button></td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
