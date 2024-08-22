<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Hypothesis;
use App\Models\Role;
use App\Models\Value;
use App\Models\Setting;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $table->enum('level', ['admin', 'doctor', 'officer', 'patient']);
        User::create([
            'name' => 'Seorang Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin123'),
            'level' => 'admin',
        ]);
        User::create([
            'name' => 'Seorang Petugas Poli',
            'email' => 'poli@mail.com',
            'password' => bcrypt('poli123'),
            'level' => 'poli',
        ]);
        User::create([
            'name' => 'Seorang Petugas SIK',
            'email' => 'sik@mail.com',
            'password' => bcrypt('sik123'),
            'level' => 'sik',
        ]);

        User::create([
            'name' => 'Seorang Pasien',
            'email' => 'pasien@mail.com',
            'password' => bcrypt('pasien123'),
            'level' => 'pasien',
        ]);

        // call seeder
        $this->call(EvidenceSeeder::class);

        Hypothesis::create([
            'user_id' => 1,
            'code' => 'P0001',
            'name' => 'Diabetes Melitus Tipe 1',
            'description' => 'adalah jenis diabetes yang disebabkan oleh kekurangan insulin. Biasanya muncul pada usia muda dan memerlukan suntikan insulin untuk pengobatan.',
            'solution' => 'Pengobatan diabetes melitus dengan perubahan gaya hidup termasuk diet sehat dan olahraga teratur.'
        ]);

        Hypothesis::create([
            'user_id' => 1,
            'code' => 'P0002',
            'name' => 'Diabetes Melitus Tipe 2',
            'description' => 'adalah jenis diabetes yang disebabkan oleh resistensi insulin atau produksi insulin yang tidak mencukupi. Biasanya muncul pada usia dewasa dan sering kali terkait dengan gaya hidup yang tidak sehat.',
            'solution' => 'Pengobatan biasanya melibatkan perubahan gaya hidup termasuk diet sehat dan olahraga teratur. '
        ]);


        Role::create(['hypothesis_id' => 1, 'evidence_id' => 1, 'value' => 0.4, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 2, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 3, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 4, 'value' => 0.8, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 5, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 6, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 7, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 8, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 9, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 10, 'value' => 0.4, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 11, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 12, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 13, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 14, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 15, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 16, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 17, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 18, 'value' => 0.4, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 19, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 20, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 1, 'evidence_id' => 21, 'value' => 0.0,'condition' => NULL]);


        Role::create(['hypothesis_id' => 2, 'evidence_id' => 1, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 2, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 3, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 4, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 5, 'value' => 0.8, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 6, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 7, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 8, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 9, 'value' => 0.4, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 10, 'value' => 0.4, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 11, 'value' => 0.4, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 12, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 13, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 14, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 15, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 16, 'value' => 1.0, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 17, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 18, 'value' => 0.0, 'condition' => NULL]);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 19, 'value' => 0.6, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 20, 'value' => 0.8, 'condition' => 'and']);
        Role::create(['hypothesis_id' => 2, 'evidence_id' => 21, 'value' => 0.6, 'condition' => 'and']);



        Value::create(['name' => 'Tidak pernah', 'value' => 0.0]);
        Value::create(['name' => 'Jarang', 'value' => 0.4]);
        Value::create(['name' => 'Cukup Sering', 'value' => 0.6]);
        Value::create(['name' => 'Sering', 'value' => 0.8]);
        Value::create(['name' => 'Sangat Sering', 'value' => 1.0]);



        Setting::create([
            'title' => 'Sistem Deteksi Dini Diabetes Melitus (SIDM)',
            'description' => 'Sistem deteksi dini diabetes melitus (SIDM) adalah sebuah sistem pakar yang dirancang khusus untuk membantu dalam diagnosis penyakit diabetes melitus. SIDM menggunakan metode forward chaining dan certainty factor untuk mengidentifikasi dan mendiagnosis kondisi diabetes pada individu. Metode forward chaining digunakan untuk menentukan diagnosis berdasarkan gejala yang diidentifikasi oleh pengguna, sementara certainty factor digunakan untuk menilai kepastian diagnosis berdasarkan bukti gejala yang ada.</p><p>SIDM memiliki kemampuan untuk mengelola jenis hipotesis penyakit diabetes melitus dan bukti gejala yang diberikan oleh pengguna. Dengan menggunakan SIDM, pengguna dapat memperoleh diagnosis yang akurat dan rekomendasi perawatan yang sesuai dengan kondisi diabetes mereka.',
            'evidence_name' => 'Gejala',
            'hypothesis_name' => 'Diabetes Melitus',
            'input_type' => 'select'
        ]);
    }
}
