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
                ],
            ],
            [
                'test_id' => 2,
                'parameters' => [
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
                                'range_max'     => 70,
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
                        ],
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
