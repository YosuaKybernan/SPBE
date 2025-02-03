<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Regulation;

class RegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regulations = [
            'Peraturan Presiden' => [
                ['title' => 'Nomor 132 Tahun 2022 Tentang Arsitektur SPBE Nasional', 'file_path' => 'storage/regulations/nomor_132_2022.pdf'],
                ['title' => 'Nomor 39 Tahun 2019 Tentang Satu Data Indonesia', 'file_path' => 'storage/regulations/nomor_39_2019.pdf'],
                ['title' => 'Nomor 95 Tahun 2018 Tentang SPBE', 'file_path' => 'storage/regulations/nomor_95_2018.pdf'],
            ],
            'Peraturan Menteri' => [
                ['title' => 'Permenko Nomor 4 Tahun 2023 Tentang SPBE Di Kemenko Perekonomian', 'file_path' => 'storage/regulations/permenko_4_2023.pdf'],
                ['title' => 'BSSN Nomor 4 Tahun 2021 Tentang Manajemen Keamanan SPBE', 'file_path' => 'storage/regulations/bssn_4_2021.pdf'],
                ['title' => 'PAN RB Nomor 59 Tahun 2020 Tentang Pemantauan dan Evaluasi SPBE', 'file_path' => 'storage/regulations/pan_rb_59_2020.pdf'],
                ['title' => 'Bappenas/PPN Nomor 16 Tahun 2020 Tentang Manajemen Data SPBE', 'file_path' => 'storage/regulations/bappenas_ppn_16_2020.pdf'],
                ['title' => 'PAN RB Nomor 5 Tahun 2020 Tentang Manajemen Risiko SPBE', 'file_path' => 'storage/regulations/pan_rb_5_2020.pdf'],
            ],
            'Keputusan Menteri' => [
                ['title' => 'Kepmenko Nomor 70 Tahun 2023 Tim Koordinasi SPBE', 'file_path' => 'storage/regulations/kepmenko_70_2023.pdf'],
                ['title' => 'PAN RB Nomor 108 Tahun 2023 Tentang Hasil Pemantauan dan Evaluasi SPBE Pada Instansi Pusat dan Pemerintah Daerah Tahun 2022', 'file_path' => 'storage/regulations/pan_rb_108_2023.pdf'],
                ['title' => 'PAN RB Nomor 1503 Tahun 2021 Tentang Hasil Evaluasi SPBE Pada Kementerian, Lembaga dan Pemerintah Daerah Tahun 2021', 'file_path' => 'storage/regulations/pan_rb_1503_2021.pdf'],
                ['title' => 'PAN RB Nomor 962 Tahun 2021 Tentang Pedoman Teknis Pelaksanaan Pemantauan dan Evaluasi SPBE', 'file_path' => 'storage/regulations/pan_rb_962_2021.pdf'],
            ],
            'Surat Edaran Menteri' => [
                ['title' => 'PAN RB Nomor 18 Tahun 2022 Tentang Keterpaduan Layanan Digital Nasional Melalui Penerapan Arsitektur SPBE dan Peta Rencana SPBE', 'file_path' => 'storage/regulations/pan_rb_18_2022.pdf'],
            ],
        ];

        foreach ($regulations as $category => $items) {
            foreach ($items as $item) {
                Regulation::create([
                    'category' => $category,
                    'title' => $item['title'],
                    'file_path' => $item['file_path'],
                ]);
            }
        }
    }
}
