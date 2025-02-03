<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Tes',
                'category' => 'Kategori A',
                'content' => 'Isi dari artikel Tes',
                'image' => 'path/to/image1.jpg',
                'image_source' => 'Sumber gambar Tes',
                'created_at' => Carbon::create(2023, 6, 1, 12, 0, 0),
                'updated_at' => Carbon::create(2023, 6, 1, 12, 0, 0),
            ],
            [
                'title' => 'Coba',
                'category' => 'Kategori B',
                'content' => 'Isi dari artikel Coba',
                'image' => 'path/to/image2.jpg',
                'image_source' => 'Sumber gambar Coba',
                'created_at' => Carbon::create(2023, 6, 15, 14, 30, 0),
                'updated_at' => Carbon::create(2023, 6, 15, 14, 30, 0),
            ],
            [
                'title' => 'Mantap',
                'category' => 'Kategori C',
                'content' => 'Isi dari artikel Mantap',
                'image' => 'path/to/image3.jpg',
                'image_source' => 'Sumber gambar Mantap',
                'created_at' => Carbon::create(2023, 8, 15, 9, 45, 0),
                'updated_at' => Carbon::create(2023, 8, 15, 9, 45, 0),
            ],
            // Tambahkan artikel lainnya sesuai kebutuhan
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
