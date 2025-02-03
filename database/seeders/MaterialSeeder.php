<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use Carbon\Carbon;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        $documents = [
            [
                'name' => 'Dokumen SPBE 1',
                'download_link' => 'path/to/document1.pdf',
                'created_at' => Carbon::parse('2021-04-12 10:30:00'),
                'modified_at' => Carbon::now(),
            ],
            [
                'name' => 'Dokumen SPBE 2',
                'download_link' => 'path/to/document2.pdf',
                'created_at' => Carbon::parse('2022-06-15 14:15:00'),
                'modified_at' => Carbon::now(),
            ],
            [
                'name' => 'Dokumen SPBE 3',
                'download_link' => 'path/to/document3.pdf',
                'created_at' => Carbon::parse('2021-11-19 08:45:00'),
                'modified_at' => Carbon::now(),
            ],
        ];

        foreach ($documents as $document) {
            Material::create($document);
        }
    }
}

