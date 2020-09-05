<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Mahasiswa;
use Faker\Generator as Faker;

$factory->define(App\Mahasiswa::class, function (Faker $faker) {
		static $i = 1;
		$lastMahasiswa = Mahasiswa::orderBy('created_at', 'desc')->first();
    if ( ! $lastMahasiswa){
         $number = 0;
    }else {
         $number = substr($lastMahasiswa->mhs_code, 2);
    }

	  return [
        'mhs_code' => 'IB' . sprintf('%04d', intval($number) + $i++),
				'mhs_nama' => $faker->name,
				'mhs_hp' => rand(0000000000001,9999999999999),
				'mhs_kelamin' => $faker->randomElement(['L','P']),
				'mhs_user' => 1,
    ];
});

