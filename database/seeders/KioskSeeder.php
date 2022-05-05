<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KioskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker_ar = Faker::create('ar_SA');
        for ($i = 0; $i < 10; $i++) {
          DB::table('kiosks')->insert([
            'name' => $faker_ar->address,
            // 'address' => $faker_ar->address,
            // 'safe' => $faker_ar->randomNumber(2),
          ]);
        }

    }
}
