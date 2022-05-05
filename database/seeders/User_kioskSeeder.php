<?php

namespace Database\Seeders;

use App\Models\User_kiosk;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_kioskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User_kiosk::create([
            'user_id' => 1,
            'kiosk_id' => 1,
          ]);
        User_kiosk::create([
            'user_id' => 2,
            'kiosk_id' => 2,
          ]);
        User_kiosk::create([
            'user_id' => 3,
            'kiosk_id' => 3,
          ]);
        User_kiosk::create([
            'user_id' =>4,
            'kiosk_id' =>4,
          ]);
        User_kiosk::create([
            'user_id' => 5,
            'kiosk_id' => 5,
          ]);
        User_kiosk::create([
            'user_id' => 6,
            'kiosk_id' => 6,
          ]);
        User_kiosk::create([
            'user_id' => 7,
            'kiosk_id' => 7,
          ]);
        User_kiosk::create([
            'user_id' => 8,
            'kiosk_id' => 8,
          ]);
        User_kiosk::create([
            'user_id' => 9,
            'kiosk_id' => 9,
          ]);
        User_kiosk::create([
            'user_id' => 10,
            'kiosk_id' => 10,
          ]);
    }
}
