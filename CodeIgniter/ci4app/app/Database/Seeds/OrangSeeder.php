<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama' => 'Dzulfikri Alfik',
        //         'alamat' => 'Jl. Polo Air Bandung',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ],
        //     [
        //         'nama' => 'Roni Yanara',
        //         'alamat' => 'Jl. Polo Air 1 Bandung',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ],
        //     [
        //         'nama' => 'Maing Kusnarto',
        //         'alamat' => 'Jl. Polo Air 1 Bandung',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ],
        // ];

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
            $this->db->table('orang')->insert($data);
        }

        // Simple Queries
        // $this->db->query("INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        // single data
        // $this->db->table('orang')->insert($data);

        // multiple data
        // $this->db->table('orang')->insertBatch($data);
    }
}