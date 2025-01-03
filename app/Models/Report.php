<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'header_image',
        'header_height',
        'footer_image',
        'footer_height',
        'background_image',
        'font',
        'left_margin',
        'right_margin',
        'user_id'
    ];

    /**
     * Accessor for the header_image path.
     *
     * @return string|null
     */
    public function getHeaderImageAttribute()
    {
        if (!$this->attributes['header_image']) {
            return null;
        }

        return asset('storage/images/report/' . $this->attributes['header_image']);
    }

    /**
     * Accessor for the footer_image path.
     *
     * @return string|null
     */
    public function getFooterImageAttribute()
    {
        if (!$this->attributes['footer_image']) {
            return null;
        }

        return asset('storage/images/report/' . $this->attributes['footer_image']);
    }

    /**
     * Accessor for the background_image path.
     *
     * @return string|null
     */
    public function getBackgroundImageAttribute()
    {
        if (!$this->attributes['background_image']) {
            return null;
        }

        return asset('storage/images/report/' . $this->attributes['background_image']);
    }
}
