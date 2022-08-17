<?php

use Faker\Generator as Faker;
use App\Siswa;

$factory->define(Siswa::class, function (Faker $faker) {
    return [
        'user_id'       => 100,
        'nama_depan'    => $faker->firstName,
        'nama_belakang' => $faker->lastName,
        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
        'agama'         => $faker->randomElement(['Islam', 'Kristen']),
        'alamat'        => $faker->address,
    ];
});
