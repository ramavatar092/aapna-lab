<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $tests = [
            [
                'dept_id' => 1,
                'tests' => [
                    [
                        'title'         => 'Complete Blood Count (CBC)',
                        'amount'        => 500,
                        'code'          => 'CBC001',
                        'gender'        => 'male',
                        'sample_type'   => 'Null',
                    ],
                    [
                        'title'         => 'Liver Function Test (LFT)',
                        'amount'        => 700,
                        'code'          => 'LFT002',
                        'gender'        => 'both',
                        'sample_type'   => 'Null',
                    ],
                    [
                        'title'         => 'Renal Function Test (RFT)',
                        'amount'        => 600,
                        'code'          => 'RFT003',
                        'gender'        => 'both',
                        'sample_type'   => 'Null',
                    ],
                ],
            ],
            [
                'dept_id' => 2,
                'tests' => [
                    [
                        'title'         => 'Thyroid Profile (T3, T4, TSH)',
                        'amount'        => 1000,
                        'code'          => 'THY004',
                        'gender'        => 'both',
                        'sample_type'   => 'Null',
                    ],
                    [
                        'title'         => 'Complete Urine Examination (CUE)',
                        'amount'        => 400,
                        'code'          => 'CUE005',
                        'gender'        => 'both',
                        'sample_type'   => 'Null',
                    ],
                ],
            ],
        ];

        foreach ($tests as $group) {
            foreach ($group['tests'] as $test) {
                Test::create(array_merge($test, ['dept_id' => $group['dept_id']]));
            }
        }
    }
}
