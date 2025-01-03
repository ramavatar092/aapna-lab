<div wire:ignore.self class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table style="width: 100%; table-layout: fixed;">
                    <tr>
                        <td><h3>Quotation</h3></td>
                    </tr>
                </table>

                <table style="width: 100%; table-layout: fixed;">
                    <tr>
                        <td>{{ config('app.name') }}</td>
                    </tr>
                </table>


                <table style="width: 100%; table-layout: fixed; margin-bottom: 10px">
                    <tr>
                        <td style="width: 50%;"><strong>Name : </strong> {{ $designation }} {{ $name }}</td>
                        <td style="text-align: right;">{{ \Carbon\Carbon::now()->format('d/m/Y h:i A') }}</td>
                    </tr>
                </table>

                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <thead style="background-color: #fff">
                        <tr>
                            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">#</th>
                            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Test Description</th>
                            <th style="padding: 8px; border: 1px solid #ddd; text-align: right;">Amount (₹)</th>
                        </tr>
                    </thead>
                    @if(!empty($selectedItems))
                        <tbody>
                            @foreach($selectedItems as $index => $item)
                                <tr>
                                    <td style="width: 10%; padding: 8px; border: 1px solid #ddd;">{{ $index + 1 }}</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $item['title'] }}</td>
                                    <td style="width: 20%; padding: 8px; border: 1px solid #ddd; text-align: right;">{{ $item['amount'] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right;">Sub Total</td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">₹{{ $totalAmount }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right; color: #28a745;">Discount</td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right; color: #28a745;">-₹{{ $discount_amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 8px; border-right: 1px solid #ddd; text-align: right;"><b>Total</b></td>
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: right;"><b>₹{{ $finalAmount }}</b></td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            @if(!$isGeneratingPDF)
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" wire:click="generatePDF">Generate PDF</button>
                </div>
            @endif
        </div>
    </div>
</div>
