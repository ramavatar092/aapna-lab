<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDetail extends Model
{
    protected $fillable = [
        'doctor_name',
        'degree',
        'sign',
        'position',
        'doctor_name_font',
        'degree_font_size',
        'spacing',
        'space_name_degree',
        'alignment',
        'signature_setting',
        'end_of_report',
        'department',
        'user', 
        'user_id',
    ];
}
