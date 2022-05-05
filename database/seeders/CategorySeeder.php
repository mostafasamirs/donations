<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker_ar = Faker::create('ar_SA');
        for ($i = 0; $i < 10; $i++) {
          DB::table('categories')->insert([
            'name' => $faker_ar->address,
          ]);
        }

    }
}
