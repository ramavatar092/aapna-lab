<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interpretation extends Model
{
    protected $fillable = [
        'interpretation',
        'user_id',
        'test_id',
    ];
}
