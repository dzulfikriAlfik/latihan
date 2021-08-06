<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class OrangSeeder extends Seeder
{
	public function run()
	{
		// $data = [
		// 	[
		// 		'nama'       => 'Dzulfikri',
		// 		'alamat'     => 'Cikijing - Majalengka',
		// 		'created_at' => Time::now(),
		// 		'updated_at' => Time::now()
		// 	],
		// 	[
		// 		'nama'       => 'Ica Cahyani',
		// 		'alamat'     => 'KiaraCondong - Bandung',
		// 		'created_at' => Time::now(),
		// 		'updated_at' => Time::now()
		// 	],
		// 	[
		// 		'nama'       => 'Annisa Novitri',
		// 		'alamat'     => 'Bekasi - Jawa Barat',
		// 		'created_at' => Time::now(),
		// 		'updated_at' => Time::now()
		// 	],
		// 	[
		// 		'nama'       => 'Wulan Nur Alam',
		// 		'alamat'     => 'Cikijing - Majalengka',
		// 		'created_at' => Time::now(),
		// 		'updated_at' => Time::now()
		// 	],
		// ];

		$faker = Factory::create('id_ID');

		for ($i = 0; $i < 100; $i++) {
			$data = [
				'nama'       => $faker->name,
				'alamat'     => $faker->address,
				// 'created_at' => Time::now(),
				'created_at' => Time::createFromTimestamp($faker->unixTime()),
				'updated_at' => Time::now()
			];
			$this->db->table('orang')->insert($data);
		}

		// Using Query Builder
		// $this->db->table('orang')->insert($data);
		// $this->db->table('orang')->insertBatch($data);


		// Simple Queries
		// $this->db->query(
		// 	"INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
		// 	$data
		// );

	}
}
