<?php

use App\Models\Package;
use App\Models\PatientBilling;
use App\Models\PatientRegistration;
use App\Models\Test;
use Picqer\Barcode\BarcodeGeneratorPNG;


if (!function_exists('getTotals')) {
    function getTotals()
    {
       return[
            'total_tests' => Test::count(),
            'total_packages' => Package::count(),
            'total_patients' => PatientRegistration::count(),
            'perform_test' => PatientBilling::count(),
        ];
    }
}

if (!function_exists('numberToWords')) {

    function numberToWords($number)
    {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary = [
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand'
        ];


        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return $negative . numberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = (int) ($number / 10) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = (int) ($number / 100);
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . numberToWords($remainder);
                }
                break;
            default:
                $baseUnit   = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= numberToWords($remainder);
                }
                break;
        }

        if ($fraction !== null) {
            $string .= $decimal;
            $words = [];
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}

if (!function_exists('getStatus')) {

    function getStatus($status)
    {
        $statusConfig = config('constant.status.' . $status);

        // Check if the status exists in the config, return default values if not
        if ($statusConfig) {
            return $statusConfig;
        }

        // Return default value if the status does not exist
        return [
            'label' => 'Ongoing',
            'class' => 'btn-secondary',
        ];
    }
}


if (!function_exists('generatorBarcode')) {

    /**
     * Generate a barcode in multiple types.
     *
     * @param string $content The content to be encoded in the barcode.
     * @param string $barcodeType The type of barcode to generate.
     * @return string The base64-encoded barcode image.
     */
    function generatorBarcode($content, $barcodeType)
    {
        $barcodeTypes = [
            'TYPE_CODE_128' => BarcodeGeneratorPNG::TYPE_CODE_128,
            'TYPE_CODE_39'  => BarcodeGeneratorPNG::TYPE_CODE_39,
            'TYPE_EAN_13'   => BarcodeGeneratorPNG::TYPE_EAN_13,
            'TYPE_UPC_A'    => BarcodeGeneratorPNG::TYPE_UPC_A,
            'TYPE_EAN_8'    => BarcodeGeneratorPNG::TYPE_EAN_8,
            'TYPE_UPC_E'    => BarcodeGeneratorPNG::TYPE_UPC_E
        ];

        if (!array_key_exists($barcodeType, $barcodeTypes)) {
            $barcodeType = BarcodeGeneratorPNG::TYPE_CODE_128;
        }

        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($content, $barcodeTypes[$barcodeType]);

        return base64_encode($barcode);
    }
}
