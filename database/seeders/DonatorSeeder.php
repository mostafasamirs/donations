<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DonatorSeeder extends Seeder
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
          DB::table('donators')->insert([
            'name' => $faker_ar->firstName,
            'phone' => $faker_ar->phoneNumber,
            // 'amount' => $faker_ar->randomNumber(2),
          ]);
        }

    }
}
