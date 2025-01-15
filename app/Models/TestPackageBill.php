<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestPackageBill extends Model
{
    protected $fillable = [
        'test_id',
        'package_id',
        'table_type',
        'bill_id',
        'created_at',
        'updated_at',
    ];

    public function testpackagebill(){
        return $this->belongsTo(PatientBilling::class, 'bill_id');
    }

    public function package(){
        return $this->belongsTo(Package::class, 'package_id','id');
    }
    public function test(){
        return $this->belongsTo(Test::class, 'test_id');
    }
}
