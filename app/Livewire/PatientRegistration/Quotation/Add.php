<?php

namespace App\Livewire\PatientRegistration\Quotation;

use App\Models\Package;
use App\Models\Test;
use Livewire\Component;
use Mpdf\Mpdf;

class Add extends Component
{
    public $designation, $name, $phone, $email;
    public $search, $selectSearchType = 1;
    public $discount_percent, $discount_amount;
    public $results = [];
    public $totalAmount = 0;
    public $finalAmount = 0;
    public $selectedItems = [];

    public function updatedSearch()
    {
        if ($this->selectSearchType == 1) {
            $this->results = Test::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%')
                ->take(6)
                ->get()
                ->toArray();
        } else {
            $this->results = Package::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%')
                ->take(6)
                ->get()
                ->toArray();
        }
    }


    public function selectResult($id)
    {
        if ($this->selectSearchType == 1) {
            $result = Test::find($id);
        } else {
            $result = Package::find($id);
        }

        if ($result) {
            // Append the selected item to the table if not already present
            $exists = collect($this->selectedItems)->contains('code', $result->code);
            if (!$exists) {
                $this->selectedItems[] = [
                    'id' => $result->id,
                    'title' => $result->title,
                    'table_type' => $result->table_type,
                    'code' => $result->code,
                    'amount' => $result->amount,
                ];
            }
        }


        $this->updateTotalAmount();
        $this->search = '';
        $this->results = [];
    }

    public function updateTotalAmount()
    {
        $totalAmount = collect($this->selectedItems)->sum('amount');

        $this->totalAmount = (float) $totalAmount;

        if ($this->discount_percent > 0) {
            $this->discount_amount = ($this->totalAmount * ((float) $this->discount_percent)) / 100;
        } else {
            $this->discount_amount = (float) $this->discount_amount;
        }

        $this->finalAmount = $this->totalAmount - $this->discount_amount;
    }

    public function updatedDiscountPercent()
    {
        $this->discount_percent = (float) $this->discount_percent;
        $this->updateTotalAmount();
    }

    public function updatedDiscountAmount()
    {
        $this->discount_amount = (float) $this->discount_amount;
        $this->discount_percent = 0; // Reset percent-based discount if amount is entered manually
        $this->updateTotalAmount();
    }

    public function pdfPreview()
    {
        $data = [
            'designation'       => $this->designation,
            'name'              => $this->name,
            'test/package'      => $this->selectedItems,
            'totalAmount'       => $this->totalAmount,
            'finalAmount'       => $this->finalAmount,
            'phone'             => $this->phone,
            'email'             => $this->email,
            'discountPercent'   => $this->discount_percent,
            'discountAmount'    => $this->discount_amount,

        ];

        $this->dispatch('Quotation-data', $data);
        $this->dispatch('open-pdf-quotation');

        $data = [];
    }

    public function removeItem($index)
    {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems);
    }

    public function render()
    {
        return view('livewire.patient-registration.quotation.add');
    }
}
