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
           

            // Render the HTML for the PDF
            $html = view('pdf.report', [
                'user' => $this->user,
                'patientDetialsPdf' => $this->patientDetialsPdf,

            ])->render();
            


            if (empty($html)) {
                throw new \Exception('Failed to render HTML for the report.');
            }

            // Initialize mPDF
            $mpdf = new Mpdf([
                'format'        => 'A4',
                'orientation'   => 'P',
                'margin_top'    => 10,
                'margin_right'  => 10,
                'margin_bottom' => 10,
                'margin_left'   => 10,
            ]);

            $mpdf->WriteHTML($html);

            // Define a unique filename and storage path
            $fileName = 'report_' . $this->user->patient->user->mobile . '_' . $this->bill_id . '.pdf';
            $filePath = 'reports/' . $fileName;

            // Save the PDF to the storage disk
            Storage::disk('public')->put($filePath, $mpdf->Output('', 'S'));

            // Generate a public URL for the file
            $fileUrl = Storage::url($filePath);

            // Retrieve the base URL from the .env file (if needed)
            $baseUrl = env('WHATSAPP_BASE_URL'); // Use the base app URL
            $fullUrl = $baseUrl . $fileUrl;

            // Prepare the WhatsApp message
            $whatsappMessage = "Hello {$this->user->patient->user->name},\n\n";
            $whatsappMessage .= "Your report is ready! You can download it using the link below:\n\n";
            $whatsappMessage .= $fullUrl . "\n\n";
            $whatsappMessage .= "Thank you for choosing us!";

            // URL-encode the message
            $encodedMessage = urlencode($whatsappMessage);

            // Generate the WhatsApp URL
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
