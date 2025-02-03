<?php

use Illuminate\Database\Seeder;
use App\Models\Domain;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama
        Domain::truncate();

        // Tambah data baru
        $domains = [
            ['name' => 'policy'],
            ['name' => 'governance'],
            ['name' => 'management'],
            ['name' => 'service'],
        ];

        foreach ($domains as $domain) {
            Domain::create($domain);
        }
    }
}
