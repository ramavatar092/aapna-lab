<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'code',
        'amount',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function tests()
{
    return $this->belongsToMany(Test::class, 'package_tests')
                ->withPivot('amount') // Include pivot data (price)
                ->withTimestamps();
}
public function packagename(){
    return $this->hasMany(Package::class, 'package_id');
}
public function packageInbill(){
    return $this->hasMany(TestPackageBill::class, 'package_id');
}

}
