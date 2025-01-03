<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packageArray = [
            [
                'title'         => 'Summer Package',
                'amount'        => 1500,
                'code'          => 'sp001',
            ],
            [
                'title'         => 'Winder Package',
                'amount'        => 2500,
                'code'          => 'cp001',
            ]
        ];

        foreach ($packageArray as $package) {
            Package::create($package);
        }
    }
}
