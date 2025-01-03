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
                'slug'        => 'hematology department',
                'description' => 'Manages blood-related testing and diagnostics.',
                'status'      => 1,
            ],
            [
                'title'       => 'Biochemistry Department',
                'slug'        => 'biochemistry department',
                'description' => 'Focuses on chemical analysis of bodily fluids.',
                'status'      => 1,
            ],
            [
                'title'       => 'Microbiology Department',
                'slug'        => 'microbiology department',
                'description' => 'Handles bacterial, viral, and fungal tests.',
                'status'      => 1,
            ],
            [
                'title'       => 'Pathology Department',
                'slug'        => 'pathology department',
                'description' => 'Specializes in tissue and cell analysis.',
                'status'      => 1,
            ],
            [
                'title'       => 'Radiology Department',
                'slug'        => 'radiology department',
                'description' => 'Performs imaging tests like X-rays and MRIs.',
                'status'      => 1,
            ],
            [
                'title'       => 'Molecular Biology Department',
                'slug'        => 'molecular biology department',
                'description' => 'Conducts advanced genetic and molecular testing.',
                'status'      => 1,
            ],
            [
                'title'       => 'Immunology Department',
                'slug'        => 'immunology department',
                'description' => 'Focuses on immune response and antibody detection.',
                'status'      => 1,
            ],
            [
                'title'       => 'Toxicology Department',
                'slug'        => 'toxicology department',
                'description' => 'Handles drug screening and poison analysis.',
                'status'      => 1,
            ],
            
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
