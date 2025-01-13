<?php

namespace Database\Seeders;

use App\Models\TestFeature;
use Illuminate\Database\Seeder;

class TestParameterSeeder extends Seeder
{
    public function run(): void
    {
        $parameters = [
            [
                'test_id' => 1,
                'parameters' => [
                    [
                        'test_name'     => 'Haemoglobin',
                        'field'         => 'numeric',
                        'unit'          => 'gm%',
                        'range_min'     => 11.5,
                        'range_max'     => 18.0,
                        'type'          => 'single-field',
                        'children'      => [], // No children
                    ],
                    [
                        'test_name'     => 'Total Leucocyte Count',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 4000,
                        'range_max'     => 10000,
                        'type'          => 'single-field',
                        'children'      => [], // No children
                    ],
                    [
                        'test_name'     => 'Differential Leucocyte Count',
                        'field'         => '',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'multiple-field',
                        'children'      => [
                            [
                                'test_name'     => 'Neutrophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 40,
                                'range_max'     => 80,
                            ],
                            [
                                'test_name'     => 'Lymphocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 20,
                                'range_max'     => 40,
                            ],
                            [
                                'test_name'     => 'Eosinophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 1,
                                'range_max'     => 6,
                            ],
                            [
                                'test_name'     => 'Monocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 2,
                                'range_max'     => 10,
                            ],
                            [
                                'test_name'     => 'Basophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 0,
                                'range_max'     => 1,
                            ],
                        ], // No children
                    ],
                    [
                        'test_name'     => 'Absolute Leucocyte Count',
                        'field'         => '',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'multiple-field',
                        'children'      => [
                            [
                                'test_name'     => 'Absolute Neutrophils',
                                'field'         => 'numeric',
                                'unit'          => '/cumm',
                                'range_min'     => 2000,
                                'range_max'     => 7000,
                            ],
                            [
                                'test_name'     => 'Absolute Lymphocytes',
                                'field'         => 'numeric',
                                'unit'          => '/cumm',
                                'range_min'     => 1000,
                                'range_max'     => 3000,
                            ],
                            [
                                'test_name'     => 'Absolute Eosinophils',
                                'field'         => 'numeric',
                                'unit'          => '/cumm',
                                'range_min'     => 20,
                                'range_max'     => 500,
                            ],
                            [
                                'test_name'     => 'Absolute Monocytes',
                                'field'         => 'numeric',
                                'unit'          => '/cumm',
                                'range_min'     => 200,
                                'range_max'     => 1000,
                            ],
                            [
                                'test_name'     => 'Absolute Basophils',
                                'field'         => 'numeric',
                                'unit'          => '/cumm',
                                'range_min'     => 00,
                                'range_max'     => 10,
                            ],
                        ], // No children
                    ],
                    [
                        'test_name'     => 'RBC Indices',
                        'field'         => '',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'multiple-field',
                        'children'      => [
                            [
                                'test_name'     => 'RBC Count',
                                'field'         => 'numeric',
                                'unit'          => 'Million/cumm	',
                                'range_min'     => 4.5,
                                'range_max'     => 5.5,
                            ],
                            [
                                'test_name'     => 'Hct',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 40,
                                'range_max'     => 50,
                            ],
                            [
                                'test_name'     => 'MCV',
                                'field'         => 'numeric',
                                'unit'          => 'fL',
                                'range_min'     => 81,
                                'range_max'     => 101,
                            ],
                            [
                                'test_name'     => 'MCH',
                                'field'         => 'numeric',
                                'unit'          => 'pg',
                                'range_min'     => 27,
                                'range_max'     => 32,
                            ],
                            [
                                'test_name'     => 'MCHC',
                                'field'         => 'numeric',
                                'unit'          => 'g/dL',
                                'range_min'     => 31.5,
                                'range_max'     => 34.5,
                            ],
                            [
                                'test_name'     => 'RDW-CV',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 11.6,
                                'range_max'     => 14,
                            ],
                            [
                                'test_name'     => 'RDW-SD',
                                'field'         => 'numeric',
                                'unit'          => 'fL',
                                'range_min'     => 39,
                                'range_max'     => 46,
                            ],
                        ], // No children
                    ],
                    [
                        'test_name'     => 'Platelets Indices',
                        'field'         => '',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'multiple-field',
                        'children'      => [
                            [
                                'test_name'     => 'Platelet Count',
                                'field'         => 'numeric',
                                'unit'          => '/cumm',
                                'range_min'     => 150000,
                                'range_max'     => 400000,
                            ],
                            [
                                'test_name'     => 'PCT',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => .18,
                                'range_max'     => .39,
                            ],
                            [
                                'test_name'     => 'MPV',
                                'field'         => 'numeric',
                                'unit'          => 'fL',
                                'range_min'     => 7.5,
                                'range_max'     => 11.5,
                            ],
                            [
                                'test_name'     => 'PDW',
                                'field'         => 'numeric',
                                'unit'          => 'fL',
                                'range_min'     => 11,
                                'range_max'     => 15.5,
                            ],
                            [
                                'test_name'     => 'P-LCR',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 11,
                                'range_max'     => 45,
                            ],
                            [
                                'test_name'     => 'P-LCC',
                                'field'         => 'numeric',
                                'unit'          => '10^3/uL',
                                'range_min'     => 30,
                                'range_max'     => 90,
                            ],
                        ], // No children
                    ],
                ],
            ],
            [
                'test_id' => 2,
                'parameters' => [
                    [
                        'test_name'     => 'Absolute CD Count',
                        'field'         => 'numeric',
                        'unit'          => 'Cells/cumm',
                        'range_min'     => 500,
                        'range_max'     => 1500,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'CD4+ T Helper Cells',
                        'field'         => 'numeric',
                        'unit'          => '%',
                        'range_min'     => 28,
                        'range_max'     => 58,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Haemoglobin (Hb)',
                        'field'         => 'numeric',
                        'unit'          => 'g/dL',
                        'range_min'     => 13,
                        'range_max'     => 18,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 3,
                'parameters' => [
                    [
                        'test_name'     => 'Total Leucocyte Count(WBC)',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 4000,
                        'range_max'     => 11000,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'CD45 (Lymphocyte) Percentage',
                        'field'         => 'numeric',
                        'unit'          => '%',
                        'range_min'     => 20,
                        'range_max'     => 40,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'CD45 (Lymphocyte) Absolute',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 1000,
                        'range_max'     => 4000,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'CD3 (Total T Cells) Percentage',
                        'field'         => 'numeric',
                        'unit'          => '%',
                        'range_min'     => 59,
                        'range_max'     => 83,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'CD3 (Total T Cells) Absolute',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 677,
                        'range_max'     => 2383,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'CD4 (Total T Cells) Percentage',
                        'field'         => 'numeric',
                        'unit'          => '%',
                        'range_min'     => 31,
                        'range_max'     => 59,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'CD4 (Total T Cells) Absolute',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 424,
                        'range_max'     => 1509,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 4,
                'parameters' => [
                    [
                        'test_name'     => 'ESR',
                        'field'         => 'numeric',
                        'unit'          => 'mm/h',
                        'range_min'     => 0,
                        'range_max'     => 15,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 5,
                'parameters' => [
                    [
                        'test_name'     => 'Plasmodium Vivax Antigen',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Plasmodium Falciparum Antigen',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 6,
                'parameters' => [
                    [
                        'test_name'     => 'ABO Type',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Rh Factor',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 7,
                'parameters' => [
                    [
                        'test_name'     => 'Absolute Eosinophils Count',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 50,
                        'range_max'     => 500,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 8,
                'parameters' => [
                    [
                        'test_name'     => 'Haemoglobin (Hb)',
                        'field'         => 'numeric',
                        'unit'          => 'g/dL',
                        'range_min'     => 13,
                        'range_max'     => 18,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Hb%',
                        'field'         => 'numeric',
                        'unit'          => '%',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 9,
                'parameters' => [
                    [
                        'test_name'     => 'Haemoglobin (Hb)',
                        'field'         => 'numeric',
                        'unit'          => 'g/dL',
                        'range_min'     => 13.5,
                        'range_max'     => 17.5,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Total Leucocyte Count (TLC)',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 4000,
                        'range_max'     => 11000,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Differential Leucocyte Count',
                        'field'         => '',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'multiple-field',
                        'children'      => [
                            [
                                'test_name'     => 'Neutrophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 40,
                                'range_max'     => 80,
                            ],
                            [
                                'test_name'     => 'Lymphocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 20,
                                'range_max'     => 45,
                            ],
                            [
                                'test_name'     => 'Eosinophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 1,
                                'range_max'     => 6,
                            ],
                            [
                                'test_name'     => 'Monocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 2,
                                'range_max'     => 8,
                            ],
                            [
                                'test_name'     => 'Basophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 0,
                                'range_max'     => 1,
                            ],
                        ],
                    ],
                    [
                        'test_name'     => 'Erythrocyte Sedimentation Rate (ESR)',
                        'field'         => 'numeric',
                        'unit'          => 'mm/h',
                        'range_min'     => 0,
                        'range_max'     => 15,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 10,
                'parameters' => [
                    [
                        'test_name'     => 'Malaria Parasite',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 11,
                'parameters' => [
                    [
                        'test_name'     => 'DCT',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 12,
                'parameters' => [
                    [
                        'test_name'     => 'G6PD -Glucose 6Phosphate Dehydrogenase',
                        'field'         => 'numeric',
                        'unit'          => 'U/gHb',
                        'range_min'     => 6.4,
                        'range_max'     => 18.7,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 13,
                'parameters' => [
                    [
                        'test_name'     => 'Bleeding Time',
                        'field'         => 'numeric',
                        'unit'          => 'minutes',
                        'range_min'     => 2,
                        'range_max'     => 7,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Clotting Time',
                        'field'         => 'numeric',
                        'unit'          => 'minutes',
                        'range_min'     => 4,
                        'range_max'     => 11,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 14,
                'parameters' => [
                    [
                        'test_name'     => 'Results',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 15,
                'parameters' => [
                    [
                        'test_name'     => 'Results',
                        'field'         => 'text',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 16,
                'parameters' => [
                    [
                        'test_name'     => 'Total Leucocyte Count (TLC)',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 4000,
                        'range_max'     => 11000,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Differential Leucocyte Count (DLC)',
                        'field'         => '',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'multiple-field',
                        'children'      => [
                            [
                                'test_name'     => 'Neutrophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 40,
                                'range_max'     => 80,
                            ],
                            [
                                'test_name'     => 'Lymphocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 20,
                                'range_max'     => 45,
                            ],
                            [
                                'test_name'     => 'Eosinophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 1,
                                'range_max'     => 6,
                            ],
                            [
                                'test_name'     => 'Monocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 2,
                                'range_max'     => 8,
                            ],
                            [
                                'test_name'     => 'Basophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 0,
                                'range_max'     => 1,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'test_id' => 17,
                'parameters' => [
                    [
                        'test_name'     => 'Haemoglobin (Hb)',
                        'field'         => 'numeric',
                        'unit'          => 'g/dL',
                        'range_min'     => 13,
                        'range_max'     => 18,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Total Leucocyte Count',
                        'field'         => 'numeric',
                        'unit'          => '/cumm',
                        'range_min'     => 4000,
                        'range_max'     => 11000,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Differential Leucocyte Count',
                        'field'         => '',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'multiple-field',
                        'children'      => [
                            [
                                'test_name'     => 'Neutrophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 40,
                                'range_max'     => 80,
                            ],
                            [
                                'test_name'     => 'Lymphocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 20,
                                'range_max'     => 45,
                            ],
                            [
                                'test_name'     => 'Eosinophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 1,
                                'range_max'     => 6,
                            ],
                            [
                                'test_name'     => 'Monocytes',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 2,
                                'range_max'     => 8,
                            ],
                            [
                                'test_name'     => 'Basophils',
                                'field'         => 'numeric',
                                'unit'          => '%',
                                'range_min'     => 0,
                                'range_max'     => 1,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'test_id' => 18,
                'parameters' => [
                    [
                        'test_name'     => 'RBC Morphology',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'WBC Morphology',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Platelets',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Atypical Cells/Blast Cells',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Parasites',
                        'field'         => 'text',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Impression',
                        'field'         => 'text',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 19,
                'parameters' => [
                    [
                        'test_name'     => 'Patient Value',
                        'field'         => 'numeric',
                        'unit'          => 'Sec',
                        'range_min'     => 36,
                        'range_max'     => 56,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Control Value',
                        'field'         => 'multiple_ranges',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                    [
                        'test_name'     => 'Screen ratio',
                        'field'         => 'numeric_unbound',
                        'unit'          => 'Sec',
                        'range_min'     => null,
                        'range_max'     => 1.20,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 20,
                'parameters' => [
                    [
                        'test_name'     => 'Indirect Coombs Test',
                        'field'         => 'custom',
                        'unit'          => '',
                        'range_min'     => null,
                        'range_max'     => null,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
            [
                'test_id' => 21,
                'parameters' => [
                    [
                        'test_name'     => 'Immature Platelet Fraction (IPF)',
                        'field'         => 'numeric',
                        'unit'          => '%',
                        'range_min'     => .7,
                        'range_max'     => 7,
                        'type'          => 'single-field',
                        'children'      => [],
                    ],
                ],
            ],
        ];

        foreach ($parameters as $group) {
            foreach ($group['parameters'] as $parameter) {
                // Exclude 'children' key before creating the parent record
                $parentData = collect($parameter)->except('children')->toArray();

                // Create parent parameter
                $parent = TestFeature::create(array_merge($parentData, [
                    'test_id' => $group['test_id'],
                    'parent_id' => null, // No parent for top-level
                ]));

                // Loop through child parameters and associate them with the parent
                if (!empty($parameter['children'])) {
                    foreach ($parameter['children'] as $child) {
                        $childData = collect($child)->toArray();

                        TestFeature::create(array_merge($childData, [
                            'test_id' => $group['test_id'],
                            'parent_id' => $parent->id, // Assign parent_id
                        ]));
                    }
                }
            }
        }
    }
}
