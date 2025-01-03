<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientRegistration extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'designation',
        'address',
        'email',
        'age',
        'age_type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function organisation(){
        return $this->belongsTo(Organisation::class, 'organisation', 'id');
    }
    public function sampleCollector(){
        return $this->belongsTo(User::class, 'sampleCollector', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function patientbilling(){
        return $this->hasMany(PatientBilling::class, 'patient_id');
    }
}
