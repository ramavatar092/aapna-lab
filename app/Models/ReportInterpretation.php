<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportInterpretation extends Model
{
    protected $fillable = [
        'interpretation_heading_font_size',
        'interpretation_content_font_size',
        'note_heading_font_size',
        'note_content_font_size',
        'logo',
        'logo_size',
        'logo_margin',
        'top_margin',
        'user_id',
    ];

    /**
     * Accessor for the logo path.
     *
     * @return string|null
     */
    public function getLogoAttribute()
    {
        if (!$this->attributes['logo']) {
            return null;
        }

        return asset('storage/images/report/' . $this->attributes['logo']);
    }
}
