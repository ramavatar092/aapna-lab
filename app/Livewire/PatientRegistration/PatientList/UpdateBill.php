<?php

namespace App\Livewire\PatientRegistration\PatientList;


use App\Models\Package;
use App\Models\PatientBilling;
use App\Models\PatientRegistration;
use App\Models\Test;
use App\Models\TestPackageBill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateBill extends Component
{
    public $designation, $firstname, $lastname, $mobile, $gender, $age, $age_type, $email, $address;
    public $sampleCollector, $organisation, $collectedat, $b2bCenter;
    public $password;
    public $results = [];

    public $search, $selectSearchType = 1;

    public $DateandTime;
    public $selectedItems = [];

    // Billing Data
    public $amount = 0;
    public $discount_percent = 0.0;
    public $discount_amount = 0.0;
    public $discount_by;
    public $reason_of_discount;
    public $advanced_payment;
    public $due_payment;

    public $due_amount = 0;
    public $payment_mode = 'cash';

    public $home_collection_charge = 0;
    public $userId;
    public $patientId;
    public $totalAmount = 0;

    public $id;

    #[On('update-billdetails')]
    public function getBillId($id)
    {
        $bill = PatientBilling::find($id);

        $this->discount_percent     = $bill->discount_percent;
        $this->discount_by          = $bill->discount_by;
        $this->reason_of_discount   = $bill->reason_of_discount;
        $this->advanced_payment     = $bill->advanced_payment;
        $this->due_payment          = $bill->due_payment;
        $this->payment_mode         = $bill->payment_mode;
        $this->home_collection_charge = $bill->home_collection_charge;
        $this->DateandTime          = $bill->date;
        $this->sampleCollector      = $bill->sampleCollector;
        $this->organisation         = $bill->organisation;
        $this->discount_amount      = $bill->discount_amount;
        $this->collectedat          = $bill->collectedat;
        $this->gender               = $bill->patient->user->gender;
        $this->firstname            = $bill->patient->user->name;
        $this->lastname             = $bill->patient->user->lastname;
        $this->mobile               = $bill->patient->user->mobile;
        $this->address              = $bill->patient->address;
        $this->age                  = $bill->patient->age;
        $this->age_type             = $bill->patient->age_type;
        $this->userId               = $bill->patient->user_id;
        $this->patientId            = $bill->patient_id;
        $this->id                   = $id; //for updating patient bill information

        // Map testbill data to selectedItems
        $this->selectedItems = $bill->testbill->map(function ($testbill) {
            return [
                'id'         => $testbill->test_id ?? $testbill->package_id,
                'table_type' => $testbill->table_type,
                'title'      => $testbill->test->title ?? $testbill->package->title,
                'code'       => $testbill->test->code ?? $testbill->package->code,
                'amount'     => $testbill->test->amount ?? $testbill->package->amount,
            ];
        })->toArray();
    }

    public function updatedPaidAmount()
    {
        $this->calculateDuePayment();
    }

    public function updatedDiscountPercent()
    {
        $this->discount_amount = 0; // Reset discount amount
        foreach ($this->selectedItems as $item) {
            $amount = (float)$item['amount']; // Cast to float
            $discountPercent = (float)$this->discount_percent; // Cast to float
            $this->discount_amount += ($amount * $discountPercent) / 100;
        }

        $this->calculateDuePayment();
    }

    public function calculateDuePayment()
    {
        $totalAmount = array_sum(array_column($this->selectedItems, 'amount')) + (float)$this->home_collection_charge;
        $this->totalAmount = $totalAmount;
        $paidAmount = (float)$this->advanced_payment;
        $discountAmount = (float)$this->discount_amount;

        // Calculate due payment
        $this->due_payment = $totalAmount - ($paidAmount + $discountAmount);
    }

    public function updatedAdvancedPayment($value)
    {
        $this->advanced_payment = $value;
        $this->calculateDuePayment();
    }

    public function updatedHomeCollectionCharge($value)
    {
        $this->home_collection_charge = $value;
        $this->calculateDuePayment();
    }

    public function updatedDiscountAmount($value)
    {
        $this->discount_amount = $value;
        $this->calculateDuePayment();
    }

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
            $exists = collect($this->selectedItems)->contains('code', $result->code);
            if (!$exists) {
                $this->selectedItems[] = [
                    'id' => $result->id,
                    'table_type' => $result->table_type,
                    'title' => $result->title,
                    'code' => $result->code,
                    'amount' => $result->amount,
                ];
            }
        }

        $this->search = '';
        $this->results = [];
        $this->calculateDuePayment();
        $this->updatedDiscountPercent();
    }

    public function removeItem($index)
    {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems);
        $this->calculateDuePayment();
    }

    public function updateBill()
    {
        $billingData = [
            'date'              => $this->DateandTime,
            'discount_percent'  => $this->discount_percent,
            'discount_amount'   => $this->discount_amount,
            'discount_by'       => $this->discount_by,
            'sampleCollector'   => $this->sampleCollector,
            'organisation'      => $this->organisation,
            'collectedat'       => $this->collectedat,
            'reason_of_discount' => $this->reason_of_discount,
            'advanced_payment'  => $this->advanced_payment,
            'due_payment'       => $this->due_payment,
            'total_amount'      => $this->totalAmount,
            'payment_mode'      => $this->payment_mode,
            'home_collection_charge' => $this->home_collection_charge,
        ];

        PatientBilling::where('patient_id', $this->patientId)->where('id', $this->id)->update($billingData);

        $billingTestPackage = [];
        foreach ($this->selectedItems as $selected) {
            $billingTestPackage[] = [
                'test_id'    => $selected['table_type'] == 'package' ? null : $selected['id'],
                'package_id' => $selected['table_type'] == 'package' ? $selected['id'] : null,
                'table_type' => $selected['table_type'],
                'bill_id'    => $this->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        TestPackageBill::where('bill_id', $this->id)->delete();
        TestPackageBill::where('bill_id', $this->id)->insert($billingTestPackage);
        $this->dispatch('reset-update-bill');
        $this->dispatch('refresh-updated-bill');
        $this->dispatch('success', __('Bill updated successfully'));
    }

    public function render()
    {
        return view('livewire.patient-registration.patient-list.update-bill');
    }
}
