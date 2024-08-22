<?php

namespace Database\Seeders;

use App\Models\Evidence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evidence::create([
            'code' => 'G0001',
            'name' => 'Usia <20 tahun',
        ]);

        Evidence::create([
            'code' => 'G0002',
            'name' => 'Usia >20 tahun',
        ]);

        Evidence::create([
            'code' => 'G0003',
            'name' => 'Sering buang air kecil (Poliuri)',
        ]);

        Evidence::create([
            'code' => 'G0004',
            'name' => 'Sering lapar (Polifagia)',
        ]);

        Evidence::create([
            'code' => 'G0005',
            'name' => 'Sering haus (Polidipsia)',
        ]);

        Evidence::create([
            'code' => 'G0006',
            'name' => 'Riwayat genetik',
        ]);

        Evidence::create([
            'code' => 'G0007',
            'name' => 'Penurunan berat badan drastis',
        ]);

        Evidence::create([
            'code' => 'G0008',
            'name' => 'Obesitas',
        ]);

        Evidence::create([
            'code' => 'G0009',
            'name' => 'Pusing',
        ]);

        Evidence::create([
            'code' => 'G0010',
            'name' => 'Mual',
        ]);

        Evidence::create([
            'code' => 'G0011',
            'name' => 'Muntah',
        ]);

        Evidence::create([
            'code' => 'G0012',
            'name' => 'Mudah lemas',
        ]);

        Evidence::create([
            'code' => 'G0013',
            'name' => 'Merasa lelah',
        ]);

        Evidence::create([
            'code' => 'G0014',
            'name' => 'Mudah kantuk',
        ]);

        Evidence::create([
            'code' => 'G0015',
            'name' => 'Gatal-gatal',
        ]);


        Evidence::create([
            'code' => 'G0016',
            'name' => 'Kebas atau kesemutan',
        ]);

        Evidence::create([
            'code' => 'G0017',
            'name' => 'Luka sulit sembuh',
        ]);

        Evidence::create([
            'code' => 'G0018',
            'name' => 'Mudah infeksi',
        ]);

        Evidence::create([
            'code' => 'G0019',
            'name' => 'Pandangan kabur',
        ]);

        Evidence::create([
            'code' => 'G0020',
            'name' => 'Hipertensi',
        ]);

        Evidence::create([
            'code' => 'G0021',
            'name' => 'Nyeri otot',
        ]);
    }
}
