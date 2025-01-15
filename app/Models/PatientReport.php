<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    protected $fillable = [
        'title',
        'patient_id',
        'bill_id',
        'test_id',
        'test_name',
        'observed_value',
        'unit',
        'field',
        'range_operation',
        'range_value',
        'range_min',
        'range_max',
        'multiple_range',
        'custom_default',
        'custom_option',
        'custom_range',
        'range_description',
    ];
}
