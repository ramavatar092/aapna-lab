<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestCommission extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'test_id',
        'org_id',
        'bill_price',
        'commission_price',
        'commission_percent',
    ];


    public function test(){
        return $this->belongsTo(Test::class, 'test_id');
    }
    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'org_id');
    }   
}
