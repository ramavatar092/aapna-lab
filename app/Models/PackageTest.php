<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTest extends Model
{

public function test(){
    return $this->hasMany(Package::class,'test_id');
}

}
