<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Shift;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create([
            'user_id' => 1,
            'kiosk_id' => 1,
            'start_time' => Carbon::create('2000', '01', '01'),
            'end_time' => Carbon::create('2000', '01', '01'),
          ]);
        Shift::create([
            'user_id' => 2,
            'kiosk_id' => 2,
            'start_time' => Carbon::create('2000', '01', '01'),
            'end_time' => Carbon::create('2000', '01', '01'),
          ]);
        Shift::create([
            'user_id' => 2,
            'kiosk_id' => 2,
            'start_time' => Carbon::create('2000', '01', '01'),
            'end_time' => Carbon::create('2000', '01', '01'),
          ]);
        Shift::create([
            'user_id' => 3,
            'kiosk_id' => 3,
            'start_time' => Carbon::create('2000', '01', '01'),
            'end_time' => Carbon::create('2000', '01', '01'),
          ]);
        Shift::create([
            'user_id' => 4,
            'kiosk_id' => 4,
            'start_time' => Carbon::create('2000', '01', '01'),
            'end_time' => Carbon::create('2000', '01', '01'),
          ]);
        Shift::create([
            'user_id' => 5,
            'kiosk_id' => 5,
            'start_time' => Carbon::create('2000', '01', '01'),
            'end_time' => Carbon::create('2000', '01', '01'),
        ]);
    }
}
