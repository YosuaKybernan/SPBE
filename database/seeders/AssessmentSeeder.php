<?php

// database/seeders/AssessmentSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SelfAssessment;
use App\Models\FinalAssessment;

class AssessmentSeeder extends Seeder
{
    public function run()
    {
        $chartData = [
            '2019' => [
                'firstDataset' => [65, 59, 90, 81, 56, 55, 40, 45],
                'secondDataset' => [28, 48, 40, 19, 96, 27, 100, 50],
                'excelLink' => "https://docs.google.com/spreadsheets/d/e/2PACX-1vS8N0ndEsXvzDrU0ifeq6lCDQaJWAjPZqF79Y6rH18lxQhQAuOemetw4jEWy_YYhN9k7NTDjpSxrAxH/pubhtml?gid=0&single=true&widget=true&headers=false"
            ],
            '2020' => [
                'firstDataset' => [75, 63, 95, 85, 60, 58, 45, 55],
                'secondDataset' => [35, 50, 45, 22, 100, 30, 105, 60],
                'excelLink' => "https://docs.google.com/spreadsheets/d/e/2PACX-1vS8N0ndEsXvzDrU0ifeq6lCDQaJWAjPZqF79Y6rH18lxQhQAuOemetw4jEWy_YYhN9k7NTDjpSxrAxH/pubhtml?gid=933215463&single=true&widget=true&headers=false"
            ],
            '2021' => [
                'firstDataset' => [45, 67, 85, 74, 58, 62, 49, 60],
                'secondDataset' => [40, 60, 50, 25, 98, 33, 110, 65],
                'excelLink' => "https://docs.google.com/spreadsheets/d/e/2PACX-1vS8N0ndEsXvzDrU0ifeq6lCDQaJWAjPZqF79Y6rH18lxQhQAuOemetw4jEWy_YYhN9k7NTDjpSxrAxH/pubhtml?gid=123456789&single=true&widget=true&headers=false"
            ],
            '2022' => [
                'firstDataset' => [56, 49, 70, 65, 45, 52, 38, 70],
                'secondDataset' => [50, 65, 55, 30, 95, 36, 115, 75],
                'excelLink' => "https://docs.google.com/spreadsheets/d/e/2PACX-1vSmQ_dvRqCIdTX3FqXSVFJ4m_wOwygmUuC3Gp54_5gNXJdLu1f9ayX8HPW1uDjWBdaYsFKMHQIhisjs/pubhtml?widget=true&amp;headers=false"
            ],
            '2023' => [
                'firstDataset' => [72, 55, 60, 82, 66, 59, 50, 80],
                'secondDataset' => [60, 70, 60, 35, 90, 39, 38, 85],
                'excelLink' => "https://docs.google.com/spreadsheets/d/e/2PACX-1vS8N0ndEsXvzDrU0ifeq6lCDQaJWAjPZqF79Y6rH18lxQhQAuOemetw4jEWy_YYhN9k7NTDjpSxrAxH/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false"
            ]
        ];

        foreach ($chartData as $year => $datasets) {
            SelfAssessment::create([
                'year' => $year,
                'internal_policy' => $datasets['firstDataset'][0],
                'strategic_planning' => $datasets['firstDataset'][1],
                'information_technology' => $datasets['firstDataset'][2],
                'organizer' => $datasets['firstDataset'][3],
                'management_implementation' => $datasets['firstDataset'][4],
                'it_audit' => $datasets['firstDataset'][5],
                'administration_services' => $datasets['firstDataset'][6],
                'public_services' => $datasets['firstDataset'][7]
            ]);

            FinalAssessment::create([
                'year' => $year,
                'internal_policy' => $datasets['secondDataset'][0],
                'strategic_planning' => $datasets['secondDataset'][1],
                'information_technology' => $datasets['secondDataset'][2],
                'organizer' => $datasets['secondDataset'][3],
                'management_implementation' => $datasets['secondDataset'][4],
                'it_audit' => $datasets['secondDataset'][5],
                'administration_services' => $datasets['secondDataset'][6],
                'public_services' => $datasets['secondDataset'][7],
                'excel_link' => $datasets['excelLink']
            ]);
        }
    }
}
