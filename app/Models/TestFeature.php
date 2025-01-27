<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestFeature extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'test_id',
        'parent_id',
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
        'custom_range',
    ];

    public function parent()
    {
        return $this->belongsTo(TestFeature::class, 'parent_id');
    }


    public function children()
    {
        return $this->hasMany(TestFeature::class, 'parent_id');
    }
    public function test(){
        return $this->belongsTo(Test::class, 'test_id');
    }
}
