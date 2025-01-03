<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleCollector extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'phone',
        'email',
    ];
}
