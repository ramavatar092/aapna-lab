<?php

namespace App\Livewire\Report;

use App\Models\PatientBilling;
use App\Models\PatientReport;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Mpdf\Mpdf;

class PdfPreview extends Component
{
    public $patientId;
    public $bill_id;
    public $patientDetialsPdf = [];
    public $user;

    #[On('patient_details')]
    public function PatientDetails($data)
    {
        $this->patientId = $data['patient_id'];
        $this->bill_id = $data['bill_id'];

        $this->patientDetialsPdf = PatientReport::where('patient_id', $this->patientId)->where('bill_id', $this->bill_id)->get();

        $this->user = PatientBilling::find($this->bill_id);
    }
    public function generatePdf()
    {
        try {
            // Collect data for the PDF
            $data = [
                'user' => $this->user,
                'patientDetails' => $this->patientDetialsPdf,
            ];

            // Render the view as HTML
            $html = view('pdf.report', $data)->render();

            // Validate the rendered HTML
            if (empty($html)) {
                throw new \Exception('Failed to render HTML for the report.');
            }

            // Initialize mPDF
            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4',
                'orientation' => 'P',
                'margin_top' => 10,
                'margin_right' => 10,
                'margin_bottom' => 10,
                'margin_left' => 10,
            ]);

            // Write HTML content to the PDF
            $mpdf->WriteHTML($html);

            // Define a unique filename
            $fileName = 'reports/report_' . $this->user->patient->user->mobile . '_' . time() . '.pdf';
            $filePath = 'public/' . $fileName;

            // Save the PDF to the storage path
            Storage::put($filePath, $mpdf->Output('', 'S'));

            // Generate a public URL
            $fileUrl = Storage::url($fileName);

            // Retrieve the base URL from the .env file or fallback to app URL
            $baseUrl = env('REPORT_BASE_URL', config('app.url'));
            $fullUrl = $baseUrl . $fileUrl;

            // Prepare the WhatsApp message
            $whatsappMessage = "Hello {$this->user->name},\n\n";
            $whatsappMessage .= "Your report is ready! You can download it using the link below:\n\n";
            $whatsappMessage .= $fullUrl . "\n\n";
            $whatsappMessage .= "Thank you for choosing our service!";

            // URL-encode the message
            $encodedMessage = urlencode($whatsappMessage);

            // Generate the WhatsApp URL to send the message
            $whatsappLink = "https://wa.me/91{$this->user->patient->user->mobile}?text={$encodedMessage}";

            // Redirect to the WhatsApp link
            return redirect()->away($whatsappLink);
        } catch (\Mpdf\MpdfException $e) {
            return response()->json(['error' => 'PDF generation failed: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.report.pdf-preview');
    }
}
