<?php

namespace App\Livewire\PatientRegistration\PatientList;

use App\Models\PatientBilling;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Mpdf\Mpdf;
use Livewire\Component;


class BillPreview extends Component
{
    public $designation, $firstname, $lastname, $mobile, $gender, $age, $age_type, $email, $address;
    public $sampleCollector, $organisation, $collectedat, $b2bCenter;

    public $billdetails;
    public $isGeneratingInvoice = false;

    #[On('bill-details')]
    public function editbilling($id)
    {
        $this->billdetails = PatientBilling::find($id);
    }

    public function generateInvoice()
    {
        $user = User::where('id', Auth::id())->first();
    
        try {
            $this->isGeneratingInvoice = true;
    
            // Render the HTML for the invoice
            $html = view('pdf.bill', [
                'user'                => $user,
                'billdetails'         => $this->billdetails,
                'isGeneratingInvoice' => $this->isGeneratingInvoice,
            ])->render();
    
            // Check if the HTML is correct
            if (empty($html)) {
                throw new \Exception('Failed to render HTML for the invoice.');
            }
    
            $mpdf = new Mpdf([
                'format'        => 'A4',
                'orientation'   => 'P',
                'margin_top'    => 10,
                'margin_right'  => 10,
                'margin_bottom' => 10,
                'margin_left'   => 10,
            ]);
    
            $mpdf->WriteHTML($html);
    
            // Define the storage path for the PDF
            $fileName = 'billing_' . $this->billdetails->patient->user->mobile . $this->billdetails->id.'.pdf';
            $filePath = 'billing/' . $fileName;
    
            // Save the PDF file to the public disk
            Storage::disk('public')->put($filePath, $mpdf->Output('', 'S'));
    
            $this->isGeneratingInvoice = false;
            $this->dispatch('close-invoice-model');
    
            // Generate a public URL from the storage path
            $fileUrl = Storage::url($filePath);
    
            // Retrieve the base URL from the .env file
            $baseUrl = env('WHATSAPP_BASE_URL');
    
            // Construct the full URL
            $fullUrl = $baseUrl . $fileUrl;
    
            // Prepare the WhatsApp message
            $whatsappMessage = "Hello {$this->billdetails->patient->user->name},\n\n";
            $whatsappMessage .= "Your invoice is ready! You can download it using the link below:\n\n";
            $whatsappMessage .= $fullUrl . "\n\n";
            $whatsappMessage .= "Thank you for your business!";
    
            // URL-encode the message
            $encodedMessage = urlencode($whatsappMessage);
    
            // Generate the WhatsApp URL to send the message
            $whatsappLink = "https://wa.me/91{$this->billdetails->patient->user->mobile}?text={$encodedMessage}";
    
            // Redirect to the WhatsApp link
            return redirect()->away($whatsappLink);
    
        } catch (\Mpdf\MpdfException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }       

    public function render()
    {
        $user = User::where('id', Auth::id())->first();
        return view('livewire.patient-registration.patient-list.bill-preview', [
            'user' => $user,
        ]);
    }
}
