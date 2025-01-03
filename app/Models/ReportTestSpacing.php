<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTestSpacing extends Model
{
    protected $fillable = [
        'departmentFontSize',
        'columnHeadingFontSize',
        'testNameFontSize',
        'sampleTypeFontSize',
        'testParameterFontSize',
        'testMethodFontSize',
        'spacingBetweenTests',
        'barcode',
        'spacingDepartment',
        'spacingTestName',
        'spacingColumnHeader',
        'spacingTestParameters',
        'spacingTestMethod',
        'refRange',
        'spacingUnit',
        'user_id',
    ];
}
