<?php

namespace App\Livewire\PatientRegistration\Quotation;

use Livewire\Attributes\On;
use Livewire\Component;
use Mpdf\Mpdf;

class Pdf extends Component
{
    public $data;
    public $designation, $name, $selectedItems, $totalAmount, $finalAmount, $phone, $email, $discount_percent, $discount_amount;
    public $isGeneratingPDF = false;

    #[On('Quotation-data')]
    public function getData($data){
        $this->data             = $data;
        $this->designation      = $this->data['designation'] ?? '';
        $this->name             = $this->data['name'] ?? '';
        $this->selectedItems    = $this->data['test/package'] ?? [];
        $this->totalAmount      = $this->data['totalAmount'] ?? 0;
        $this->finalAmount      = $this->data['finalAmount'] ?? 0;
        $this->phone            = $this->data['phone'] ?? '';
        $this->email            = $this->data['email'] ?? '';
        $this->discount_percent = $this->data['discountPercent'] ?? 0;
        $this->discount_amount  = $this->data['discountAmount'] ?? 0;
    }

    public function generatePDF()
    {
        try {
            $this->isGeneratingPDF = true;
            $html = view('livewire.patient-registration.quotation.pdf', [
                'designation'       => $this->designation,
                'name'              => $this->name,
                'selectedItems'     => $this->selectedItems,
                'totalAmount'       => $this->totalAmount,
                'finalAmount'       => $this->finalAmount,
                'phone'             => $this->phone,
                'email'             => $this->email,
                'discount_percent'  => $this->discount_percent,
                'discount_amount'   => $this->discount_amount,
                'isGeneratingPDF'   => $this->isGeneratingPDF,
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

            $this->isGeneratingPDF = false;

            return response()->streamDownload(function () use ($mpdf) {
                $mpdf->Output();
            }, 'quotation.pdf');

        } catch (\Mpdf\MpdfException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.patient-registration.quotation.pdf');
    }
}
