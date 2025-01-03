<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{   
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'slug',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function tests()
    {
        return $this->hasMany(Test::class, 'dept_id', 'id');
    }
    
}
