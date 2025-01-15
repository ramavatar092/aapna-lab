<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'test_id',
    ];


    public function test(){
        return $this->belongsTo(Test::class,'test_id');
    }
}
