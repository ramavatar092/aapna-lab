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
                'title'       => 'Hematology',
                'slug'        => 'hematology',
                'status'      => 1,
            ],
            [
                'title'       => 'Biochemistry',
                'slug'        => 'biochemistry',
                'status'      => 1,
            ],
            [
                'title'       => 'Microbiology',
                'slug'        => 'microbiology',
                'status'      => 1,
            ],
            [
                'title'       => 'SEROLOGY & IMMUNOLOGY',
                'slug'        => 'serology & immunology',
                'status'      => 1,
            ],
            [
                'title'       => 'CYTOLOGY',
                'slug'        => 'crtology',
                'status'      => 1,
            ],
            [
                'title'       => 'CLINICAL BIOCHEMISTRY',
                'slug'        => 'clinical-biochemistry',
                'status'      => 1,
            ],
            [
                'title'       => 'CLINICAL PATHOLOGY',
                'slug'        => 'clinical-pathology',
                'status'      => 1,
            ],
            [
                'title'       => 'COAGULATION STUDY',
                'slug'        => 'coagulation-study',
                'status'      => 1,
            ],
            [
                'title'       => 'Electrolytes',
                'slug'        => 'electrolytes',
                'status'      => 1,
            ],
            [
                'title'       => 'CYTOGENETICS',
                'slug'        => 'cytogenetics',
                'status'      => 1,
            ],
            [
                'title'       => 'ENZYMES',
                'slug'        => 'enzymes',
                'status'      => 1,
            ],
            [
                'title'       => 'EXAMINATION OF BODY FLUID',
                'slug'        => 'examination-of-body-fluid',
                'status'      => 1,
            ],
            [
                'title'       => 'ENDOCRINOLOGY',
                'slug'        => 'endocrinology',
                'status'      => 1,
            ],
            [
                'title'       => 'HISTOPATHOLOGY',
                'slug'        => 'histopathology',
                'status'      => 1,
            ],
            [
                'title'       => 'HORMONAL ASSAY',
                'slug'        => 'hormonal-assay',
                'status'      => 1,
            ],
            [
                'title'       => 'MISCELLANEOUS',
                'slug'        => 'miscellaneous',
                'status'      => 1,
            ],
            [
                'title'       => 'SPUTUM EXAMINATION',
                'slug'        => 'sputum-examination',
                'status'      => 1,
            ],
            [
                'title'       => 'URINE EXAMINATION',
                'slug'        => 'urine-examination',
                'status'      => 1,
            ],
            [
                'title'       => 'PROFILE TEST',
                'slug'        => 'profile-test',
                'status'      => 1,
            ],
            [
                'title'       => 'STOOL EXAMINATION',
                'slug'        => 'stool-examination',
                'status'      => 1,
            ],
            [
                'title'       => 'IMMUNOASSAY',
                'slug'        => 'immunoassay',
                'status'      => 1,
            ],
            [
                'title'       => 'MOLECULAR BIOLOGY',
                'slug'        => 'molecular-biology',
                'status'      => 1,
            ],
            [
                'title'       => 'RADIOLOGY',
                'slug'        => 'radiology',
                'status'      => 1,
            ],
            [
                'title'       => 'NEUROLOGY',
                'slug'        => 'neurology',
                'status'      => 1,
            ],
            [
                'title'       => 'FLOW CYTOMETRY',
                'slug'        => 'flow-cytometry',
                'status'      => 1,
            ],
            [
                'title'       => 'IHC-HISTOPATHOLOGY',
                'slug'        => 'ihc-histopathology',
                'status'      => 1,
            ],
            [
                'title'       => 'MASS SPECTROMETRY',
                'slug'        => 'mass-spectrometry',
                'status'      => 1,
            ],
            [
                'title'       => 'NEW BORN SCREENING',
                'slug'        => 'new-born-screening',
                'status'      => 1,
            ],
        
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
