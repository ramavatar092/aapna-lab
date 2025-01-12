<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'title'       => 'Hematology Department',
                'slug'        => 'hematology-department',
                'status'      => 1,
            ],
            [
                'title'       => 'Biochemistry Department',
                'slug'        => 'biochemistry-department',
                'status'      => 1,
            ],
            [
                'title'       => 'Microbiology Department',
                'slug'        => 'microbiology-department',
                'status'      => 1,
            ],
            [
                'title'       => 'Pathology Department',
                'slug'        => 'pathology-department',
                'status'      => 1,
            ],
            [
                'title'       => 'Radiology Department',
                'slug'        => 'radiology-department',
                'status'      => 1,
            ],
            [
                'title'       => 'Molecular Biology Department',
                'slug'        => 'molecular-biology-department',
                'status'      => 1,
            ],
            [
                'title'       => 'Immunology Department',
                'slug'        => 'immunology-department',
                'status'      => 1,
            ],
            [
                'title'       => 'Toxicology Department',
                'slug'        => 'toxicology-department',
                'status'      => 1,
            ],

        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
