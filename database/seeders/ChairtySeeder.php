<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChairtySeeder extends Seeder
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
          DB::table('chairties')->insert([
            'name' => $faker_ar->firstName,
            'phone' => $faker_ar->phoneNumber,
            'amount' => $faker_ar->randomNumber(2),
          ]);
        }

    }
}
