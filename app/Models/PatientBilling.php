<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientBilling extends Model
{

    protected $fillable = [
        'patient_id',
        'date',
        'discount_percent',
        'discount_by',
        'sampleCollector',
        'organisation',
        'discount_amount',
        'collectedat',
        'reason_of_discount',
        'advanced_payment',
        'due_payment',
        'total_amount',
        'payment_mode',
        'paid_amount',
        'home_collection_charge',

    ];

    public function patient(){
        return $this->belongsTo(PatientRegistration::class,'patient_id');
    }

    public function testbill(){
        return $this->hasMany(TestPackageBill::class,'bill_id', 'id');
    }

}
