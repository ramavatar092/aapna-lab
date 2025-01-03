<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $testArray = [
            [
                'dept_id'       => 1,
                'title'         => 'Complete Blood Count (CBC)',
                'amount'        => 500,
                'code'          => 'CBC001',
                'gender'        => 'male',
                'sample_type'   => 'Blood',
                'type'          => 'Hematology',
            ],
            [
                'dept_id'       => 2,
                'title'         => 'Erythrocyte Sedimentation Rate (ESR)',
                'amount'        => 300,
                'code'          => 'ESR002',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Hematology',
            ],
            [
                'dept_id'       => 3,
                'title'         => 'Peripheral Smear',
                'amount'        => 300,
                'code'          => 'PS003',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Hematology',
            ],
            [
                'dept_id'       => 4,
                'title'         => 'Blood Sugar (Fasting/PP)',
                'amount'        => 300,
                'code'          => 'BS004',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Biochemistry',
            ],
            [
                'dept_id'       => 5,
                'title'         => 'Lipid Profile',
                'amount'        => 300,
                'code'          => 'LP005',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Biochemistry',
            ],
            [
                'dept_id'       => 6,
                'title'         => 'Liver Function Test (LFT)',
                'amount'        => 300,
                'code'          => 'LFT006',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Biochemistry',
            ],
            [
                'dept_id'       => 7,
                'title'         => 'Kidney Function Test (KFT)',
                'amount'        => 300,
                'code'          => 'KFT007',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Biochemistry',
            ],
            [
                'dept_id'       => 8,
                'title'         => 'Culture and Sensitivity Tests',
                'amount'        => 300,
                'code'          => 'CST008',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Microbiology',
            ],
            [
                'dept_id'       => 9,
                'title'         => 'Urine Routine and Microscopy',
                'amount'        => 300,
                'code'          => 'URM009',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Microbiology',
            ],
            [
                'dept_id'       => 10,
                'title'         => 'Sputum Examination',
                'amount'        => 300,
                'code'          => 'SE010',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Microbiology',
            ],
            [
                'dept_id'       => 11,
                'title'         => 'HIV Test',
                'amount'        => 300,
                'code'          => 'HIV011',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Immunology',
            ],
            [
                'dept_id'       => 12,
                'title'         => 'Hepatitis Panel (Hepatitis A, B, C)',
                'amount'        => 300,
                'code'          => 'HTP012',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Immunology',
            ],
            [
                'dept_id'       => 13,
                'title'         => 'C-Reactive Protein (CRP)',
                'amount'        => 300,
                'code'          => 'CRP013',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Immunology',
            ],
            [
                'dept_id'       => 14,
                'title'         => 'PCR Testing',
                'amount'        => 300,
                'code'          => 'PCR014',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Molecular Biology',
            ],
            [
                'dept_id'       => 15,
                'title'         => 'Genetic Testing',
                'amount'        => 300,
                'code'          => 'GT015',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Molecular Biology',
            ],
            [
                'dept_id'       => 16,
                'title'         => 'COVID-19 Testing',
                'amount'        => 300,
                'code'          => 'CVD016',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Molecular Biology',
            ],
            [
                'dept_id'       => 17,
                'title'         => 'Tissue Biopsy',
                'amount'        => 300,
                'code'          => 'TSB017',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Pathology',
            ],
            [
                'dept_id'       => 18,
                'title'         => 'Histopathology Examination',
                'amount'        => 300,
                'code'          => 'HPE018',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Pathology',
            ],
            [
                'dept_id'       => 19,
                'title'         => 'Cytology Tests (e.g., Pap Smear)',
                'amount'        => 300,
                'code'          => 'CT019',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Pathology',
            ],
            [
                'dept_id'       => 20,
                'title'         => 'X-ray',
                'amount'        => 300,
                'code'          => 'XR020',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Radiology',
            ],
            [
                'dept_id'       => 21,
                'title'         => 'Ultrasound',
                'amount'        => 300,
                'code'          => 'XR021',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Radiology',
            ],
            [
                'dept_id'       => 22,
                'title'         => 'CT Scan',
                'amount'        => 300,
                'code'          => 'CT022',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Radiology',
            ],
            [
                'dept_id'       => 24,
                'title'         => 'MRI',
                'amount'        => 300,
                'code'          => 'MRI024',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Radiology',
            ],
            [
                'dept_id'       => 25,
                'title'         => 'Drug Screening',
                'amount'        => 300,
                'code'          => 'DS025',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Toxicology',
            ],
            [
                'dept_id'       => 26,
                'title'         => 'Toxicology Analysis',
                'amount'        => 300,
                'code'          => 'DS026',
                'gender'        => 'female',
                'sample_type'   => 'Blood',
                'type'          => 'Toxicology',
            ],
        ];

        foreach ($testArray as $test) {
            Test::create($test);
        }
    }
}
