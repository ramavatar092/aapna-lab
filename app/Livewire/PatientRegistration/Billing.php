<?php

namespace App\Livewire\PatientRegistration;

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

class Billing extends Component
{
    public $designation, $firstname, $lastname, $mobile, $gender, $age, $age_type, $email, $address;
    public $sampleCollector, $organisation, $collectedat, $b2bCenter;
    public $password;
    public $results = [];

    public $search, $selectSearchType = 1;

    public $DateandTime;
    public $selectedItems = [];

    // Billing Data

    public $totalAmount=0;
    public $discount_percent = 0.0;
    public $discount_amount = 0.0;
    public $discount_by;
    public $reason_of_discount;
    public $advanced_payment;
    public $due_payment;

    public $due_amount = 0;
    public $payment_mode = 'cash';

    public $home_collection_charge = 0;



    /**
     * Update Due Payment when Paid Amount or Discount Changes.
     */
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
        // Ensure all inputs are cast to numeric values
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

    #[On('patient-data')]
    public function edit($validateData)
    {
        $patientDetails = $validateData;

        $this->designation = $patientDetails['designation'];
        $this->firstname = $patientDetails['firstname'];
        $this->lastname = $patientDetails['lastname'];
        $this->mobile = $patientDetails['mobile'];
        $this->gender = $patientDetails['gender'];
        $this->age = $patientDetails['age'];
        $this->age_type = $patientDetails['age_type'];
        $this->address = $patientDetails['address'];
        $this->email = $patientDetails['email'];
        $this->sampleCollector = $patientDetails['sampleCollector'];
        $this->organisation = $patientDetails['organisation'];
        $this->collectedat = $patientDetails['collectedat'];
        $this->password = $this->mobile;

        $this->DateandTime = Carbon::now()->format('Y-m-d\TH:i');
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
            // Append the selected item to the table if not already present
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
    }

    public function register()
    {
       if($this->selectedItems !=[])
       {
        $user = User::updateOrCreate(
            [
                'mobile' => $this->mobile,
                'name' => $this->firstname,
                'gender' => $this->gender,
            ],
            [
                'lastname' => $this->lastname,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]
        );

        $patient = PatientRegistration::create([
            'user_id' => $user->id,
            'designation' => $this->designation,
            'address' => $this->address,
            'age' => $this->age,
            'age_type' => $this->age_type,
            'b2bCenter' => $this->b2bCenter,
            'created_by' => Auth::id(),
        ]);

        $billingData = [
            'patient_id' => $patient->id,
            'date' => $this->DateandTime,
            'discount_percent' => $this->discount_percent,
            'discount_amount'=>$this->discount_amount,
            'discount_by' => $this->discount_by,
            'sampleCollector' => $this->sampleCollector,
            'organisation' => $this->organisation,
            'collectedat' => $this->collectedat,
            'reason_of_discount' => $this->reason_of_discount,
            'advanced_payment' => $this->advanced_payment,
            'due_payment' => $this->due_payment,
            'total_amount' => $this->totalAmount,
            'payment_mode' => $this->payment_mode,
            'home_collection_charge' => $this->home_collection_charge,
        ];

        $newBilling = PatientBilling::create($billingData);

        $BillingTestPackage = [];
        foreach ($this->selectedItems as $selected) {
            $BillingTestPackage[] = [
                'test_id' => $selected['table_type'] == 'package' ? null : $selected['id'],
                'package_id' => $selected['table_type'] == 'package' ? $selected['id'] : null,
                'table_type' => $selected['table_type'],
                'bill_id' => $newBilling->id,
                'created_at' => now(),
            ];
        }

        TestPackageBill::insert($BillingTestPackage);
        $this->dispatch('bill-details',$newBilling->id);
        $this->dispatch('close-bill-modal');
        $this->dispatch('open-pdf-billing');
       }
       else{
        $this->dispatch('error',__('add test first'));
       }
        
    }

    public function render()
    {
        return view('livewire.patient-registration.billing');
    }
}
