<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'ref_type',
        'name',
        'degree',
        'compliment',
        'username',
        'password',
        'mobile',
        'address',
        'clear_due',
        'financial_analysis',
        'login_status',
        'test_id',
        'created_by',
        'updated_by',
        'deleted_by'
        
    ];

    public function user(){
        return $this->belongsTo(User::class,'id','org_id');
    }
       // Tests relation
       public function tests()
       {
           return $this->hasMany(Test::class, 'org_id');
       }
   
       // TestCommissions through Tests
       public function testCommissions()
       {
           return $this->hasManyThrough(TestCommission::class, Test::class, 'org_id', 'test_id');
       }
}
