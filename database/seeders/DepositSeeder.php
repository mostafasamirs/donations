<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Deposit;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deposit::create([
            'user_id' => 1,
            'kiosk_id' => 1,
            'amount' => 211.52,
            'image' => "image",
            'date' => Carbon::create('4', '4', '1'),
          ]);
        Deposit::create([
            'user_id' => 2,
            'kiosk_id' => 2,
            'amount' => 211.52,
            'image' => "image",
            'date' => Carbon::create('4', '4', '1'),
          ]);
        Deposit::create([
            'user_id' => 3,
            'kiosk_id' => 3,
            'amount' => 211.52,
            'image' => "image",
            'date' => Carbon::create('4', '4', '1'),
          ]);
        Deposit::create([
            'user_id' => 4,
            'kiosk_id' => 4,
            'amount' => 211.20,
            'image' => "image",
            'date' => Carbon::create('4', '4', '1'),
          ]);
        Deposit::create([
            'user_id' => 5,
            'kiosk_id' => 5,
            'amount' => 211.30,
            'image' => "image",
            'date' => Carbon::create('4', '4', '1'),
          ]);

    }
}


