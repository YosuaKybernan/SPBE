<?php

// database/seeders/SlideSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slide;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slide::create([
            'image' => 'clients/assets/img/c1.png',
            'title' => 'First Content',
            'description' => 'Some representative placeholder content for the first slide.',
            'link' => 'https://example.com/first-content'
        ]);

        Slide::create([
            'image' => 'clients/assets/img/c2.jpg',
            'title' => 'Konten Dua',
            'description' => 'Some representative placeholder content for the second slide.',
            'link' => 'https://example.com/konten-dua'
        ]);

        Slide::create([
            'image' => 'clients/assets/img/crowd_design1.jpg',
            'title' => 'Latest Content',
            'description' => 'Some representative placeholder content for the last slide.',
            'link' => 'https://example.com/latest-content'
        ]);
    }
}
