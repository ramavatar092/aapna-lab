<div>

    <div wire:ignore.self class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @if ($billdetails)
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                        <!-- Header -->
                        <tr>
                            <td style="width: 50%; vertical-align: top;">
                                <h4>{{ config('app.name') }}</h4>
                                @if(!empty($user->name))
                                <h4 class="fw-bold">{{ $user->name }}</h4>
                                @endif
                                {{--@if(!empty($user->address))
                                    <p>{{ $user->address }}</p>
                                @endif--}}
                                @if(!empty($user->email))
                                <p>Email: {{ $user->email }}</p>
                                @endif
                            </td>
                            <td style="width: 50%; text-align: right; vertical-align: top;">
                                @if(!empty($user->mobile))
                                <p><strong>Mob:</strong> {{ $user->mobile }}</p>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <hr>

                    <table style="width: 100%; table-layout: fixed;">
                        <tr>
                            <td>
                                <h3>Invoice-cum-receipt</h3>
                            </td>
                        </tr>
                    </table>

                    <!-- Invoice Details -->
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                        <tr>
                            <td style="width: 50%; vertical-align: top;">
                                <p>
                                    <strong>Bill ID:</strong> {{ $billdetails->id }}<br>
                                    <strong>Name:</strong> {{ $billdetails->patient->designation }} {{ $billdetails->patient->user->name }}<br>
                                    <strong>Age/Gender:</strong> {{ $billdetails->patient->age }} {{ ucwords($billdetails->patient->age_type) }}/{{ ucwords($billdetails->patient->user->gender) }}
                                </p>
                            </td>
                            <td style="width: 50%; text-align: right; vertical-align: top;">
                                <p>
                                    <strong>Bill Date:</strong> {{ \Carbon\Carbon::parse($billdetails->date)->format('d/m/Y h:i A') }}<br>
                                    <strong>Referred By:</strong> Self<br>
                                    <strong>Payment Type:</strong> {{ ucwords($billdetails->payment_mode) }}
                                </p>
                            </td>
                        </tr>
                    </table>

                    <!-- Table of Tests/Packages -->
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th style="width: 10%; border: 1px solid #ddd; padding: 8px;">#</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Test/Package Description</th>
                                <th style="width: 20%; border: 1px solid #ddd; text-align: right; padding: 8px;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($billdetails->testbill))
                            @foreach ($billdetails->testbill as $key => $bill)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $key + 1 }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">
                                    {{ $bill->test ? $bill->test->title : ($bill->package ? $bill->package->title : 'N/A') }}
                                </td>
                                <td style="border: 1px solid #ddd; text-align: right; padding: 8px;">
                                    {{ $bill->test ? $bill->test->amount : ($bill->package ? $bill->package->amount : '0') }}
                                </td>
                            </tr>
                            @endforeach
                            @endif

                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right;">Sub Total</td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">₹{{ $billdetails->total_amount }}</td>
                            </tr>

                            @if($billdetails->discount_amount)
                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right; color: green;">Discount</td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right; color: green;">- ₹{{ $billdetails->discount_amount }}</td>
                            </tr>
                            @endif

                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right; font-weight: bold;">Total</td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right; font-weight: bold;">₹{{ $billdetails->due_payment + $billdetails->advanced_payment }}</td>
                            </tr>
                            @if($billdetails->advanced_payment)
                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right; font-weight: bold;">Paid Amount</td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right; font-weight: bold;">₹{{ $billdetails->advanced_payment }}</td>
                            </tr>
                            @endif


                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right;">Balance Due</td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">₹{{ $billdetails->due_payment }}</td>
                            </tr>

                            <tr>
                                <td colspan="3" style="padding: 8px; text-align: right;">
                                    <p>Total In Words : {{ numberToWords($billdetails->total_amount) }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if(!$isGeneratingInvoice)
                <div class="modal-footer justify-content-between">
                    <div class="d-flex gap-2 ">
                        <button type="button" wire:click="$dispatch('update-billdetails',{id:{{$billdetails->id}}})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatebillingModal">
                            Edit
                        </button>
                        <button type="button" wire:click="$dispatch('update-billdetails',{id:{{$billdetails->id}}})" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updatebillingModal">
                            Enter Result
                        </button>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success" wire:click="generateInvoice">Send</button>
                        <button type="button" class="btn btn-warning" onclick="printInvoice()">Print </button>

                    </div>
                </div>
                @endif
                @endif
            </div>

        </div>
    </div>
    <script>
        function printInvoice() {
            // Get the modal content
            const invoiceModal = document.querySelector('#invoiceModal .modal-content');
            if (!invoiceModal) {
                alert('Invoice content not found!');
                return;
            }

            // Create a new window
            const printWindow = window.open('', '_blank', 'width=800,height=600');

            // Add the content to the new window
            printWindow.document.write(`
        <html>
            <head>
                <title>Invoice</title>
                <style>
                    /* General Styles */
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background: #fff; /* Ensure a white background */
                        color: #000; /* Black text */
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
                        background-color: #f2f2f2;
                    }
                    h3, h4 {
                        margin: 0;
                    }

                    /* Hide unwanted elements */
                    @media print {
                        .btn, .modal-footer, .btn-close, .modal-header {
                            display: none !important;
                        }
                        .modal-content {
                            box-shadow: none !important; /* Remove modal shadows */
                            border: none !important; /* Remove modal borders */
                        }
                    }
                </style>
            </head>
            <body>
                ${invoiceModal.innerHTML}
            </body>
        </html>
        `);

            // Close the document to trigger styles rendering
            printWindow.document.close();

            // Wait for the content to load, then print
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        }
    </script>

</div>