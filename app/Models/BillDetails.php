<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetails extends Model
{
    protected $fillable = [
        'user_id',
        'bill_size',
        'bill_heading',
        'name',
        'show_gst',
        'gst',
        'bill_header',
        'bill_footer',
        'sign',
        'header_height',
        'footer_height',
    ];
}
