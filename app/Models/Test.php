<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 
        
       'dept_id',
        'title',
        'amount',
        'code',
        'gender',
        'sample_type',
        'age',
        'suffix',
        'type',
        'test_name',
        'test_method',
        'field',
        'unit',
        'range_min',
        'range_max',
        'range_operation',
        'range_value',
        'multiple_range',
        'custom_default',
        'custom_option',
        'created_by', 
        'updated_by',
        'deleted_by',
    ];

   
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_tests')
                    ->withPivot('amount') // Include pivot data (amount)
                    ->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'id');
    }

    public function organisation(){
        return $this->belongsTo(Organisation::class);
    }
    public function testCommissions()
    {
        return $this->hasMany(TestCommission::class, 'test_id');
    }
    public function testname(){
        return $this->hasMany(TestPackageBill::class, 'test_id');
    }
}
