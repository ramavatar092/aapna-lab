<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'designation',
        'name',
        'mobile',
        'email',
        'discount_percentage',
        'discount_rupee',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
