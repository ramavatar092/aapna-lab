<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'designation',
        'firstname',
        'lastname',
        'mobile',
        'gender',
        'address',
        'email',
        'age',
        'age_type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
