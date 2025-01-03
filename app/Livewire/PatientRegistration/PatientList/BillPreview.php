<?php

namespace App\Livewire\PatientRegistration\PatientList;

use App\Models\PatientBilling;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public function editbilling($id){
        $this->billdetails = PatientBilling::find($id);
    }

    public function generateInvoice()
    {
        $user = User::where('id', Auth::id())->first();

        try {
            $this->isGeneratingInvoice = true;
            $html = view('livewire.patient-registration.patient-list.bill-preview', [
                'user'                => $user,
                'billdetails'         => $this->billdetails,
                'isGeneratingInvoice' => $this->isGeneratingInvoice,
            ])->render();

            $mpdf = new Mpdf([
                'format'        => 'A4',
                'orientation'   => 'P',
                'margin_top'    => 10,
                'margin_right'  => 10,
                'margin_bottom' => 10,
                'margin_left'   => 10,
            ]);

            $mpdf->WriteHTML($html);

            $this->isGeneratingInvoice = false;
            $this->dispatch('close-invoice-model');

            return response()->streamDownload(function () use ($mpdf) {
                $mpdf->Output();
            }, 'billing.pdf');

        } catch (\Mpdf\MpdfException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        $user = User::where('id', Auth::id())->first();
        return view('livewire.patient-registration.patient-list.bill-preview',[
            'user'=>$user,
        ]);
    }
}
