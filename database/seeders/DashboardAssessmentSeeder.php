<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DashboardAssessment;

class DashboardAssessmentSeeder extends Seeder
{
    public function run()
    {
        DashboardAssessment::create([
            'form_id' => 1,
            'form_name' => 'Evaluasi SPBE 2019',
            'year' => 2019,
            'description' => 'Evaluasi SPBE tahun 2019',
        ]);

        DashboardAssessment::create([
            'form_id' => 2,
            'form_name' => 'Evaluasi SPBE 2020',
            'year' => 2020,
            'description' => 'Evaluasi SPBE tahun 2020',
        ]);

        DashboardAssessment::create([
            'form_id' => 3,
            'form_name' => 'Evaluasi SPBE 2021',
            'year' => 2021,
            'description' => 'Evaluasi SPBE tahun 2021',
        ]);

        DashboardAssessment::create([
            'form_id' => 4,
            'form_name' => 'Evaluasi SPBE 2022',
            'year' => 2022,
            'description' => 'Evaluasi SPBE tahun 2022',
        ]);

        DashboardAssessment::create([
            'form_id' => 5,
            'form_name' => 'Evaluasi SPBE 2023',
            'year' => 2023,
            'description' => 'Evaluasi SPBE tahun 2023',
        ]);
    }
}
